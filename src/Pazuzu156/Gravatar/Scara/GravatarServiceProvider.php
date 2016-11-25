<?php

namespace Pazuzu156\Gravatar\Scara;

use Pazuzu156\Gravatar\Gravatar;
use Scara\Config\Configuration;
use Scara\Support\ServiceProvider;

/**
 * Gravatar Service Provider.
 */
class GravatarServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->create('gravatar', function () {
            $c = new Configuration();
            $cc = $c->from('gravatar');

            return new Gravatar($c->get('defaults.size'), $c->get('secure'));
        });
    }
}
