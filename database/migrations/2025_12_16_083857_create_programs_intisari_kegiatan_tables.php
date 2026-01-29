<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // PROGRAM CATEGORIES TABLE (untuk dropdown utama navbar)
        Schema::create('program_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // HASMI PEDULI, PROGRAM DAKWAH, dll
            $table->string('slug')->unique();
            $table->boolean('has_subcategories')->default(false); // true untuk HASMI PEDULI
            $table->boolean('is_creatable')->default(true); // false untuk PROGRAM HASMI dan HASMI TV
            $table->string('redirect_type')->nullable(); // 'static', 'youtube', atau null
            $table->string('redirect_url')->nullable(); // URL redirect jika ada
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // PROGRAM SUBCATEGORIES TABLE (untuk dropdown kedua)
        Schema::create('program_subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_category_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Tebar Pangan, Tebar Al Qur'an, dll
            $table->string('slug');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->unique(['program_category_id', 'slug']);
        });

        // PROGRAMS TABLE (data program actual yang bisa di-create admin)
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('program_subcategory_id')->nullable()->constrained()->onDelete('cascade');
            
            // Basic Info
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->longText('content')->nullable();

            // Media
            $table->enum('media_type', ['image', 'video'])->default('image');
            $table->string('thumbnail')->nullable();
            $table->json('photos')->nullable(); // untuk multiple images
            $table->string('video_url')->nullable(); // YouTube URL atau file path

            // Display Settings
            $table->enum('media_position', ['top', 'left', 'right', 'bottom'])->default('top');
            $table->integer('position')->default(0); // untuk ordering
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });

        // INTISARIS
        Schema::create('intisaris', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('thumbnail')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // KEGIATANS
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->longText('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('photos')->nullable();
            $table->date('event_date')->nullable();
            $table->string('location')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kegiatans');  
        Schema::dropIfExists('intisaris');
        Schema::dropIfExists('programs');
        Schema::dropIfExists('program_subcategories');
        Schema::dropIfExists('program_categories');
    }
};