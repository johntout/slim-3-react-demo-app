<?php

namespace App\Resources;

use Psr\Http\Message\ResponseInterface as Response;

abstract class GenericResource
{
    /*
     * var array
     */
    public $data = [];

    /**
     * @param mixed $resource
     * @return mixed
     */
    abstract protected function toArray($resource);

    /**
     * GenericResource constructor.
     * @param $resource
     */
    public function __construct($resource)
    {
        if ($resource) {
            if (is_array($resource)) {
                foreach ($resource as $res) {
                    $this->data[] = $this->toArray($res);
                }
            }
            else {
                $this->data = $this->toArray($resource);
            }
        }
    }

    /**
     * @return Response
     */
    public function toResponse() :Response
    {
        return response()->withJson($this->data);
    }
}