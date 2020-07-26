<?php

namespace App\Providers;

use Pimple\Container;
use \Pimple\ServiceProviderInterface;

abstract class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $container
     * @return mixed
     */
    abstract public function register(Container $container);
}