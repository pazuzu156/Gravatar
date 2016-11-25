<?php

// this file is only used if you are not using Composer.
// Why the hell are you NOT using Composer? Are you insane????!!? ;)

// This autoloader is crap, but that's because I'm not going to re-create one...
spl_autoload_register(function ($class) {
    require_once __DIR__.'/../../'.$class.'.php';
});
