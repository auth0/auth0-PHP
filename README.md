# Auth0 PHP SDK

## Installation

Using [Composer](http://getcomposer.org/doc/01-basic-usage.md):

~~~js
{
    "require": {
        "auth0/auth0-php": "0.6.*",
        // other dependencies
    },
    
    // ...
}
~~~

## Usage

1- Include the [Auth0 Widget](https://docs.auth0.com/login-widget2):

~~~html
<a href="javascript:widget.signin();">Login</a>

<script src="https://d19p4zemcycm7a.cloudfront.net/w2/auth0-widget-2.4.min.js"></script>
<script type="text/javascript">
    var widget = new Auth0Widget({
        domain:       'YOUR_AUTH0_DOMAIN',
        clientID:     'YOUR_AUTH0_CLIENT_ID',
        callbackURL:  'YOUR_AUTH0_APP_CALLBACK'
    });
</script>
~~~

2- Edit the callback page to create an instance of the `Auth0` class in order to exchange the authorization code (provided by Auth0) for an access_token:

~~~php
use Auth0SDK\Auth0;

$auth0 = new Auth0(array(
    'domain'        => 'YOUR_AUTH0_DOMAIN',
    'client_id'     => 'YOUR_AUTH0_CLIENT_ID',
    'client_secret' => 'YOUR_AUTH0_CLIENT_SECRET',
    'redirect_uri'  => 'YOUR_AUTH0_APP_CALLBACK',
    'debug'         => true
));

$access_token = $auth0->getAccessToken();
~~~

3- Once the user successfully authenticated to the application, you can retrieve his profile:

~~~php
$userProfile = $auth0->getUserInfo();
~~~

## Develop

This SDK uses [Composer](http://getcomposer.org/doc/01-basic-usage.md) to manage its dependencies.

### Install dependencies

    php composer.phar install

## Configure example

1. Install dependencies
2. Start your web server on `examples` folder.
3. Create an OpenID Connect Application on Auth0.
4. Configure the callback url to point `examples\callback.php`.
5. Open `examples\config.php` and replace all placeholder parameters.
6. On your browser, open the Auth0 example project. Make sure `index.php` is being loaded.

#### Enjoy

# TODO

- Better code documentation
- Better user guide
- Drink coffee
