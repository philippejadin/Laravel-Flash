# Laravel Flash

## Intro

This package is a fork of the [Flash Package](https://github.com/laracasts/flash) built by [Jeffrey Way](https://github.com/JeffreyWay) at [Laracasts](https://laracasts.com/lessons/flexible-flash-messages).

## New Features

- Display Laravel Validator Messages
- Display Multiple Messages
- Display Titles in Alerts
- Configuration to choose a template
    - Twitter Bootstrap 3 (Default)
    - ZURB Foundation
        - Default
        - Radius
        - Round
- Method Chaining
- Cleaned with [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)

## Installation

First, pull in the package through Composer.

```js
composer require draperstudio/laravel-flash:1.0.*@dev
```

And then include the service provider within `app/config/app.php`.

```php
'providers' => [
    DraperStudio\Flash\ServiceProvider::class
];
```

If you need to modify the configuration or the views, you can run:

```bash
php artisan vendor:publish --provider="DraperStudio\Flash\ServiceProvider"
```

The package views will now be located in the `app/resources/views/vendor/flash/` directory and the configuration will be located at `app/config/flash.php`.

## Usage

Within your controllers, before you perform a redirect...

```php
public function store(Flash $flash)
{
    flash()->message('Welcome Aboard!');

    return redirect()->route('dashboard');
}
```

You may also do:

- `flash()->message('Message')`
- `flash()->success('Message')`
- `flash()->info('Message')`
- `flash()->warning('Message')`
- `flash()->error('Message')`
- `flash()->overlay('Modal Message', 'Modal Title')`

Again, this will set one key in the session:

- `flash_notification.messages` - The messages you're flashing, each message is contained as an array
    - `message` - The message you're flashing
    - `level`   - A string that represents the type of notification
    - `title`   - A string that will show up as the modal title
    - `overlay` - A boolean that indicates whether or not the flash is an overlay

Because flash messages and overlays are so common, if you want, you may use (or modify) the views that are included with this package. Simply append to your layout view:

```html
@include('flash::messages')
```

## Example

```html
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Laravel PHP Framework</title>
        <!-- Twitter Bootstrap -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap/3.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <!-- ZURB Foundation -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/foundation/5.4.7/stylesheets/foundation.min.css">
    </head>

    <body>
        <div class="container">
            @include('flash::messages')
        </div><!-- /.container -->

        <!-- jQuery -->
        <script src="//cdn.jsdelivr.net/jquery/2.1.1/jquery.min.js"></script>
        <!-- Twitter Bootstrap -->
        <script src="//cdn.jsdelivr.net/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <!-- ZURB Foundation -->
        <script src="//cdn.jsdelivr.net/foundation/5.4.7/javascripts/foundation.min.js"></script>
        <script>
            // Twitter Bootstrap
            $('#flash-overlay-modal').modal();

            // ZURB Foundation
            $('#flash-overlay-modal').foundation('reveal', 'open');
        </script>
    </body>
</html>

```

#### Message (Defaults to Info)
```php
flash()->message('Welcome aboard!');

return redirect()->route('dashboard');
```

#### Success
```php
flash()->success('You successfully read this important alert message.');

return redirect()->route('dashboard');
```

#### Info

```php
flash()->info('This alert needs your attention, but it\'s not super important.');

return redirect()->route('dashboard');
```

#### Warning
```php
flash()->warning('Better check yourself, you\'re not looking too good.');

return redirect()->route('dashboard');
```

#### Error

```php
flash()->error('Change a few things up and try submitting again.');

return redirect()->route('dashboard');
```

#### Important

```php
flash('You successfully read this important alert message.')->important();

return redirect()->route('dashboard');
```

#### Modal / Overlay
```php
flash()->overlay('One fine body...');

return redirect()->route('dashboard');
```

#### Laravel Validation
```php
$validator = Validator::make(
    ['name' => 'Invalid'],
    ['name' => 'required|min:8']
);

flash()->error($validator->messages());

return redirect()->route('dashboard');
```

#### Chain Messages

```php
flash()->success('You successfully read this important alert message.')
       ->info('This alert needs your attention, but it\'s not super important.')
       ->warning('Better check yourself, you\'re not looking too good.')
       ->error('Change a few things up and try submitting again.')
       ->overlay('One fine body...');

return redirect()->route('dashboard');
```
