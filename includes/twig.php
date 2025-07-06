<?php
spl_autoload_register(function(string $class){
    if (strpos($class, 'Twig\\') === 0) {
        $path = __DIR__.'/thirdparty/Twig-3.21.1/src/'.str_replace('\\','/',substr($class,5)).'.php';
        if (file_exists($path)) {
            require $path;
        }
    }
});
