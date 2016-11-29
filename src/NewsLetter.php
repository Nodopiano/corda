<?php

namespace Nodopiano\Corda;

use MailChimp\MailChimp;

/**
 * Class NewsLetter
 * @author Marco Bonomo
 * @package Corda
 */

class NewsLetter
{

  protected $mc;

  public static function load()
  {
    $api_key = getenv('MAILCHIMP_KEY');
    static::$mc = new MailChimp($api_key);
  }

  public static function subscribe($list,$data = array())
  {
    try {
      static::$mc->lists->subscribe($list, $data);
      return true;
    } catch (Mailchimp_Error $e) {
      return false;
    }
    }
  }
}
