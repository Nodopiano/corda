<?php
Namespace Nodopiano\Corda;

Use Nodopiano\Corda\Router;
Use Nodopiano\Corda\Request;
Use Nodopiano\Corda\Database\Connection;
Use Nodopiano\Corda\Database\QueryBuilder;
Use Nodopiano\Corda\App;

/**
 * Class Bootstrap
 * @author yourname
 */
class Bootstrap
{

    public static function boot()
    {
        // Nodopiano::bind('database', new QueryBuilder(
            // Connection::make(Nodopiano::get('config')['database'])
        // ));
        // Nodopiano::bind('api', require 'config/api.php' );
    }

}

