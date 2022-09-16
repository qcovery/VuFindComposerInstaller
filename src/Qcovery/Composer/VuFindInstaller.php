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
        SyncHelper::await($this->composer->getLoop(), $installed);
        $this->checkAndInstallTheme($package);
        $this->checkAndAddVuFindConfig($package);
        return $installed;
    }

    public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $target)
    {
        $update = parent::update($repo, $initial, $target);
        SyncHelper::await($this->composer->getLoop(), $update);
        $this->checkAndInstallTheme($target);
        $this->checkAndAddVuFindConfig($target);
        return $update;
    }

    private function checkAndInstallTheme($package) {
        $themeDir = $this->getInstallPath($package).'/theme/';
        if (file_exists($themeDir)) {
            $extra = $package->getExtra();
            if (isset($extra['moduleName']) && $extra['moduleName'] != '') {
                rename($themeDir, 'themes/'.strtolower($extra['moduleName']));
            }
        }
    }

    private function checkAndAddVuFindConfig($package) {
        $configDir = $this->getInstallPath($package).'/config/vufind/';
        if (file_exists($configDir)) {
            $configFiles = scandir($configDir);
            foreach ($configFiles as $configFile) {
                if (in_array($configFile, ['.', '..'])) {
                    continue;
                }
                rename($configDir.$configFile, 'config/vufind/'.$configFile);
            }
            rmdir($configDir);
        }
    }
}