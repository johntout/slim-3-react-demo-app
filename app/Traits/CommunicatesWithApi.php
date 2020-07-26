<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait CommunicatesWithApi
{
    /**
     * @return Client
     */
    public function client()
    {
        return new Client([
            'timeout'  => 20,
        ]);
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function requestToken()
    {
        $client = $this->client();

        $response = $client->request('POST', env('APP_URL').'/oauth/token', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'scope' => '',
            ],
            'verify' => false
        ]);

        $tokenInfo = json_decode((string) $response->getBody(), true);

        $file = fopen(app_dir().'/token.json', 'w');
        fwrite($file, json_encode($tokenInfo, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
        fclose($file);

        return $tokenInfo;
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function retrieveToken()
    {
        $tokenFile = app_dir().'/token.json';

        if (file_exists($tokenFile)) {
            $token = json_decode(file_get_contents($tokenFile), 1);
            $token = $token['access_token'];
        }
        else {
            $token = $this->requestToken()['access_token'];
        }

        return $token;
    }
}