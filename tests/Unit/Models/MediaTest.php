<?php

declare(strict_types=1);

use App\Models\Media;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

beforeEach(function () {
    Storage::fake('public');
    $this->media = Media::factory()->create();
});

it('can create a media record', function () {
    expect($this->media)->toBeInstanceOf(Media::class);
    expect($this->media->exists)->toBeTrue();
});

it('has the correct default values', function () {
    expect($this->media->disk)->toBe('public');
    expect($this->media->directory)->toBe('media');
    expect($this->media->visibility)->toBe('public');
    expect($this->media->type)->toBe('image');
});

it('can have optional attributes', function () {
    $media = Media::factory()->create([
        'alt' => 'Sample Alt Text',
        'title' => 'Sample Title',
    ]);

    expect($media->alt)->toBe('Sample Alt Text');
    expect($media->title)->toBe('Sample Title');
});

it('can update a media record', function () {
    $this->media->update(['name' => 'Updated Name']);
    expect($this->media->fresh()->name)->toBe('Updated Name');
});

it('can delete a media record', function () {
    $this->media->delete();
    expect(Media::find($this->media->id))->toBeNull();
});

it('can get the thumbnail url', function () {
    expect($this->media->thumbnail_url)->toBeString();
});

it('can upload a file from a URL', function () {
    $url = 'https://via.placeholder.com/150';

    Http::fake([
        $url => Http::response('empty file content', 200, [
            'content-type' => 'image/jpeg',
        ]),
    ]);

    $file = Media::uploadFromUrl($url);

    expect($file)->toBeInstanceOf(Media::class);
});

it('throws an exception for an invalid URL', function () {
    $url = 'https://example.com/nonexistent.jpg';
    Http::fake([
        $url => Http::response(null, 404),
    ]);

    $this->expectException(RuntimeException::class);
    $this->expectExceptionMessage('Unable to fetch file from URL.');

    Media::uploadFromUrl($url);
});

it('throws an exception for an unsupported file type', function () {
    $url = 'https://via.placeholder.com/150';
    Http::fake([
        $url => Http::response(null, 200),
    ]);

    $this->expectException(RuntimeException::class);
    $this->expectExceptionMessage('Unsupported file type.');

    Media::uploadFromUrl($url);
});

it('throws an exception when unable to write file to disk', function () {
    // Mock the HTTP request and response
    $url = 'https://example.com/sample.jpg';
    $fileContent = 'test file content';
    Http::fake([
        $url => Http::response($fileContent, 200, [
            'content-type' => 'image/jpeg',
        ]),
    ]);

    // Simulate disk storage failure
    Storage::shouldReceive('disk')
        ->once()
        ->with('public')
        ->andReturn(Mockery::mock()
            ->shouldReceive('put')
            ->once()
            ->with('uploads/sample.jpg', 'test file content', ['visibility' => 'public'])
            ->andReturn(false)
            ->getMock()
        );

    // Expect an exception
    $this->expectException(RuntimeException::class);
    $this->expectExceptionMessage(__('Unable to write file to disk.'));

    // Call the method
    Media::uploadFromUrl($url, 'sample', 'uploads', 'public', 'public');
});

it('preserves the filename when should_preserve_filenames is true', function () {
    // Mock the config
    Config::set('curator.should_preserve_filenames', true);

    // Mock the URL and expected filename
    $url = 'https://example.com/sample-file.jpg';
    $pathinfo = pathinfo(parse_url($url, PHP_URL_PATH));
    $expectedName = Str::slug($pathinfo['filename']);
    $fileContent = 'test file content';
    Http::fake([
        $url => Http::response($fileContent, 200, [
            'content-type' => 'image/jpeg',
        ]),
    ]);

    // Call the method with name as null
    $media = Media::uploadFromUrl($url);

    // Assert that the name is the slug of the filename
    expect($media->name)->toBe($expectedName);
});
