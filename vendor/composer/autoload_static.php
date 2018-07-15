<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit76faf173bc2acb2269b0703f3646a58a
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'VK\\' => 3,
        ),
        'A' => 
        array (
            'AmoCRM\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'VK\\' => 
        array (
            0 => __DIR__ . '/..' . '/vkcom/vk-php-sdk/src/VK',
        ),
        'AmoCRM\\' => 
        array (
            0 => __DIR__ . '/..' . '/dotzero/amocrm/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit76faf173bc2acb2269b0703f3646a58a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit76faf173bc2acb2269b0703f3646a58a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
