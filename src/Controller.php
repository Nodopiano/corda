<?php
Namespace Nodopiano\Corda;

use Nodopiano\Corda\QueryBuilder;
use Nodopiano\Corda\Repositories\ApiRepository;

/**
 *
 */
class Controller
{

    protected $functions;
    protected $api;
    protected $view;

    function __construct()
    {
        $this->api = new ApiRepository(App::get('api')['driver']);
    }

    public function show()
    {
    }

    public function notFound()
    {
        return view('errors/404.html',['message' => 'Hello!']);
    }
}
