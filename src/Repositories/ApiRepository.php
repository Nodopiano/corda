<?php
namespace Nodopiano\Corda\Repositories;

use Nodopiano\Corda\Cache;

class ApiRepository
{
    protected $api;
    protected $cache;

    public function __construct($api)
    {
        $this->api = new $api;
    }

    public function posts($id = null)
    {
         return Cache::get($this->api->posts($id));
    }

    public function pages($id = null)
    {
        return Cache::get($this->api->pages($id));
    }

    public function media($id = null)
    {
        return Cache::get($this->api->pages($id));
    }

    public function __call($name, $id = null)
    {
        return Cache::get($this->api->customPost($name, $id));
    }

}
