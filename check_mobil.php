<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\ProgramCategory;
use App\Models\Category;
use App\Models\Program;

echo "Program Categories:\n";
foreach (ProgramCategory::all() as $c) {
    echo "- " . $c->name . "\n";
}

echo "\nArticle Categories:\n";
foreach (Category::all() as $c) {
    echo "- " . $c->name . "\n";
}

echo "\nPrograms with 'mobil' in title:\n";
foreach (Program::where('title', 'like', '%mobil%')->get() as $p) {
    echo "- " . $p->title . "\n";
}
