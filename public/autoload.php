<?php
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/Controllers/' . $class . '.php',
        __DIR__ . '/Models/' . $class . '.php',
        __DIR__ . '/DAOS/' . $class . '.php'
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
        }
    }
});