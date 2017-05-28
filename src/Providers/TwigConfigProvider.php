<?php

namespace Valkyrja\Twig\Providers;

use Valkyrja\Contracts\Application;
use Valkyrja\Support\Provider;

/**
 * Class TwigConfigProvider.
 */
class TwigConfigProvider extends Provider
{
    /**
     * The items provided by this provider.
     *
     * @return array
     */
    public static function provides(): array
    {
        return [];
    }

    /**
     * Publish the provider.
     *
     * @param \Valkyrja\Contracts\Application $app The application
     *
     * @return void
     */
    public static function publish(Application $app): void
    {
        if (! isset($app->config()['twig'])) {
            $app->addConfig(require __DIR__ . '/../config.php');
        }
    }
}
