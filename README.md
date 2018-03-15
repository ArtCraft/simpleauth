Simple auth
------------

A simple authentication driver, which makes it possible to define one or more users in the app.config file. This is great for mockup projects or when you don't have/need a database. *This library extends the original Laravel auth drivers, so it uses exactly the same methods.*

Installation
------------

Add fork to composer.json respositories property:

    ```json
    {
      "type": "vcs",
      "url": "https://github.com/maksimru/simpleauth.git"
    }
    ```

Install using composer:

    composer require cedricve/simpleauth

Add the service provider in `app/config/app.php`:

    'Cedricve\Simpleauth\SimpleauthServiceProvider',

The service provider will register a extension with the original auth manager. There is no need to register additional facades or objects.

Configuration
-------------

## Configuration

1) Publish configuration
    ```php
    php artisan vendor:publish --provider=namespace Cedricve\Simpleauth\SimpleauthServiceProvider
    ```
    
2) Configure in config/simpleauth.php

3) Change your default database connection name in `app/config/auth.php`:

    - change defaults.guard to simple
    - in guards array add:
    ```php
    'simple' => [
        'driver' => 'session',
        'provider' => 'simple',
    ],
    ```
    - in providers array add:
    ```php
    'simple' =>  [
        'model' => Cedricve\Simpleauth\SimpleauthUser::class,
        'driver' => 'simple'
    ],
    ```

4) And add a new property to the `app/config/simpleauth.php` file:

    ```php

    'users' => [
        [
            'id' => 1,
            'email' => 'foe1@bar.com',
            'password' => 'qwerty',
        ],
        [
            'id' => 2,
            'email' => 'foe2@bar.com',
            'password' => 'qwerty',
            'foe' => 'bar',
        ]
    ],
 
    ```

Examples
--------

You can use the default Auth methods.

### Basic Usage

**Try to signin**

    Auth::attempt(['email' => 'foe1@bar.com', 'password' => 'qwerty'))

**Retrieving the user that signed in**

    $user = Auth::user();
    $user->toArray();

More info about authentication: [http://laravel.com/docs/4.2/security](http://laravel.com/docs/4.2/security)