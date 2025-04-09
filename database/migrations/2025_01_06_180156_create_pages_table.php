<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('pages')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title')->index();
            $table->string('slug');
            $table->longText('content');
            $table->boolean('is_visible')->default(true);
            $table->timestamps();

            $table->unique(['slug', 'parent_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
};
