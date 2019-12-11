<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit1b7d202ad01d839050ec4112544e7221
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\AutoloadWPMediaImagifyWordPressPlugin\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit1b7d202ad01d839050ec4112544e7221', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\AutoloadWPMediaImagifyWordPressPlugin\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit1b7d202ad01d839050ec4112544e7221', 'loadClassLoader'));

        $useStaticLoader = PHP_VERSION_ID >= 50600 && !defined('HHVM_VERSION') && (!function_exists('zend_loader_file_encoded') || !zend_loader_file_encoded());
        if ($useStaticLoader) {
            require_once __DIR__ . '/autoload_static.php';

            call_user_func(\Composer\Autoload\ComposerStaticInit1b7d202ad01d839050ec4112544e7221::getInitializer($loader));
        } else {
            $classMap = require __DIR__ . '/autoload_classmap.php';
            if ($classMap) {
                $loader->addClassMap($classMap);
            }
        }

        $loader->setClassMapAuthoritative(true);
        $loader->register(true);

        return $loader;
    }
}
