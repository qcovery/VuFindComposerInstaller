<?php

namespace Qcovery\Composer;

use Composer\Package\PackageInterface;

class VuFindDownloadManager extends \Composer\Downloader\DownloadManager
{
    public function install(PackageInterface $package, $targetDir)
    {
        $install =  parent::install($package, $targetDir);
        $this->checkAndInstallTheme($package);
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