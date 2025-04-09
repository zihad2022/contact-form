<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ContactController
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'design_name' => 'required|string|max:255',
            'organization_type' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'color_preference' => 'nullable|array',
            'color_preference.*' => 'string',
            'logo_type' => 'required|string|max:255',
            'additional_logo_services' => 'required|string|max:255',
            'file_formats' => 'nullable|array',
            'file_formats.*' => 'string',
            'occupation' => 'nullable|string|max:255',
            'image_or_draft' => 'nullable|file|mimes:jpg,png,pdf,ai,psd|max:2048',
            'additional_info' => 'nullable|string|max:500',
            'advance_payment' => 'required|string|max:255',
            'payment_option' => 'required|string|max:255',
            'transaction_number' => 'required|string|max:255',
            'transaction_screenshot' => 'nullable|file|mimes:jpg,png|max:2048',
            'reference_name' => 'nullable|string|max:255',
            'services' => 'nullable|array',
            'services.*' => 'string',
        ]);

        $contact = new Contact();

        // Handle file uploads
        if ($request->hasFile('image_or_draft')) {
            $contact->image_or_draft = $this->imageService->uploadImage($request->file('image_or_draft'), 'uploads'
            );
        }
        if ($request->hasFile('transaction_screenshot')) {
            $contact->transaction_screenshot = $this->imageService->uploadImage($request->file('transaction_screenshot'), 'uploads'
            );
        }

        // Exclude sensitive fields from mass assignment
        $contact->fill($request->except([
            '_token',
            '_method',
            'image_or_draft',
            'transaction_screenshot',
        ]));

        // Convert arrays to JSON
        $contact->color_preference = $request->color_preference ?? [];
        $contact->file_formats = $request->file_formats ?? [];
        $contact->services = $request->services ?? [];

        $contact->save();

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
