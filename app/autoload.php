<?php declare(strict_types=1);

spl_autoload_register(function ($class) {
    $prefix = 'Bloganza\\';

    $path = __DIR__.'/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $class = substr($class, $len);
    $file = $path.str_replace('\\', '/', $class).'.php';

    if (file_exists($file)) {
        require $file;
    }
});
