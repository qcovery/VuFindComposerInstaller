<?php

namespace Qcovery\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class VuFindInstaller extends LibraryInstaller
{
    public function getInstallPath(PackageInterface $package)
    {
        $extra = $package->getExtra();
        if (isset($extra['moduleName']) && $extra['moduleName'] != '') {
            return 'module/'.$extra['moduleName'];
        }
        return 'module';
    }

    public function supports($packageType)
    {
        return 'qcovery-module' === $packageType;
    }
}