<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$tables = ['articles', 'programs', 'kegiatans', 'berita_terkinis'];
$output = [];

foreach ($tables as $table) {
    try {
        $cols = DB::select("DESCRIBE $table");
        $output[$table] = array_map(fn($c) => $c->Field, $cols);
    } catch (\Exception $e) {
        $output[$table] = "Error: " . $e->getMessage();
    }
}

$migrations = DB::table('migrations')->orderBy('id', 'desc')->limit(20)->get();
$output['latest_migrations'] = $migrations;

echo json_encode($output, JSON_PRETTY_PRINT);
