<?php

namespace Qcovery\Composer;

use Composer\Composer;
use Composer\DependencyResolver\Operation\InstallOperation;
use Composer\Installer\BinaryInstaller;
use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
use Composer\Repository\InstalledRepositoryInterface;
use Composer\Util\Filesystem;
use Composer\Util\SyncHelper;
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
        $this->io->writeError('install');
        SyncHelper::await($this->composer->getLoop(), $installed);
        $this->checkAndInstallTheme($package);
        return $installed;
    }

    public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $target)
    {
        $update = parent::update($repo, $initial, $target);
        $this->io->writeError('update');
        $this->checkAndInstallTheme($target);
        return $update;
    }

    public function cleanup($type, PackageInterface $package, PackageInterface $prevPackage = null)
    {
        $cleanUp = parent::cleanup($type, $package, $prevPackage);
        $this->io->writeError('cleanup');
        $this->checkAndInstallTheme($package);
        return $cleanUp;
    }

    private function checkAndInstallTheme($package) {
        $this->io->writeError('checkAndInstallTheme');
        if (file_exists($this->getInstallPath($package).'/theme/')) {
            $this->io->writeError('file_exists');
            $extra = $package->getExtra();
            if (isset($extra['moduleName']) && $extra['moduleName'] != '') {
                $this->io->writeError('extra');
                rename($this->getInstallPath($package).'/theme/', 'theme/'.strtolower($extra['moduleName']));
            }
        }
    }
}