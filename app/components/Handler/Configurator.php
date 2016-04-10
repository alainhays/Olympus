<?php

namespace Olympus\Handler;

use Composer\Script\Event;

/**
 * Gets its own config via composer, inspired from Incenteev ParameterHandler script.
 * @see https://github.com/Incenteev/ParameterHandler
 *
 * @package Olympus
 * @subpackage Handler\Configurator
 * @author Achraf Chouk <achrafchouk@gmail.com>
 * @since 0.0.3
 *
 */

class Configurator
{
    /**
     * Build files on Composer install / update.
     *
     * @since 0.0.3
     */
    public static function build(Event $event)
    {
        // Instanciate Processor
        $processor = new Processor($event->getIO());
        $vendor = $event->getComposer()->getConfig()->get('vendor-dir');

        // Build `env.php` file
        $processor->processEnv(dirname($vendor).'/app/config/env.php');

        // Build `salt.php` file
        $processor->processSalt(dirname($vendor).'/app/config/salt.php');

        // Build `config.rb` file
        $processor->processConfig(dirname($vendor).'/app/deploy/config.rb');
    }
}