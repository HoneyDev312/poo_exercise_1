<?php

declare(strict_types=1);

spl_autoload_register(static function (string $fqcn) {
    $path = str_replace('\\', '/', $fqcn) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

(new App\Cli\CliApp())->run();
