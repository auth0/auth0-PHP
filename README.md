# Auth0 PHP SDK

This SDK uses Composer to manage its dependencies. Get it [here](http://getcomposer.org/download/)

## Install dependencies

    php composer.phar install

## Configure

Start your web server on `examples` folder.
Create an OpenID Connect Application on Auth0.
Configure the callback url to point `examples\callback.php`.
Open `examples\config.php` and replace all placeholder parameters.
On Auth0 dashboard, copy the HTML/JS code that renders the login button and place it on `examples\index.php`.
On your browser, open the Auth0 example project. Make sure `index.php` is being loaded.

## Enjoy


# TODO

- Better code documentation
- Better user guide
- Drink coffee