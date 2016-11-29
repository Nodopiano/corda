<?php

namespace Nodopiano\Corda;

use Mailchimp;

/**
 * Class NewsLetter
 * @author Marco Bonomo
 * @package Corda
 */

class NewsLetter
{

  protected static $mc;

  public static function load()
  {
    $api_key = getenv('MAILCHIMP_KEY');
    static::$mc = new Mailchimp($api_key);
  }

  public static function subscribe($list,$data = array())
  {
    static::load();
    try {
      static::$mc->lists->subscribe($list, $data);
      return true;
    } catch (Mailchimp_Error $e) {
      return false;
    }
  }
}
