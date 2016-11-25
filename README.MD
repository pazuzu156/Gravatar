# Gravatar
[![StyleCI](https://styleci.io/repos/74735391/shield?branch=master)](https://styleci.io/repos/74735391)

This Gravatar library is built to be simple to use AND integrate into my own framework as well as Laravel 5.

## Default Use

Create a new Gravatar instance

```php
$g = new \Pazuzu156\Gravatar\Gravatar();
```

And either get the source URL

```php
$src = $g->src('email@domain.com');
```

or get the HTML image

```php
$img = $g->img('email@domain.com');
```

## Setting extra options
To set extra options before generation, use the following. (All can be chained together too!)

#### `setEmail()`

`setEmail` can be used to set the user's email address

**NOTE:** While `img()` has an optional `$email` parameter, `src()` requires you supply the email. So `setEmail()` is not needed if all you want is the source URL

#### `setImageSet()`

`setImageSet` sets the image set for the requested Gravatar image. Refer to `IImage` for available image sets

#### `setRating()`

`setRating` sets the max rating for the requested Gravatar image. Reger to `IImage` for available ratings

#### `setSize()`

`setSize` sets the size of the requested Gravatar image. (The default is 500 as set in the libraries's configuration, or parameter if you're not using the configuration script)

## Usage in Scara

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
$img = Gravatar::img('email@domain.com');
$src = Gravatar::src('email@domain.com');
```

## Usage in Laravel

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
$img = Gravatar::img('email@domain.com');
$src = Gravatar::src('email@domain.com');
```
