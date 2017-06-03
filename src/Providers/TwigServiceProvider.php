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

use Twig_Environment;
use Twig_Loader_Filesystem;
use Valkyrja\Application;
use Valkyrja\View\View;
use Valkyrja\Support\Providers\Provider;
use Valkyrja\Twig\TwigPhpView;

/**
 * Class TwigServiceProvider.
 */
class TwigServiceProvider extends Provider
{
    /**
     * The items provided by this provider.
     *
     * @return array
     */
    public static function provides(): array
    {
        return [
            Twig_Environment::class,
            View::class,
        ];
    }

    /**
     * Publish the provider.
     *
     * @param \Valkyrja\Application $app The application
     *
     * @throws \Twig_Error_Loader
     *
     * @return void
     */
    public static function publish(Application $app): void
    {
        static::bindTwigEnvironment($app);
        static::bindTwigView($app);
    }

    /**
     * Bind the twig environment to the container.
     *
     * @param \Valkyrja\Application $app The application
     *
     * @throws \Twig_Error_Loader
     *
     * @return void
     */
    protected static function bindTwigEnvironment(Application $app): void
    {
        // Get the twig filesystem loader
        $loader = new Twig_Loader_Filesystem();

        // Iterate through the dirs and add each as a path in the twig loader
        foreach ($app->config()['twig']['dirs'] as $namespace => $dir) {
            $loader->addPath($dir, $namespace);
        }

        // Create a new twig environment
        $twig = new Twig_Environment(
            $loader,
            [
                'cache'   => $app->config()['twig']['compiledDir'],
                'debug'   => $app->debug(),
                'charset' => 'utf-8',
            ]
        );

        // Iterate through the extensions
        foreach ($app->config()['twig']['extensions'] as $extension) {
            // And add each extension to the twig environment
            $twig->addExtension(new $extension());
        }

        // Set the twig environment as a singleton in the container
        $app->container()->singleton(
            Twig_Environment::class,
            $twig
        );
    }

    /**
     * Bind the twig view as the view in the container.
     *
     * @param \Valkyrja\Application $app The application
     *
     * @return void
     */
    protected static function bindTwigView(Application $app): void
    {
        $app->container()->singleton(
            View::class,
            self::getTwigView($app)
        );
    }

    /**
     * Get the twig view when building a service container item.
     *
     * @param \Valkyrja\Application $app The application
     *
     * @return \Valkyrja\Twig\TwigPhpView
     */
    public static function getTwigView(Application $app): TwigPhpView
    {
        return new TwigPhpView(
            $app,
            $app->container()->getSingleton(Twig_Environment::class)
        );
    }
}
