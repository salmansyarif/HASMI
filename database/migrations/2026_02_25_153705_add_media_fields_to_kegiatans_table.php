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
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->string('video_url')->nullable()->after('photos');
            // Update enum photo_position to include 'middle'
            $table->enum('photo_position', ['top', 'middle', 'bottom', 'none'])->default('top')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn(['video_url']);
            $table->enum('photo_position', ['top', 'bottom'])->default('top')->change();
        });
    }
};
