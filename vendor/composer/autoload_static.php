<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit475c9e502e872630512abecc30f594b1
{
    public static $prefixLengthsPsr4 = array (
        'o' => 
        array (
            'oukhennicheabdelkrim\\KikimR\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'oukhennicheabdelkrim\\KikimR\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit475c9e502e872630512abecc30f594b1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit475c9e502e872630512abecc30f594b1::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
