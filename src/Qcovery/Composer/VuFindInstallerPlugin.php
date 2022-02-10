<?php

namespace Qcovery\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class VuFindInstallerPlugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new VuFindInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
    }
}