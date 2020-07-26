<?php

namespace App\Services;

use OAuth2\Server;
use OAuth2\Storage;
use OAuth2\GrantType;
use App\Interfaces\Services;

final class OAuthService implements Services
{
    /**
     * @var null|OAuthService
     */
    static private $instance  = NULL;

    /**
     * @var Storage\Pdo
     */
    protected $storage;

    /**
     * @var Server
     */
    protected $server;

    /**
     * @return OAuthService
     */
    public static function boot() :OAuthService
    {
        if(self::$instance == NULL) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * OAuthService constructor.
     */
    public function __construct()
    {
        $this->storage = new Storage\Pdo(db());

        $this->server = new Server(
            $this->storage ,
            [
                'access_lifetime' => 2592000,
            ],
            [
                new GrantType\ClientCredentials($this->storage)
            ]
        );
    }

    /**
     * @return Storage\Pdo
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @return Server
     */
    public function getServer()
    {
        return $this->server;
    }
}