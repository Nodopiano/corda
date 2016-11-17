<?php
Namespace Nodopiano\Corda;

Use Nodopiano\Corda\Router;
Use Nodopiano\Corda\Request;
Use Nodopiano\Corda\Database\Connection;
Use Nodopiano\Corda\Database\QueryBuilder;
Use Nodopiano\Corda\App;
Use Dotenv\Dotenv;

/**
 * Class Bootstrap
 * @author yourname
 */
class Bootstrap
{

    public static function boot()
    {
      $dotenv = new Dotenv\Dotenv(__DIR__);
      $dotenv->load();
        // Nodopiano::bind('database', new QueryBuilder(
            // Connection::make(Nodopiano::get('config')['database'])
        // ));
        // Nodopiano::bind('api', require 'config/api.php' );
    }

}

