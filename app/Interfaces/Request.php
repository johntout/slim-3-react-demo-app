<?php

namespace App\Interfaces;

use Psr\Http\Message\ServerRequestInterface;

interface Request extends ServerRequestInterface
{
    /**
     * @return array
     */
    public function getInfo() :array;

    /**
     * @param array $data
     */
    public function set(array $data) :void;

    /**
     * @param string $key
     * @param string $sanitize
     * @return array|int|mixed|object|null
     */
    public function inputs($key = '*', $sanitize = 'STRING');

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key) :bool;

    /**
     * @param string $key
     * @return mixed
     */
    public function queryParams(string $key = '*');
}