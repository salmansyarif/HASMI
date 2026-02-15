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
        Schema::table('articles', function (Blueprint $table) {
            $table->enum('media_type', ['image', 'video'])->default('image')->nullable()->after('content');
            $table->json('photos')->nullable()->after('media_type');
            $table->string('video_url')->nullable()->after('photos');
            $table->string('media_position')->default('top')->after('video_url'); // 'top', 'bottom', 'middle' (if needed)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['media_type', 'photos', 'video_url', 'media_position']);
        });
    }
};
