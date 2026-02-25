<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    Schema::table('articles', function (Blueprint $table) {
        $table->enum('media_type', ['image', 'video'])->default('image')->nullable()->after('content');
        $table->json('photos')->nullable()->after('media_type');
        $table->string('video_url')->nullable()->after('photos');
        $table->string('media_position')->default('top')->after('video_url');
    });
    echo "Columns added successfully!\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
