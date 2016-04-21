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
          $arh[ucfirst(strtolower($arh_key))] = $val;
        }
      }
      return( $arh );
    }
  }


  // Require composer autoloader
  require __DIR__ . '/vendor/autoload.php';

  // Read .env
  try {
    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();
  } catch(InvalidArgumentException $ex) {
    // Ignore if no dotenv
  }

  $app = new \App\Main();

  // Create Router instance
  $router = new \Bramus\Router\Router();

  // Activate CORS
  function sendCorsHeaders() {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Authorization");
    header("Access-Control-Allow-Methods: GET,HEAD,PUT,PATCH,POST,DELETE");
  }

  $router->options('/.*', function() {
      sendCorsHeaders();
  });

  sendCorsHeaders();


  // Check JWT on /secured routes
  $router->before('GET', '/secured/.*', function() use ($app) {

    $requestHeaders = apache_request_headers();

    if (!isset($requestHeaders['Authorization'])) {
        header('HTTP/1.0 401 Unauthorized');
        echo "No token provided.";
        exit();
    }

    $authorizationHeader = $requestHeaders['Authorization'];

    if ($authorizationHeader == null) {
      header('HTTP/1.0 401 Unauthorized');
      echo "No authorization header sent";
      exit();
    }

    $token = str_replace('Bearer ', '', $authorizationHeader);

    try {
        $app->setCurrentToken($token);
    }
    catch(\Auth0\SDK\Exception\CoreException $e) {
      header('HTTP/1.0 401 Unauthorized');
      echo "Invalid token";
      exit();
    }

  });

  $router->get('/ping', function() use ($app){
      echo json_encode($app->publicPing());
  });

  $router->get('/secured/ping', function() use ($app){
      echo json_encode($app->privatePing());
  });

  $router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo "Page not found";
  });

  // Run the Router
  $router->run();
