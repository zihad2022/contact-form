<?php

declare(strict_types=1);

use App\Models\Page;

test('to array', function () {
    $option = Page::factory()->create()->fresh();

    expect(array_keys($option->toArray()))->toBe([
        'id',
        'parent_id',
        'title',
        'slug',
        'content',
        'is_visible',
        'created_at',
        'updated_at',
    ]);
});
