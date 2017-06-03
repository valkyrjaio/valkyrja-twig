<?php

/*
 * This file is part of the Valkyrja framework.
 *
 * (c) Melech Mizrachi
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Valkyrja\Twig\Providers;

use Valkyrja\Application;
use Valkyrja\Support\Providers\Provider;

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
     * @param \Valkyrja\Application $app The application
     *
     * @return void
     */
    public static function publish(Application $app): void
    {
        if (! isset($app->config()['twig'])) {
            $app->addConfig(
                [
                    'twig' => require __DIR__ . '/../config.php',
                ]
            );
        }
    }
}
