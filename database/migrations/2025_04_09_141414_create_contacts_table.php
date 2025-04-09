<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile_number');
            $table->string('email')->nullable();
            $table->string('design_name');
            $table->string('organization_type');
            $table->string('slogan')->nullable();
            $table->json('color_preference')->nullable();
            $table->string('logo_type');
            $table->string('additional_logo_services');
            $table->json('file_formats')->nullable();
            $table->string('occupation')->nullable();
            $table->string('image_or_draft')->nullable();
            $table->text('additional_info')->nullable();
            $table->string('advance_payment');
            $table->string('payment_option');
            $table->string('transaction_number');
            $table->string('transaction_screenshot')->nullable();
            $table->string('reference_name')->nullable();
            $table->json('services')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
