<?php

namespace Pazuzu156\Gravatar\Scara;

use Scara\Support\Facades\Facade;

/**
 * Gravatar class's facade.
 */
class GravatarFacade extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'gravatar';
    }
}
