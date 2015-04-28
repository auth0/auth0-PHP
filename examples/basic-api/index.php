<?php
  // In case one is using PHP 5.4's built-in server
  $filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
  if (php_sapi_name() === 'cli-server' && is_file($filename)) {
      return false;
  }

  if( !function_exists('apache_request_headers') ) {

    function apache_request_headers() {
      $arh = array();
      $rx_http = '/\AHTTP_/';
      foreach($_SERVER as $key => $val) {
        if( preg_match($rx_http, $key) ) {
          $arh_key = preg_replace($rx_http, '', $key);
          $rx_matches = array();
          // do some nasty string manipulations to restore the original letter case
          // this should work in most cases
          $rx_matches = explode('_', $arh_key);
          if( count($rx_matches) > 0 and strlen($arh_key) > 2 ) {
            foreach($rx_matches as $ak_key => $ak_val) $rx_matches[$ak_key] = ucfirst($ak_val);
            $arh_key = implode('-', $rx_matches);
          }
          $arh[$arh_key] = $val;
        }
      }
      return( $arh );
    }
  }


  // Require composer autoloader
  require __DIR__ . '/vendor/autoload.php';

  // Read .env
  try {
    Dotenv::load(__DIR__);
  } catch(InvalidArgumentException $ex) {
    // Ignore if no dotenv
  }

  // Create Router instance
  $router = new \Bramus\Router\Router();

  // Activate CORS
  function setCorsHeaders() {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Authorization");
    header("Access-Control-Allow-Methods: GET,HEAD,PUT,PATCH,POST,DELETE");
  }
  $router->options('/.*', function() {
    setCorsHeaders();
  });
  setCorsHeaders();


  // Check JWT on /secured routes
  $router->before('GET', '/secured/.*', function() {

    $requestHeaders = apache_request_headers();
    $authorizationHeader = $requestHeaders['AUTHORIZATION'];

    if ($authorizationHeader == null) {
      header('HTTP/1.0 401 Unauthorized');
      echo "No authorization header sent";
      exit();
    }

    // // validate the token
    $token = str_replace('Bearer ', '', $authorizationHeader);
    $secret = getenv('AUTH0_CLIENT_SECRET');
    $decoded_token = null;
    try {
      $decoded_token = JWT::decode($token, base64_decode(strtr($secret, '-_', '+/')) );
    } catch(UnexpectedValueException $ex) {
      header('HTTP/1.0 401 Unauthorized');
      echo "Invalid token";
      exit();
    } catch(Exception $e) {
      header('HTTP/1.0 500 Internal Server Error');
      echo $e->getMessage();
      echo "\n\nMost likely thrown because configured client secret must be public signing key, not client secret";
      exit();
    }


    // // validate that this token was made for us
    if ($decoded_token->aud != getenv('AUTH0_CLIENT_ID')) {
      header('HTTP/1.0 401 Unauthorized');
      echo "Invalid token";
      exit();
    }

  });

  $router->get('/ping', function() {
    echo "All good. You don't need to be authenticated to call this";
  });

  $router->get('/secured/ping', function() {
    echo "All good. You only get this message if you're authenticated";
  });

  $router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo "Page not found";
  });

  // Run the Router
  $router->run();






