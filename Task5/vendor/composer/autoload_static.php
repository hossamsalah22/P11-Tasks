<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcc62d803b307f5468e9fa808253a0e57
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

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcc62d803b307f5468e9fa808253a0e57::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcc62d803b307f5468e9fa808253a0e57::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcc62d803b307f5468e9fa808253a0e57::$classMap;

        }, null, ClassLoader::class);
    }
}
