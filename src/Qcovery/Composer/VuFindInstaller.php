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

    public function cleanup($type, PackageInterface $package, PackageInterface $prevPackage = null)
    {
        $cleanUp = parent::cleanup($type, $package, $prevPackage);
        //if ($cleanUp) {
            $extra = $package->getExtra();
            if (isset($extra['moduleName']) && $extra['moduleName'] != '') {
                if (file_exists($this->getInstallPath($package) . '/theme/')) {
                    rename($this->getInstallPath($package) . '/theme/', 'themes/' . strtolower($extra['moduleName']));
                }
            }
        //}
        return $cleanUp;
    }
}