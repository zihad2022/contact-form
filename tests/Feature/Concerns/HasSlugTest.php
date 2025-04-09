<?php

declare(strict_types=1);

use App\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    // Create a test model that uses the HasSlug trait
    $this->model = new class extends Model
    {
        use HasSlug;

        protected $fillable = ['name', 'slug'];

        protected $table = 'test_models';

        protected function sluggable(): string
        {
            return 'name';
        }
    };

    // Create the table schema
    Schema::create('test_models', function ($table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->timestamps();
    });
});

afterEach(function () {
    Schema::drop('test_models');
});

it('finds a model by its slug', function () {
    $this->model->create(['name' => 'Test Model', 'slug' => 'test-model']);

    $foundModel = $this->model::findBySlug('test-model');

    expect($foundModel)->not->toBeNull();
    expect($foundModel->slug)->toBe('test-model');
});

it('throws an exception if the model is not found by slug', function () {
    $this->model->create(['name' => 'Test Model', 'slug' => 'test-model']);

    $this->model::findBySlugOrFail('non-existent-slug');
})->throws(ModelNotFoundException::class);

it('generates a unique slug', function () {
    $this->model->create(['name' => 'Test Model', 'slug' => 'test-model']);

    $uniqueSlug = $this->model::generateUniqueSlug('Test Model');

    expect($uniqueSlug)->toBe('test-model-1');
});

it('returns null if the string to slugify is null', function () {
    $slug = $this->model::generateUniqueSlug(null);

    expect($slug)->toBeNull();
});

it('scopes the query to find a model by slug', function () {
    $this->model->create(['name' => 'Test Model', 'slug' => 'test-model']);

    $query = $this->model->whereSlug('test-model')->first();

    expect($query)->not->toBeNull();
    expect($query->slug)->toBe('test-model');
});
