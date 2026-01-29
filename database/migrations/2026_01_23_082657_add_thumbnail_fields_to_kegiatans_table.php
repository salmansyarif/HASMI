<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->boolean('show_thumbnail_in_list')
                  ->default(true)
                  ->after('content');

            $table->enum('photo_position', ['top', 'bottom'])
                  ->default('top')
                  ->after('show_thumbnail_in_list');
        });
    }

    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn([
                'show_thumbnail_in_list',
                'photo_position'
            ]);
        });
    }
};

