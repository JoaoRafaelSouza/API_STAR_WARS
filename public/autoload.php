<?php
spl_autoload_register(function ($class) {
    $prefixes = [
        'Controllers\\' => __DIR__ . '/Controllers/',
        'Models\\' => __DIR__ . '/Models/',
        'DAOS\\' => __DIR__ . '/DAOS/'
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        if (strpos($class, $prefix) === 0) {
            $relativeClass = substr($class, strlen($prefix));
            $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
            if (file_exists($file)) {
                require $file;
            }
        }
    }
});