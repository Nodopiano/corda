<?php
namespace Nodopiano\Corda\Repositories;

class ApiRepository
{
    protected $api;

    public function __construct($api)
    {
        $this->api = new $api;
    }

    public function posts($id = null)
    {
        return $this->api->posts($id)->get();
    }

    public function pages($id = null)
    {
        return $this->api->pages($id)->get();
    }

    public function media($id = null)
    {
        return $this->api->pages($id)->get();
    }

    public function __call($name, $id = null)
    {
        return $this->api->customPost($name, $id)->get();
    }

}
