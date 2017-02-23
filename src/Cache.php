<?php

namespace Nodopiano\Corda;

Use Exception;
use Nodopiano\Corda\Api\Contracts\ApiInterface;

/**
 * Class App
 * @author yourname
 */
 
class Cache
{

    public static function get(ApiInterface $query)
    {
        if (getenv('CACHE') == 'true') {
            return self::get_content($query);            
        }
        return $query->get();
    }
 
    public static function store(ApiInterface $query,$file)
    {
            $content = $query->get();
            file_put_contents($file,json_encode($content));
            return $content;
    }

    public static function get_content(ApiInterface $query) {
        $storagePath = App::get('dir').'/storage/cache/';
        $file = $storagePath.base64_encode($query->getUrl()); 
        $current_time = time(); 
        $expire_time = 2 * 60 * 60; 
        if(file_exists($file)) {
            $file_time = filemtime($file);
            if ($current_time - $expire_time < $file_time) return json_decode(file_get_contents($file));
            return self::store($query,$file);            
        }
        else {
            return self::store($query,$file);            
        }
    }

}
