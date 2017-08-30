<?php

namespace Auth0\SDK;

use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\ApiException;
use Auth0\SDK\Store\EmptyStore;
use Auth0\SDK\Store\SessionStore;
use Auth0\SDK\Store\StoreInterface;
use Auth0\SDK\API\Authentication;

/**
 * This class provides access to Auth0 Platform.
 *
 * @author Auth0
 */
class Auth0 {
  /**
  * Available keys to persist data.
  *
  * @var array
  */
  public $persistantMap = array(
    'refresh_token',
    'access_token',
    'user',
    'id_token'
  );
  /**
  * Auth0 URL Map.
  *
  * @var array
  */
  public static $URL_MAP = array(
    'api'           => 'https://{domain}/api/',
    'authorize'     => 'https://{domain}/authorize/',
    'token'     => 'https://{domain}/oauth/token/',
    'user_info'     => 'https://{domain}/userinfo/',
  );
  /**
  * Auth0 Domain.
  *
  * @var string
  */
  protected $domain;
  /**
  * Auth0 Client ID
  *
  * @var string
  */
  protected $client_id;
  /**
  * Auth0 Client Secret
  *
  * @var string
  */
  protected $client_secret;
  /**
  * Response Mode
  *
  * @var string
  */
  protected $response_mode = 'query';
  /**
  * Response Type
  *
  * @var string
  */
  protected $response_type = 'code';
  /**
  * Audience
  *
  * @var string
  */
  protected $audience;
  /**
  * Scope
  *
  * @var string
  */
  protected $scope;
  /**
  * Auth0 Refresh Token
  *
  * @var string
  */
  protected $refresh_token;
  /**
  * Redirect URI needed on OAuth2 requests.
  *
  * @var string
  */
  protected $redirect_uri;
  /**
  * Debug mode flag.
  *
  * @var Boolean
  */
  protected $debug_mode;
  /**
  * Debugger function.
  * Will be called only if $debug_mode is true.
  *
  * @var \Closure
  */
  protected $debugger;
  /**
  * The access token retrieved after authorization.
  * NULL means that there is no authorization yet.
  *
  * @var string
  */
  protected $access_token;
  /**
  * Store
  *
  * @var StoreInterface
  */
  protected $store;
  /**
  * The user object
  *
  * @var string
  */
  protected $user;
  /**
  * Authentication Client.
  *
  * @var \Auth0\SDK\API\Authentication
  */
  protected $authentication;

  protected $guzzleOptions;

  /**
   * BaseAuth0 Constructor.
   *
   * Configuration:
   *     - domain                 (String)  Required. Should match your Auth0 domain
   *     - client_id              (String)  Required. The id of the application, you can get this in the
   *                                                  auth0 console
   *     - client_secret          (String)  Required. The application secret, same comment as above
   *     - redirect_uri           (String)  Required. The uri of the auth callback, used as a security method
   *     - response_mode          (String)  Optional. Default `query`
   *     - response_type          (String)  Optional. Default `code`
   *     - persist_user           (Boolean) Optional. Indicates if you want to persist the user info, default true
   *     - persist_access_token   (Boolean) Optional. Indicates if you want to persist the access token, default false
   *     - persist_refresh_token  (Boolean) Optional. Indicates if you want to persist the refresh token, default false
   *     - persist_id_token       (Boolean) Optional. Indicates if you want to persist the id token, default false
   *     - store                  (Mixed)   Optional. Indicates how we store the persisting methods, default is session
   *                                                  store, you can pass false to avoid storing it or a class that
   *                                                  implements a store (get, set, delete). TODO: add a proper interface
   *     - debug                  (Boolean) Optional. Default false
   *     - guzzle_options          (Object) Optional. Options forwarded to Guzzle
   *
   * @param array $config Required
   *
   * @throws CoreException If `domain` is not provided.
   * @throws CoreException If `client_id` is not provided.
   * @throws CoreException If `client_secret` is not provided.
   * @throws CoreException If `redirect_uri` is not provided.
   */
  public function __construct(array $config) {
    if (!empty($config['domain'])) {
        $this->domain = $config['domain'];
    } else {
        throw new CoreException('Invalid domain');
    }
    if (!empty($config['client_id'])) {
        $this->client_id = $config['client_id'];
    } else {
        throw new CoreException('Invalid client_id');
    }
    if (!empty($config['client_secret'])) {
        $this->client_secret = $config['client_secret'];
    } else {
        throw new CoreException('Invalid client_secret');
    }
    if (!empty($config['redirect_uri'])) {
        $this->redirect_uri = $config['redirect_uri'];
    } else {
        throw new CoreException('Invalid redirect_uri');
    }
    if (isset($config['audience'])) {
        $this->audience = $config['audience'];
    }
    if (isset($config['response_mode'])) {
        $this->response_mode = $config['response_mode'];
    }
    if (isset($config['response_type'])) {
        $this->response_type = $config['response_type'];
    }
    if (isset($config['scope'])) {
        $this->scope = $config['scope'];
    }
    if (isset($config['guzzle_options'])) {
        $this->guzzleOptions = $config['guzzle_options'];
    }
    if (isset($config['debug'])) {
        $this->debug_mode = $config['debug'];
    } else {
        $this->debug_mode = false;
    }
    // User info is persisted unless said otherwise
    if (isset($config['persist_user']) && $config['persist_user'] === false) {
        $this->dontPersist('user');
    }
    // Access token is not persisted unless said otherwise
    if (!isset($config['persist_access_token']) || (isset($config['persist_access_token']) &&
            $config['persist_access_token'] === false)) {
        $this->dontPersist('access_token');
    }
    // Refresh token is not persisted unless said otherwise
    if (!isset($config['persist_refresh_token']) || (isset($config['persist_refresh_token']) &&
            $config['persist_refresh_token'] === false)) {
        $this->dontPersist('refresh_token');
    }
    // Id token is not per persisted unless said otherwise
    if (!isset($config['persist_id_token']) || (isset($config['persist_id_token']) &&
            $config['persist_id_token'] === false)) {
        $this->dontPersist('id_token');
    }
    if (isset($config['store'])) {
        if ($config['store'] === false) {
          $this->setStore(new EmptyStore());
        } else {
          $this->setStore($config['store']);
        }
    } else {
      $this->setStore(new SessionStore());
    }

    $this->authentication = new Authentication ($this->domain, $this->client_id, $this->client_secret, $this->audience, $this->scope, $this->guzzleOptions);

    $this->user = $this->store->get("user");
    $this->access_token = $this->store->get("access_token");
    $this->id_token = $this->store->get("id_token");
    $this->refresh_token = $this->store->get("refresh_token");
  }

