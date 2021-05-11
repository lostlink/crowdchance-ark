<?php

namespace Lostlink\CrowdchanceArk;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lostlink\LaravelBlockchain\LaravelBlockchain
 */
class CrowdchanceArkFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'crowdchance_ark';
    }
}
