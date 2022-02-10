<?php

namespace Qcovery\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class VuFindInstaller extends LibraryInstaller
{
    public function getInstallPath(PackageInterface $package)
    {
        $extra = $package->getExtra();
        if (!isset($extra['moduleName']) || $extra['moduleName'] == '') {
            throw new \InvalidArgumentException('Extra field moduleName is not set');
        }
        return 'module/'.$extra['moduleName'];
    }

    public function supports($packageType)
    {
        return 'qcovery-module' === $packageType;
    }
}