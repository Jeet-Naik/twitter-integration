<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit50eab60a55636d9e1c4e4a99af5bce03
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'TwitterAPIExchange' => __DIR__ . '/..' . '/j7mbo/twitter-api-php/TwitterAPIExchange.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit50eab60a55636d9e1c4e4a99af5bce03::$classMap;

        }, null, ClassLoader::class);
    }
}
