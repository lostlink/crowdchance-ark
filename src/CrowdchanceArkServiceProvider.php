<?php

namespace Lostlink\CrowdchanceArk;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CrowdchanceArkServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('crowdchance_ark')
            ->hasConfigFile()
            ->hasViews();
    }
}
