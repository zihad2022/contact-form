<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
final class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'disk' => 'public',
            'directory' => 'media',
            'visibility' => 'public',
            'name' => fake()->word(),
            'path' => fake()->filePath(),
            'width' => fake()->optional()->numberBetween(100, 1920),
            'height' => fake()->optional()->numberBetween(100, 1080),
            'size' => fake()->optional()->numberBetween(1000, 500000),
            'type' => 'image',
            'ext' => fake()->fileExtension,
            'alt' => fake()->optional()->sentence,
            'title' => fake()->optional()->sentence,
            'description' => fake()->optional()->paragraph,
            'caption' => fake()->optional()->paragraph,
            'exif' => [],
            'curations' => [],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
