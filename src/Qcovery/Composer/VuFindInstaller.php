<?php

namespace Qcovery\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class VuFindInstaller extends LibraryInstaller
{
    public function getInstallPath(PackageInterface $package)
    {
        //$extra = $package->getExtra();
        /* if (!$extra->moduleName || $extra->moduleName == '') {
            throw new \InvalidArgumentException(print_r($extra, true));
        } */
        return 'module/Qcovery/'; //.$extra->moduleName;
    }

    public function supports($packageType)
    {
        return 'qcovery-module' === $packageType;
    }
}