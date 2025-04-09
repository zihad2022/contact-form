<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'mobile_number',
        'email',
        'design_name',
        'organization_type',
        'slogan',
        'color_preference',
        'logo_type',
        'additional_logo_services',
        'file_formats',
        'occupation',
        'image_or_draft',
        'additional_info',
        'advance_payment',
        'payment_option',
        'transaction_number',
        'transaction_screenshot',
        'reference_name',
        'services',
    ];

    protected $casts = [
        'color_preference' => 'array',
        'file_formats' => 'array',
        'services' => 'array',
    ];
}
