# Gravatar
[![StyleCI](https://styleci.io/repos/74735391/shield?branch=master)](https://styleci.io/repos/74735391)
[![Latest Stable Version](https://poser.pugx.org/pazuzu156/gravatar/v/stable?format=flat-square)](https://packagist.org/packages/pazuzu156/gravatar)
[![Downloads](https://img.shields.io/packagist/dt/pazuzu156/gravatar.svg?style=flat-square)](https://packagist.org/packages/pazuzu156/gravatar)
[![Libraries.io for GitHub](https://img.shields.io/librariesio/github/pazuzu156/gravatar.svg?style=flat-square)](https://libraries.io/github/pazuzu156/Gravatar)
[![Packagist](https://img.shields.io/packagist/l/pazuzu156/gravatar.svg?style=flat-square)](https://packagist.org/packages/pazuzu156/gravatar)

The Gravatar library is built to get user avatars and profile information. The library is built to work as is, with Scara v1.03, AND with Laravel 5

## Installing
To install, either download the source code, or use Composer.

### Source
After downloading, point to the built in autoloader and include the Gravatar class.

```php
<?php
...
require_once __DIR__.'/path/to/src/Pazuzu156/Gravatar/autoload.php';
use Pazuzu156\Gravatar\Gravatar
...
```

### Composer
Use Composer and install the library, then include the new autoloader and the Gravatar class.

```shell
$ composer require pazuzu156/gravatar ^1.0
```

```php
<?php
...
require_once __DIR__.'/vendor/autoload.php';
use Pazuzu156\Gravatar\Gravatar
...
```

The Avatar and Profile classes are grabbed from the master Gravatar class, so there is no need

## Using
Please refer to the wiki (not currently complete) or view the source code. It's properly documented, I promise :)

### Usage in Scara

To use the library with Scara, you need to add the service provider and facade in Scara's configuration

```php
...
'services' => [
    'Pazuzu156\Gravatar\Scara\GravatarServiceProvider',
],
...
'aliases' => [
    'Gravatar' => 'Pazuzu156\Gravatar\Scara\GravatarFacade',
],
...
```

Then you can use the Facade within your application

```php
$img = Gravatar::avatar()->img('email@domain.com');
$src = Gravatar::avatar()->src('email@domain.com');
```

### Usage in Laravel

To use the library with Laravel, you need to add the service provider and facade in Laravel's configuration

```php
...
'providers' => [
    Pazuzu156\Gravatar\Scara\GravatarServiceProvider::class,
],
...
'aliases' => [
    'Gravatar' => Pazuzu156\Gravatar\Scara\GravatarFacade::class,
],
...
```

Then you can use the Facade within your application

```php
$img = Gravatar::avatar()->img('email@domain.com');
$src = Gravatar::avatar()->src('email@domain.com');
```

## License
This library is licensed under the MIT license (basically the most free and open OSS license ;))
