<?php

namespace App\Services;

use App\Helpers\App;
use Illuminate\Support\Arr;
use App\Interfaces\Request;
use App\Interfaces\Services;
use \Slim\Http\Request as SlimRequest;

class RequestService extends SlimRequest implements Services, Request
{
    /*
     * var Container $container
     */
    public static $container;

    /**
     * @return RequestService
     */
    public static function boot() :RequestService
    {
        $request = RequestService::createFromEnvironment(self::$container['environment']);

        return $request;
    }

    /**
     * @return array
     */
    public function getInfo() :array
    {
        return [
            'attributes' => $this->getAttributes(),
            'queryParams' => $this->getQueryParams(),
            'parsedBody' => $this->getParsedBody(),
        ];
    }

    /**
     * @param array $data
     */
    public function set(array $data) :void
    {
        foreach ($data as $key => $value) {
            if ($this->isPost()) {
                Arr::set($this->bodyParsed, $key, $value);
            }
            else {
                Arr::set($this->queryParams, $key, $value);
            }
        }
    }

    /**
     * @param string $key
     * @param string $sanitize
     * @return array|int|mixed|object|null
     */
    public function inputs($key = '*', $sanitize = 'STRING')
    {
        if ($this->isPost()) {
            $data = $this->getParsedBody();
        }
        else {
            $data = $this->getQueryParams();
        }

        if ($key == '*') {
            return $data;
        }
        else {
            $value = Arr::get($data, $key);

            if (!empty($sanitize) && !is_array($value)) {
                if (is_int($value)) {
                    $sanitize = 'INT';
                }

                $value = App::sanitizeInput($value, $sanitize);

                if ($sanitize == 'INT' && empty($value)) {
                    return 0;
                }
            }

            return $value;
        }
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key) :bool
    {
        return in_array($key, array_keys($this->inputs()));
    }

    /**
     * @param string $key
     * @return array|mixed
     */
    public function queryParams(string $key = '*')
    {
        if ($key == '*') {
            return $this->getQueryParams();
        }

        return Arr::get($this->getQueryParams(), $key);
    }
}