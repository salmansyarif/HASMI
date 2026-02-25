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
        Schema::table('berita_terkinis', function (Blueprint $table) {
            if (!Schema::hasColumn('berita_terkinis', 'show_thumbnail_in_detail')) {
                $table->boolean('show_thumbnail_in_detail')->default(true)->after('show_thumbnail_in_list');
            }
        });

        Schema::table('programs', function (Blueprint $table) {
            if (!Schema::hasColumn('programs', 'show_thumbnail_in_detail')) {
                $table->boolean('show_thumbnail_in_detail')->default(true)->after('show_thumbnail_in_list');
            }
        });

        Schema::table('kegiatans', function (Blueprint $table) {
            if (!Schema::hasColumn('kegiatans', 'show_thumbnail_in_detail')) {
                $table->boolean('show_thumbnail_in_detail')->default(true)->after('thumbnail');
            }
            if (!Schema::hasColumn('kegiatans', 'show_thumbnail_in_list')) {
                $table->boolean('show_thumbnail_in_list')->default(true)->after('thumbnail');
            }
            if (!Schema::hasColumn('kegiatans', 'photo_position')) {
                $table->string('photo_position')->default('top')->after('thumbnail');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita_terkinis', function (Blueprint $table) {
            $table->dropColumn('show_thumbnail_in_detail');
        });

        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn('show_thumbnail_in_detail');
        });

        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn(['show_thumbnail_in_detail', 'show_thumbnail_in_list', 'photo_position']);
        });
    }
};
