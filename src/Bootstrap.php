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
    protected static $dir;



    public static function boot($dir)
    {

      static::$dir = $dir.'/';
      $dotenv = new Dotenv(static::$dir.'..');
      $dotenv->load();

      App::bind('config', require static::$dir.'config/config.php' );
      App::bind('dir', $dir );
      static::loadServicesConfiguration(App::get('config')['services']);

      if (App::get('config')['database']['enable']) {
        App::bind('database', new QueryBuilder(
            Connection::make(App::get('config')['database'])
        ));
      }
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public static function loadServicesConfiguration($services)
    {
      foreach ($services as $service) {
        App::bind($service, require static::$dir.'config/'.$service.'.php' );
      }
    }

}

