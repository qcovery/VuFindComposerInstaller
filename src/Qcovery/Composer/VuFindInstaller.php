<?php

namespace Qcovery\Composer;

use Composer\Composer;
use Composer\Installer\BinaryInstaller;
use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
use Composer\Repository\InstalledRepositoryInterface;
use Composer\Util\Filesystem;
use React\Promise\PromiseInterface;

class VuFindInstaller extends LibraryInstaller
{
    public function __construct(IOInterface $io, Composer $composer, $type = 'library', Filesystem $filesystem = null, BinaryInstaller $binaryInstaller = null)
    {
        $composer->setDownloadManager(new VuFindDownloadManager($io, false, $filesystem));
        parent::__construct($io, $composer, $type, $filesystem, $binaryInstaller);
    }

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

    /* public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        $installed = parent::install($repo, $package);
        $this->checkAndInstallTheme($package);
        return $installed;
    }

    public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $target)
    {
        $update = parent::update($repo, $initial, $target);
        $this->checkAndInstallTheme($target);
        return $update;
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
    } */
}