<?php

if (isset($_REQUEST['create'])) {

    $app_token = getenv('AUTH0_APPTOKEN');
    $domain = getenv('AUTH0_DOMAIN');

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $color = $_REQUEST['color'];

    echo '<pre>';
    var_dump(\Auth0\SDK\API\ApiUsers::create($domain, $app_token, array(
        'email' => $email,
        'password' => $password,
        'connection' => 'Username-Password-Authentication',
        'user_metadata' => array(
            'color' => $color,
        )
    )));
    echo '</pre>';
}
?>


<form action="?create-user" method="POST">

    <label for="email">Email</label>
    <input type="email" name="email" id="email" />

    <label for="password">Password</label>
    <input type="password" name="password" id="password" />

    <label for="color">Color</label>
    <input type="color" name="color" id="color" />

    <input type="submit" name="create" value="Create" />

</form>