  public function login($state = null, $connection = null) {
    $params = [];
    if ($this->audience) {
      $params['audience'] = $this->audience;
    }
    if ($this->scope) {
      $params['scope'] = $this->scope;
    }

    $params['response_mode'] = $this->response_mode;

    $url = $this->authentication->get_authorize_link($this->response_type, $this->redirect_uri, $connection, $state, $params);

    header("Location: $url");
    exit;
  }

  public function getUser() {
    if ($this->user) {
      return $this->user;
    }
    $this->exchange();
    return $this->user;
  }

  public function getIdToken() {
    if ($this->id_token) {
      return $this->id_token;
    }
    $this->exchange();
    return $this->id_token;
  }

  public function getAccessToken() {
    if ($this->access_token) {
      return $this->access_token;
    }
    $this->exchange();
    return $this->access_token;
  }

  public function getRefreshToken() {
    if ($this->refresh_token) {
      return $this->refresh_token;
    }
    $this->exchange();
    return $this->refresh_token;
  }

  /**
   * Code exchange
   *
   * @throws CoreException If there is an active session already.
   */
  public function exchange() {
    $code = $this->getAuthorizationCode();
    if (!$code) {
      return false;
    }

    if ($this->user) {
      throw new CoreException('Can\'t initialize a new session while there is one active session already');
    }

    $response = $this->authentication->code_exchange($code, $this->redirect_uri);

    $access_token = (isset($response['access_token']))? $response['access_token'] : false;
    $refresh_token = (isset($response['refresh_token']))? $response['refresh_token'] : false;
    $id_token = (isset($response['id_token']))? $response['id_token'] : false;

    if (!$access_token) {
        throw new ApiException('Invalid access_token - Retry login.');
    }

    $this->setAccessToken($access_token);
    $this->setIdToken($id_token);
    $this->setRefreshToken($refresh_token);

    $user = $this->authentication->userinfo($access_token);
    $this->setUser($user);

    return true;
  }


  public function setUser($user) {
    $key = array_search('user',$this->persistantMap);
    if ($key !== false) {
      $this->store->set('user', $user);
    }
    $this->user = $user;
    return $this;
  }
  /**
   * Sets and persists $access_token.
   *
   * @param string $access_token
   *
   * @return Auth0\SDK\BaseAuth0
   */
  public function setAccessToken($access_token) {
    $key = array_search('access_token',$this->persistantMap);
    if ($key !== false) {
      $this->store->set('access_token', $access_token);
    }
    $this->access_token = $access_token;
    return $this;
  }
  /**
   * Sets and persists $id_token.
   *
   * @param string $id_token
   *
   * @return Auth0\SDK\BaseAuth0
   */
  public function setIdToken($id_token) {
    $key = array_search('id_token',$this->persistantMap);
    if ($key !== false) {
      $this->store->set('id_token', $id_token);
    }
    $this->id_token = $id_token;
    return $this;
  }
  /**
   * Sets and persists $refresh_token.
   *
   * @param string $refresh_token
   *
   * @return Auth0\SDK\BaseAuth0
   */
  public function setRefreshToken($refresh_token) {
    $key = array_search('refresh_token',$this->persistantMap);
    if ($key !== false) {
      $this->store->set('refresh_token', $refresh_token);
    }
    $this->refresh_token = $refresh_token;
    return $this;
  }

  protected function getAuthorizationCode() {
    if ($this->response_mode === 'query') {
      return (isset($_GET['code']) ? $_GET['code'] : null);
    } elseif ($this->response_mode === 'form_post') {
      return (isset($_POST['code']) ? $_POST['code'] : null);
    }

    return null;
  }

  public function logout() {
    $this->deleteAllPersistentData();
    $this->access_token = NULL;
    $this->user = NULL;
    $this->id_token = NULL;
    $this->refresh_token = NULL;
  }

  public function deleteAllPersistentData()
  {
    foreach ($this->persistantMap as $key) {
      $this->store->delete($key);
    }
  }

  /**
   * Removes $name from the persistantMap, thus not persisting it when we set the value
   * @param  String $name The value to remove
   */
  private function dontPersist($name) {
      $key = array_search($name,$this->persistantMap);
      if ($key !== false) {
          unset($this->persistantMap[$key]);
      }
  }

  /**
   * @param StoreInterface $store
   *
   * @return Auth0\SDK\BaseAuth0
   */
  public function setStore(StoreInterface $store) {
    $this->store = $store;
    return $this;
  }

  /**
   * @param \Closure $debugger
   */
  public function setDebugger(\Closure $debugger)
  {
      $this->debugger = $debugger;
  }
}
