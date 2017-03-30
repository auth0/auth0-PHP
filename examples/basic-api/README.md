# Auth0 + PHP API Seed
This is the seed project you need to use if you're going to create a PHP API. You'll mostly use this API either for a SPA or a Mobile app. If you just want to create a Regular PHP WebApp, please check [this other seed project](https://github.com/auth0/auth0-PHP/tree/master/examples/basic-webapp)

This example is deployed at Heroku at http://auth0-php-sample.herokuapp.com/ping

#Running the example
In order to run the example you need to have `composer` and `php` installed.

Make sure that your app using `RS256` signature algorithm. You can change it under advanced settings of your app in tab `OAuth`.

You also need to set the ClientSecret and ClientId for your Auth0 app as enviroment variables with the following names respectively: `AUTH0_CLIENT_SECRET` and `AUTH0_CLIENT_ID`.

For that, if you just create a file named `.env` in the directory and set the values like the following, the app will just work:

````bash
# .env file
AUTH0_CLIENT_SECRET=myCoolSecret
AUTH0_CLIENT_ID=myCoolClientId
````

Once you've set those 2 enviroment variables, just run the following to get the app started:

````bash
composer install
php -S localhost:3001
````

Now, try calling [http://localhost:30001/ping](http://localhost:30001/ping)

With Docker:

- docker build -t auth0-basic-api .
- docker run -d -p 80:80 --name auth0-basic-api auth0