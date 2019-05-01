<?php 

namespace App\Oauth\Implementation\League;

use App\Oauth\Implementation\Adapter\ServerAdapterInterface;
use GuzzleHttp\Psr7\ServerRequest;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Grant\AuthCodeGrant;
use Phalcon\Http\Response;
use Phalcon\Di;
use Phalcon\DiInterface;
use App\Oauth\Implementation\League\Entity\UserEntity;
use App\Oauth\Implementation\League\Repository\ClientRepository;
use App\Oauth\Implementation\League\Repository\ScopeRepository;
use App\Oauth\Implementation\League\Repository\AccessTokenRepository;
use App\Oauth\Implementation\League\Repository\AuthCodeRepository;
use App\Oauth\Implementation\League\Repository\RefreshTokenRepository;


class LeagueServer implements ServerAdapterInterface {

    /**
     * @var DiInterface $di
     */
    private $di;
    /** 
     * @var AuthorizationServer
     */
    private $server;

    /**
     * Undocumented function
     *
     * @param DiInterface $di
     */
    public function __construct($di)
    {
        $this->di = $di;
        $clientRepository = new ClientRepository($di);
        $scopeRepository = new ScopeRepository($di);
        $accessTokenRepository = new AccessTokenRepository($di);
        $authCodeRepository = new AuthCodeRepository($di);
        $refreshTokenRepository = new RefreshTokenRepository($di);

        $privateKeyPath = APP_PATH."/module/oauth/private.key";
        $encryptionKey = "9EXB2qY1SL4fBh0nShBRHkAze+gMo57gvGwB0vg9uzH8a9oFuYSv+x0Vih2kvIl0zPPrnQBmqjLA3uMomkXn5A==";
        
        $this->server = new AuthorizationServer(
            $clientRepository,
            $accessTokenRepository,
            $scopeRepository,
            $privateKeyPath,
            $encryptionKey
        );
        $authCodeGrant = new AuthCodeGrant(
            $authCodeRepository,
            $refreshTokenRepository,
            new \DateInterval("PT10M")
        );
        $authCodeGrant->setRefreshTokenTTL(new \DateInterval("P1M"));
        $this->server->enableGrantType($authCodeGrant);
    }

    public function authorize($request=null) {
        $request = ServerRequest::fromGlobals();
        $serverResponse = new \GuzzleHttp\Psr7\Response();
        $authRequest = $this->server->validateAuthorizationRequest($request);
        $authRequest->setUser(new UserEntity());
        $authRequest->setAuthorizationApproved(true);
        $authResponse = $this->server->completeAuthorizationRequest($authRequest, $serverResponse);

        $response = new Response();
        $response->setStatusCode(302);
        $response->setHeader("Location", $authResponse->getHeader("Location")[0]);
        $response->send();
        
    }

    public function token($request=null) {
        $serverResponse = new \GuzzleHttp\Psr7\Response();
        $authResponse = $this->server->respondToAccessTokenRequest(ServerRequest::fromGlobals(), $serverResponse);
        $response = new Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setContent($authResponse->getBody()->__toString());
        $response->send();
    }

    public function resource($request = null)
    {
        //TODO : DO
    }

    private function sendJSON($response) {
        $httpResponse = new Response();
        $httpResponse->setContentType('application/json');
        $httpResponse->setContent($response);
        $httpResponse->send();
    }
}