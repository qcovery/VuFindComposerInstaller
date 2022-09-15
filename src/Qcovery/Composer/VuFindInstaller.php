<?php

namespace Qcovery\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
use Composer\Repository\InstalledRepositoryInterface;
use Composer\Util\Filesystem;
use React\Promise\PromiseInterface;

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

    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        $installed = parent::install($repo, $package);
        $this->checkAndInstallTheme($package);
        return $installed;
    }

    public function cleanup($type, PackageInterface $package, PackageInterface $prevPackage = null)
    {
        $cleanUp = parent::cleanup($type, $package, $prevPackage);
        $this->checkAndInstallTheme($package);
        return $cleanUp;
    }

    public function isInstalled(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        $isInstalled = parent::isInstalled($repo, $package);
        $this->checkAndInstallTheme($package);
        return $isInstalled;
    }

    private function checkAndInstallTheme($package) {
        if (file_exists($this->getInstallPath($package).'/theme/')) {
            $extra = $package->getExtra();
            if (isset($extra['moduleName']) && $extra['moduleName'] != '') {
                rename($this->getInstallPath($package).'/theme/', 'theme/'.strtolower($extra['moduleName']));
            }
        }
    }
}