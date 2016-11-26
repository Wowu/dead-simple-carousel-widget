<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2b703f5b3c613374c9d31841971fe253
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Timber\\' => 7,
        ),
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Timber\\' => 
        array (
            0 => __DIR__ . '/..' . '/timber/timber/lib',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/..' . '/asm89/twig-cache-extension/lib',
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
        'R' => 
        array (
            'Routes' => 
            array (
                0 => __DIR__ . '/..' . '/upstatement/routes',
            ),
        ),
    );

    public static $classMap = array (
        'AltoRouter' => __DIR__ . '/..' . '/altorouter/altorouter/AltoRouter.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2b703f5b3c613374c9d31841971fe253::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2b703f5b3c613374c9d31841971fe253::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInit2b703f5b3c613374c9d31841971fe253::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit2b703f5b3c613374c9d31841971fe253::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit2b703f5b3c613374c9d31841971fe253::$classMap;

        }, null, ClassLoader::class);
    }
}