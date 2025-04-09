<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\CanUploadFromUrl;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Media extends \Awcodes\Curator\Models\Media
{
    /** @use HasFactory<\Database\Factories\MediaFactory> */
    use CanUploadFromUrl, HasFactory;

    protected function thumbnailUrl(): Attribute
    {
        return Attribute::get(fn () => $this->getSignedUrl([
            'w' => 300, 'h' => 300, 'fit' => 'crop', 'fm' => 'webp',
        ]));
    }
}
