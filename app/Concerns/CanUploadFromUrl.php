<?php

declare(strict_types=1);

namespace App\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use RuntimeException;

use function Awcodes\Curator\is_media_resizable;

trait CanUploadFromUrl
{
    public static function uploadFromUrl(
        string $url,
        ?string $name = null,
        ?string $directory = null,
        ?string $disk = null,
        ?string $visibility = null,
    ): Model {
        $response = Http::get($url);

        if (! $response->ok()) {
            throw new RuntimeException('Unable to fetch file from URL.');
        }

        $pathinfo = pathinfo(parse_url($url, PHP_URL_PATH));
        $disk ??= config('curator.disk');
        $visibility ??= config('curator.visibility');
        $directory ??= config('curator.directory');
        $contentType = $response->header('content-type');

        if (! in_array($contentType, config('curator.accepted_file_types'))) {
            throw new RuntimeException('Unsupported file type.');
        }

        if (! isset($pathinfo['extension'])) {
            $pathinfo['extension'] = explode('/', $contentType)[1];
        }

        if (is_null($name)) {
            $name = config('curator.should_preserve_filenames')
                ? Str::slug($pathinfo['filename'])
                : Str::uuid()->toString();
        }

        $filePath = sprintf('%s/%s.%s', $directory, $name, $pathinfo['extension']);

        if (! Storage::disk($disk)->put($filePath, $response->body(), compact('visibility'))) {
            throw new RuntimeException('Unable to write file to disk.');
        }

        $file = new UploadedFile(
            Storage::disk($disk)->path($filePath),
            $name
        );

        if (is_media_resizable($file->getMimeType())) {
            $image = Image::make($file->path());
            $image->orientate();
            $width = $image->width();
            $height = $image->height();
            $exif = $image->exif();
        }

        $mediaInfo = [
            'disk' => $disk,
            'directory' => $directory,
            'visibility' => $visibility,
            'name' => $name,
            'path' => $filePath,
            'exif' => $exif ?? null,
            'width' => $width ?? null,
            'height' => $height ?? null,
            'size' => $file->getSize(),
            'type' => $file->getMimeType(),
            'ext' => $file->extension(),
        ];

        return static::create([
            'file' => $mediaInfo,
            'title' => $name,
        ]);
    }
}
