<?php

namespace Qcovery\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

abstract class VuFindInstallerPlugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new VuFindInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
}