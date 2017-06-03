<?php

/*
 * This file is part of the Valkyrja framework.
 *
 * (c) Melech Mizrachi
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Valkyrja\Twig;

use Twig_Environment;
use Valkyrja\Application;
use Valkyrja\View\View;
use Valkyrja\Support\Directory;
use Valkyrja\View\PhpView;

/**
 * Class TwigView.
 *
 * @author Melech Mizrachi
 */
class TwigPhpView extends PhpView
{
    /**
     * The twig environment.
     *
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * View constructor.
     *
     * @param \Valkyrja\Application $app       The application
     * @param Twig_Environment      $twig      The Twig environment
     * @param string                $template  [optional] The template to set
     * @param array                 $variables [optional] The variables to set
     */
    public function __construct(Application $app, Twig_Environment $twig, string $template = '', array $variables = [])
    {
        parent::__construct($app, $template, $variables);

        $this->twig          = $twig;
        $this->fileExtension = $app->config()['twig']['fileExtension'];
    }

    /**
     * Make a new View.
     *
     * @param string $template  [optional] The template to set
     * @param array  $variables [optional] The variables to set
     *
     * @return \Valkyrja\View\View
     */
    public function make(string $template = '', array $variables = []): View
    {
        return new static($this->app, $this->twig, $template, $variables);
    }

    /**
     * Get the template directory.
     *
     * @param string $path [optional] The path to append
     *
     * @return string
     */
    public function getTemplateDir(string $path = null): string
    {
        return $path
            ?: Directory::DIRECTORY_SEPARATOR;
    }

    /**
     * Render the templates and view.
     *
     * @param array $variables [optional] The variables to set
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string
     */
    public function render(array $variables = []): string
    {
        return $this->twig->render($this->getTemplatePath(), $this->variables);
    }
}
