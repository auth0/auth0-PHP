# Auth0 PHP SDK

## News

The version 1.x of the PHP SDK now works with the Auth API v2 which adds lots of new [features and changes](https://auth0.com/docs/apiv2Changes).

### Backward compatibility breaks

- Now, all the SDK is under the namespace `\Auth0\SDK`
- The exceptions were moved to the namespace `\Auth0\SDK\Exceptions`
- The method `Auth0::getUserInfo` is deprecated and soon to be removed. We encourage to use `Auth0::getUser` to enforce the adoption of the API v2


### New features

- The Auth0 class, now provides two methods to access the user metadata, `getUserMetadata` and `getAppMetadata`. For more info, check the [API v2 changes](https://auth0.com/docs/apiv2Changes)
- The Auth0 class, now provides a way to update the UserMetadata with the method `updateUserMetadata`. Internally, it uses the [update user endpoint](https://auth0.com/docs/apiv2#!/users/patch_users_by_id), check the method documentation for more info.
- The new service `\Auth0\SDK\API\ApiUsers` provides an easy way to consume the API v2 Users endpoints.
- A simple API client (`\Auth0\SDK\API\ApiClient`) is also available to use.
- A JWT generator and decoder is also available (`\Auth0\SDK\Auth0JWT`)

>***Note:*** API V2 restrict the access to the endpoints via scopes. By default, the user token has granted certain scopes that let update the user metadata but not the root attributes nor app_metadata. To update this information and access another endpoints, you need an special token with this scopes granted. For more information about scopes, check [the API v2 docs](https://auth0.com/docs/apiv2Changes#6).

## Examples

Check the [basic-oauth](https://github.com/auth0/auth0-PHP/tree/master/examples/basic-oauth) example to see a quick demo on how the sdk works.
You just need to create a `.env` file with the following information:

```
AUTH0_CLIENT_SECRET=YOUR_APP_SECRET
AUTH0_CLIENT_ID=YOU_APP_CLIENT
AUTH0_DOMAIN=YOUR_DOMAIN.auth0.com
AUTH0_CALLBACK_URL=http://localhost:3000/index.php
AUTH0_APPTOKEN=A_VALID_APPTOKEN_WITH_CREATE_USER_SCOPE
```

You will get your app client and secret from your Auth0 app you had created.
The auth0 domain, is the one you pick when you created your auth0 account.
You need to set this callback url in your app allowed callbacks.
The app token is used in the 'create user' page and needs `create:users` scope. To create one, you need to use the token generator in the [API V2 documentation page](https://auth0.com/docs/apiv2)

To run the example, you need composer (the PHP package manager) installed (you can find more info about composer [here](https://getcomposer.org/doc/00-intro.md)) and run the following commands on the same folder than the code.

```
$ composer install
$ php -S localhost:3000
```

## Migration guide from 0.6.6

1. First is important to read the [API v2 changes document](https://auth0.com/docs/apiv2Changes) to catch up the latest changes to the API.
2. Update your composer.json file.
 - change the version "auth0/auth0-php": "~1.0"
 - add the new dependency "firebase/php-jwt" : "dev-master"
3. Now the SDK is PSR-4 compliant so you will need to change the namespaces (sorry **:(** ) to `\Auth0\SDK`
4. The method `getUserInfo` is deprecated and candidate to be removed on the next release. User `getUser` instead. `getUser` returns an User object compliant with API v2 which is a `stdClass` (check the schema [here](https://auth0.com/docs/apiv2#!/users/get_users_by_id))

## Installation

### 1. Install the SDK

We recommend using [Composer](http://getcomposer.org/doc/01-basic-usage.md) to install the library.

To install, run `composer require auth0/auth0-php:"~1.0"`.

### 2. Setup the callback action
Create a php page (or action if you are using an MVC framework) that will handle the callback from the login attempt.

In there, you should create an instance of the SDK with the proper configuration and ask for the user information.

~~~php
use Auth0\SDK\Auth0;

$auth0 = new Auth0(array(
    'domain'        => 'YOUR_AUTH0_DOMAIN',
    'client_id'     => 'YOUR_AUTH0_CLIENT_ID',
    'client_secret' => 'YOUR_AUTH0_CLIENT_SECRET',
    'redirect_uri'  => 'http://<name>/callback.php'
));

$userInfo = $auth0->getUser();
~~~

If the user was already logged in, `getUser()` will retrieve that [user information](https://docs.auth0.com/user-profile) from the `PHP Session`. If not, it will try to exchange the code given to the callback to get an access token, id token and the [user information](https://docs.auth0.com/user-profile) from auth0.

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

You can trigger the login in different ways, like redirecting to a login link or using [Lock](https://docs.auth0.com/lock), by adding the following javascript into your page

~~~html
<button onclick="login()">Login</button>

<script src="https://cdn.auth0.com/js/lock-7.min.js"></script>
<script type="text/javascript">
    var lock = new Auth0Lock(AUTH0_CLIENT_ID, AUTH0_DOMAIN);

    function login() {
      lock.show({
          callbackURL: AUTH0_CALLBACK_URL
          , responseType: 'code'
          , authParams: {
              scope: 'openid name email picture'
          }
      });
    }
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
