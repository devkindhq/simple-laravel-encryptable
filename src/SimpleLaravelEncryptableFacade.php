<?php

namespace Devkind\SimpleLaravelEncryptable;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Devkind\SimpleLaravelEncryptable\Skeleton\SkeletonClass
 */
class SimpleLaravelEncryptableFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'simple-encryptable';
    }
}
