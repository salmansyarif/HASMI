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
        Schema::table('programs', function (Blueprint $table) {
            if (!Schema::hasColumn('programs', 'photo_position')) {
                $table->string('photo_position')->default('top')->after('video_url');
            }
            if (!Schema::hasColumn('programs', 'show_thumbnail_in_list')) {
                $table->boolean('show_thumbnail_in_list')->default(true)->after('photo_position');
            }
        });

        Schema::table('berita_terkinis', function (Blueprint $table) {
            if (!Schema::hasColumn('berita_terkinis', 'photo_position')) {
                $table->string('photo_position')->default('top')->after('video_url');
            }
            if (!Schema::hasColumn('berita_terkinis', 'show_thumbnail_in_list')) {
                $table->boolean('show_thumbnail_in_list')->default(true)->after('photo_position');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn(['photo_position', 'show_thumbnail_in_list']);
        });

        Schema::table('berita_terkinis', function (Blueprint $table) {
            $table->dropColumn(['photo_position', 'show_thumbnail_in_list']);
        });
    }
};
