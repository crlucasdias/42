<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbf47801818f62c9890eabadf765f5c7f
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbf47801818f62c9890eabadf765f5c7f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbf47801818f62c9890eabadf765f5c7f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
