<?php

declare(strict_types=1);

use App\Models\Option;

test('to array', function () {
    $option = Option::set('test_option', 'test_value');

    expect(array_keys($option->toArray()))->toBe([
        'key',
        'value',
    ]);
});

test('get option returns the specified option value', function () {
    $key = 'test_option';
    $value = 'test_value';

    Option::set($key, $value);

    expect(Option::get($key))->toBe($value);
});

test('get option returns the default value if the option does not exist', function () {
    $key = 'non_existent_option';
    $defaultValue = 'default_value';

    expect(Option::get($key, $defaultValue))->toBe($defaultValue);
});

test('get option returns null if no default value is provided and the option does not exist', function () {
    $key = 'non_existent_option';

    expect(Option::get($key))->toBeNull();
});

test('set option updates the option value', function () {
    $key = 'test_option';
    $value = 'test_value';

    Option::set($key, $value);

    expect(Option::get($key))->toBe($value);
});

test('set option updates multiple options', function () {
    $options = [
        'option1' => 'value1',
        'option2' => 'value2',
    ];

    Option::set($options);

    expect(Option::get('option1'))->toBe('value1');
    expect(Option::get('option2'))->toBe('value2');
});

test('set option creates a new option if it does not exist', function () {
    $key = 'new_option';
    $value = 'new_value';

    Option::set($key, $value);

    expect(Option::get($key))->toBe($value);
});

test('loadAll returns all options from database', function () {
    $options = [
        'option1' => 'value1',
        'option2' => 'value2',
    ];

    Option::set($options);

    expect(Option::loadAll())->toBe([
        'option1' => 'value1',
        'option2' => 'value2',
    ]);
});

test('loadAll returns cached options', function () {
    $options = [
        'option1' => 'value1',
        'option2' => 'value2',
    ];

    Option::set($options);

    // Load options once to cache them
    Option::loadAll();

    // Simulate a database failure
    Option::query()->truncate();

    expect(Option::loadAll())->toBe([
        'option1' => 'value1',
        'option2' => 'value2',
    ]);
});
