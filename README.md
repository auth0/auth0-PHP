# Auth0 PHP SDK

### 1. Install the SDK

We recommend using [Composer](http://getcomposer.org/doc/01-basic-usage.md) to install the library.

Modify your `composer.json` to add the following dependencies and run `composer update`.

~~~js
{
    "require": {
        "auth0/auth0-php": "0.6.*",
        "adoy/oauth2": "dev-master"
    }
}
~~~

### 2. Setup the callback action
Create a php page (or action if you are using an MVC framework) that will handle the callback from the login attempt.

In there, you should create an instance of the SDK with the proper configuration and ask for the user information.

~~~php
use Auth0SDK\Auth0;

$auth0 = new Auth0(array(
    'domain'        => 'YOUR_AUTH0_DOMAIN',
    'client_id'     => 'YOUR_AUTH0_CLIENT_ID',
    'client_secret' => 'YOUR_AUTH0_CLIENT_SECRET',
    'redirect_uri'  => 'http://<name>/callback.php'
));

$userInfo = $auth0->getUserInfo();
~~~

If the user was already logged in, `getUserInfo()` will retrieve that [user information](https://docs.auth0.com/user-profile) from the `PHP Session`. If not, it will try to exchange the code given to the callback to get an access token, id token and the [user information](https://docs.auth0.com/user-profile) from auth0.

This makes it possible to use the same code in the callback action and any other page, so to see if there is a logged in user, you can call


~~~php
// ...
// code from above

if (!$userInfo) {
    // print login button
} else {
    // Say hello to $userInfo['name']
    // print logout button
}
~~~

### 3. Setup the callback action in Auth0

After authenticating the user on Auth0, we will do a GET to a URL on your web site. For security purposes, you have to register this URL on the Application Settings section on Auth0 Admin app.

    http://<name>/callback.php


### 4. Triggering login manually or integrating the Auth0 widget

You can trigger the login in different ways, like redirecting to a login link or using the [Login Widget](https://docs.auth0.com/login-widget2), by adding the following javascript into your page

~~~html
<a href="javascript:widget.signin();">Login</a>

<script src="https://cdn.auth0.com/w2/auth0-widget-3.0.min.js"></script>
<script type="text/javascript">
    var widget = new Auth0Widget({
        domain:       'YOUR_AUTH0_DOMAIN',
        clientID:     'YOUR_AUTH0_CLIENT_ID',
        callbackURL:  'http://<name>/callback.php'
    });
</script>
~~~

### 5. (Optional) Configure session data

By default, the SDK will store the [user information](https://docs.auth0.com/user-profile) in the `PHP Session` and it will discard the access token and the id token. If you like to persist them as well, you can pass `'persist_access_token' => true` and `'persist_id_token' => true` to the SDK configuration in step 2. You can also disable session all together by passing `'store' => false`.

If you want to change `PHP Session` and use Laravel, Zend, Symfony or other abstraction to the session, you can create a class that implements `get`, `set`, `delete` and pass it to the SDK as following.

~~~php
$laravelStore = new MyLaravelStore();
$auth0 = new Auth0(array(
    // ...
    'store' => $laravelStore,
    // ...
));
~~~


## Develop

This SDK uses [Composer](http://getcomposer.org/doc/01-basic-usage.md) to manage its dependencies.

### Install dependencies

    php composer.phar install

## Configure example

1. Install dependencies
2. Start your web server on `examples/{example-name}` folder.
3. Create an OpenID Connect Application on Auth0.
4. Configure the callback url to point `{your-base-url}\callback.php`.
5. Open `examples/{example-name}/config.php` and replace all placeholder parameters.
6. On your browser, open the Auth0 example project. Make sure `index.php` is being loaded.

## What is Auth0?

Auth0 helps you to:

* Add authentication with [multiple authentication sources](https://docs.auth0.com/identityproviders), either social like **Google, Facebook, Microsoft Account, LinkedIn, GitHub, Twitter, Box, Salesforce, amont others**, or enterprise identity systems like **Windows Azure AD, Google Apps, Active Directory, ADFS or any SAML Identity Provider**.
* Add authentication through more traditional **[username/password databases](https://docs.auth0.com/mysql-connection-tutorial)**.
* Add support for **[linking different user accounts](https://docs.auth0.com/link-accounts)** with the same user.
* Support for generating signed [Json Web Tokens](https://docs.auth0.com/jwt) to call your APIs and **flow the user identity** securely.
* Analytics of how, when and where users are logging in.
* Pull data from other sources and add it to the user profile, through [JavaScript rules](https://docs.auth0.com/rules).

## Create a free account in Auth0

1. Go to [Auth0](https://auth0.com) and click Sign Up.
2. Use Google, GitHub or Microsoft Account to login.

## Issue Reporting

If you have found a bug or if you have a feature request, please report them at this repository issues section. Please do not report security vulnerabilities on the public GitHub issue tracker. The [Responsible Disclosure Program](https://auth0.com/whitehat) details the procedure for disclosing security issues.

## Author

[Auth0](auth0.com)

## License

This project is licensed under the MIT license. See the [LICENSE](LICENSE.txt) file for more info.

## TODO

- Better code documentation
- Better user guide
- Create an interface for the store
- Drink coffee
