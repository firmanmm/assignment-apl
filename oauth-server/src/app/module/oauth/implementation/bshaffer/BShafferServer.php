<?php 

namespace App\Oauth\Implementation\BShaffer;

use App\Oauth\Implementation\BShaffer\MySQLStorage;
use OAuth2\Server;
use App\Oauth\Implementation\Adapter\ServerAdapterInterface;

class BShafferServer implements ServerAdapterInterface {

    /**
     * Undocumented variable
     *
     * @var Server
     */
    private $server;

    public function __construct()
    {
        $dsn      = 'mysql:dbname='.getenv("DB_NAME").';host='.getenv("DB_HOST");
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');

        $storage = new MySQLStorage(array('dsn' => $dsn, 'username' => $username, 'password' => $password));
        $this->server = new Server($storage);
        $this->server->addGrantType(new \OAuth2\GrantType\AuthorizationCode($storage));
        $this->server->addGrantType(new \OAuth2\GrantType\ClientCredentials($storage));
    }

    public function authorize($request=null){
        $request = \OAuth2\Request::createFromGlobals();
        $response = new \OAuth2\Response();
        $is_authorized = true; // Always Authorize
        $this->server->handleAuthorizeRequest($request, $response, $is_authorized);
        if ($is_authorized) {
            $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
        }
        $response->send();
    }

    public function token($request=null){
        $this->server->handleTokenRequest(\OAuth2\Request::createFromGlobals())->send();
    }

    public function resource($request=null) {
        if (!$this->server->verifyResourceRequest(\OAuth2\Request::createFromGlobals())) {
            $this->server->getResponse()->send();
            die;
        }
        echo json_encode(array('success' => true, 'message' => 'API Accessed'));
    }   
}