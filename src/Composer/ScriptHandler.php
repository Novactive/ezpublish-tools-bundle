<?php
/**
 * File part of the Novactive eZ Publish Tools Bundle
 *
 * @category  Novactive
 * @package   Novactive.EzPublishToolsBundle
 * @author    Guillaume Maïssa <g.maissa@novactive.com>
 * @copyright 2016 Novactive
 * @license   https://opensource.org/licenses/MIT MIT
 */
namespace Novactive\EzPublishToolsBundle\Composer;

use Composer\Script\Event;
use eZ\Bundle\EzPublishCoreBundle\Composer\ScriptHandler as DistributionBundleScriptHandler;

/**
 * eZ Publish Tools Composer Script class
 */
class ScriptHandler extends DistributionBundleScriptHandler
{
    /**
     * {@inheritdoc}
     */
    public static function dumpAssets(Event $event)
    {
        $options     = self::getOptions($event);
        $appDir      = $options['symfony-app-dir'];
        $webDir      = $options['symfony-web-dir'];
        $envFromConf = isset($options['ezpublish-asset-dump-env']) ? $options['ezpublish-asset-dump-env'] : "";
        $env         = getenv('SYMFONY_ENV') ? getenv('SYMFONY_ENV') : $envFromConf;

        if (!$env) {
            $env = $event->getIO()->ask(
                "<question>Which environment would you like to dump production assets for?</question>" .
                " (Default: 'prod', type 'none' to skip) ",
                'prod'
            );
        }

        if ($env === 'none') {
            return;
        }

        if (!is_dir($appDir)) {
            echo 'The symfony-app-dir (' . $appDir . ') specified in composer.json was not found in ' . getcwd() .
                 ', can not install assets.' . PHP_EOL;

            return;
        }

        if (!is_dir($webDir)) {
            echo 'The symfony-web-dir (' . $webDir . ') specified in composer.json was not found in ' . getcwd() .
                 ', can not install assets.' . PHP_EOL;

            return;
        }

        static::executeCommand(
            $event,
            $appDir,
            'assetic:dump --env=' . escapeshellarg($env) . ' ' . escapeshellarg($webDir)
        );
    }
}
