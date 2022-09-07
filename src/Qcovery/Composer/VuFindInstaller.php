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

    protected function installCode(PackageInterface $package)
    {
        $codeInstalled = parent::installCode($package);
        if ($codeInstalled) {
            if (isset($extra['themeName']) && $extra['themeName'] != '') {
                rename($this->getInstallPath().'/theme/'.$extra['themeName'], 'theme/'.strtolower($extra['themeName']));
            }
        }
        return $codeInstalled;
    }
}