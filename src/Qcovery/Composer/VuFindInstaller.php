<?php

namespace Qcovery\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class VuFindInstaller extends LibraryInstaller
{
    public function getInstallPath(PackageInterface $package)
    {
        if (!isset($package->getExtra()->moduleName) || $package->getExtra()->moduleName == '') {
            throw new \InvalidArgumentException('Extra field moduleName is not set');
        }
        return 'module/'.$package->getExtra()->moduleName;
    }

    public function supports($packageType)
    {
        return 'qcovery-module' === $packageType;
    }
}