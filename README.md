Simple auth
------------

A simple authentication driver, which makes it possible to define one or more users in the app.config file. This is great for mockup projects or when you don't have/need a database. *This library extends the original Laravel auth drivers, so it uses exactly the same methods.*

Installation
------------

Install using composer:

    composer require cedricve/simpleauth

Add the service provider in `app/config/app.php`:

    'Cedricve\Simpleauth\SimpleauthServiceProvider',

The service provider will register a extension with the original auth manager. There is no need to register additional facades or objects.

Configuration
-------------

Change your default database connection name in `app/config/auth.php`:

    'driver' => 'simple'

And add a new property to the `app/config/app.php` file:

    'users' => [
        [
            "id" => 1,
            "username" => "root",
            "password" => "root",
            "firstname" => "Cédric",
            "secondname" => "Verstraeten"
        ],
        [
            "id" => 2,
            "username" => "root2",
            "password" => "root",
            "firstname" => "Cédric",
            "secondname" => "Verstraeten"
        ]
    ],

Examples
--------

You can use the default Auth methods.

### Basic Usage

**Try to signin**

    Auth::attempt(["username" => 'root', "password" => "password"))

**Retrieving the user that signed in**

    $user = Auth::user();

More info about authentication: [http://laravel.com/docs/4.2/security](http://laravel.com/docs/4.2/security)