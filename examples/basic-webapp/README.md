# Auth0 PHP SDK web application example

This is a simple example of how to authenticate with Auth0 using the PHP SDK. This example requires PHP version 5.6 or higher and [Composer](https://getcomposer.org/doc/00-intro.md).

First, install Composer dependencies in this directory using one of the two commands below:

```bash
# If installed globally, use:
composer install;

# If downloaded for this project, use:
php composer.phar install;
```

Next, move the example environment file to one that will be used for this project:

```bash
mv example.env .env
``` 

Login to your Auth0 account (or create one for free [here](https://auth0.com/signup)) and [create a new Regular Web Application](https://auth0.com/docs/clients). Add `http://localhost:3000` to the **Allowed Callback URLs** and **Allowed Web Origins** fields. 

Now, copy and paste the Domain, Client ID, and Client Secret into the `.env` file created above. Add `http://localhost:3000` as the `AUTH0_CALLBACK_URL` so this application can process the authentication.

Finally, start the built-in PHP server and visit [http://localhost:3000](http://localhost:3000) in your browser:

```bash
php -S localhost:3000
```