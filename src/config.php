<?php

/*
 * This file is part of the Valkyrja framework.
 *
 * (c) Melech Mizrachi
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Valkyrja\Support\Directory;

/*
 *-------------------------------------------------------------------------
 * Twig Views Configuration
 *-------------------------------------------------------------------------
 *
 * //
 *
 */
return [
    /*
     *-------------------------------------------------------------------------
     * Twig Views Compiled Directory Path
     *-------------------------------------------------------------------------
     *
     * //
     *
     */
    'fileExtension' => env()::TWIG_FILE_EXTENSION ?? '.twig',

    /*
     *-------------------------------------------------------------------------
     * Twig Views Directories
     *-------------------------------------------------------------------------
     *
     * //
     *
     */
    'dirs'          => env()::TWIG_DIRS ?? [
            env()::TWIG_DIR_NS ?? Twig_Loader_Filesystem::MAIN_NAMESPACE => env()::TWIG_DIR ?? Directory::resourcesPath('views'),
        ],

    /*
     *-------------------------------------------------------------------------
     * Twig Views Compiled Directory Path
     *-------------------------------------------------------------------------
     *
     * //
     *
     */
    'compiledDir'   => env()::TWIG_COMPILED_DIR ?? Directory::storagePath('views'),

    /*
     *-------------------------------------------------------------------------
     * Twig Views Extensions
     *-------------------------------------------------------------------------
     *
     * //
     *
     */
    'extensions'    => env()::TWIG_EXTENSIONS ?? [],
];
