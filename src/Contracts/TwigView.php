<?php

/*
 * This file is part of the Valkyrja framework.
 *
 * (c) Melech Mizrachi
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Valkyrja\Twig\Contracts;

use Twig_Environment;
use Valkyrja\Contracts\View\View;

/**
 * Interface TwigView.
 *
 * @author Melech Mizrachi
 */
interface TwigView extends View
{
    /**
     * Set the twig environment.
     *
     * @param Twig_Environment $twig The twig environment
     *
     * @return \Valkyrja\Twig\Contracts\TwigView
     */
    public function setTwig(Twig_Environment $twig): self;
}
