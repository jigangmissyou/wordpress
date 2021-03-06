<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6084b9e55aa3806f1ad45ed5cd39b9ee
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        '8b0d424e6572b6620fcae6008af510ef' => __DIR__ . '/..' . '/htmlburger/wpemerge/config.php',
        '270cb6edcaac5923bab5c49ecf5fbd06' => __DIR__ . '/..' . '/htmlburger/wpemerge/src/functions.php',
        '3336c9935fd0994a30e8c7cc51ee93a7' => __DIR__ . '/..' . '/htmlburger/wpemerge/src/load.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WPEmerge\\' => 9,
            'WPEmergeTestTools\\' => 18,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Container\\' => 14,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WPEmerge\\' => 
        array (
            0 => __DIR__ . '/..' . '/htmlburger/wpemerge/src',
        ),
        'WPEmergeTestTools\\' => 
        array (
            0 => __DIR__ . '/..' . '/htmlburger/wpemerge/tests/tools',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Pimple' => 
            array (
                0 => __DIR__ . '/..' . '/pimple/pimple/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6084b9e55aa3806f1ad45ed5cd39b9ee::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6084b9e55aa3806f1ad45ed5cd39b9ee::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit6084b9e55aa3806f1ad45ed5cd39b9ee::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
