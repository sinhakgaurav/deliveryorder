<?php

namespace Core;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class Container {

    static $container;

    /**
     * Loads the dependency services required throughout the application
     */
    static public function loadDependency() {
        self::$container = new ContainerBuilder();
        $loader = new YamlFileLoader(self::$container, new FileLocator(__DIR__ . '/../app/config/'));
        $loader->load('services.yml');
    }

    /**
     * Gets the container to resolve dependencies
     * @return mixed
     */
    static public function getContainer() {
        return self::$container;
    }

}
