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
        $flush = isset($_GET['cache']) ? true : false;
        if (getenv('CACHE') == 'true' && !$flush) {
            return self::get_content(json_encode($query->get()),$query->getUrl());            
        }
        return $query->get();
    }
 
    public static function store($content,$file)
    {
            file_put_contents($file,$content);
            return $content;
    }

    public static function flush ($file) 
    {
        if ($file) unlink($file);
        else {
            $storagePath = App::get('dir').'/storage/cache/';
            $publicPath = App::get('dir').'/../public/';
            array_map('unlink', glob($storagePath.'*'));
            array_map('unlink', glob($publicPath.'*.html'));
        }
    }

    public static function get_content($content, $url) {
        $storagePath = App::get('dir').'/storage/cache/';
        $file = $storagePath.base64_encode($url); 
        $current_time = time(); 
        $cache_time = getenv('CACHE_TIME') ?: 2;
        $expire_time = $cache_time * 60 * 60; 
        if(file_exists($file)) {
            $file_time = filemtime($file);
            if ($current_time - $expire_time < $file_time) return json_decode(file_get_contents($file));
            return self::store($content,$file);            
        }
        else {
            return self::store($content,$file);            
        }
    }

}
