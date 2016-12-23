<?php

namespace Nodopiano\Corda;

use Twig_Autoloader;
use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_SimpleFunction;
use Nodopiano\Corda\Response;

/**
 * Class View
 * @author yourname
 */
class View implements Response
{
    protected $twig;
    protected $view;
    protected $data;

    /**
     * @param mixed $view,datadependencies
     */
    public function __construct($view,array $data = array())
    {
        Twig_Autoloader::register();
        $this->twig = new Twig_Environment(new Twig_Loader_Filesystem('../app/views'));
        $function  = new Twig_SimpleFunction('colorContrast', [$this, 'colorContrastFunc']);
        $this->twig->addFunction($function);
        $this->addTwigGlobals();
        $this->view = $view;
        $this->data = $data;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function render()
    {
        echo $this->twig->loadTemplate($this->view)->render($this->data);
    }

    public function addTwigGlobals()
    {
        //Add avaialble language to twig template as a global variable
        $this->twig->addGlobal('analytics', getenv('ANALYTICS'));
        $this->twig->addGlobal('facebook', getenv('FACEBOOK'));
        $this->twig->addGlobal('hotjar', getenv('HOTJAR'));
        $this->twig->addGlobal('mybusiness', getenv('MYBUSINESS'));
        $this->twig->addGlobal('cookiePolicyId', getenv('COOKIE_POLICY'));
        $this->twig->addGlobal('siteId', getenv('IUBENDA_SITE_ID'));
    }

    public function colorContrastFunc($value) {
        $value = str_replace(' ', '', $value);
        $rgb = new \stdClass;
        $opacity = 1;
        if (substr($value, 0, 3) != 'rgb') {
            $value = str_replace('#', '', $value);
            if (strlen($value) == 3) {
                $h0 = str_repeat(substr($value, 0, 1), 2);
                $h1 = str_repeat(substr($value, 1, 1), 2);
                $h2 = str_repeat(substr($value, 2, 1), 2);
                $value = $h0 . $h1 . $h2;
            }
            $rgb->r = hexdec(substr($value, 0, 2));
            $rgb->g = hexdec(substr($value, 2, 2));
            $rgb->b = hexdec(substr($value, 4, 2));
        } else {
            preg_match("/(\\d+),\\s*(\\d+),\\s*(\\d+)(?:,\\s*(1\\.|0?\\.?[0-9]?+))?/uim", $value, $matches);
            $rgb->r = $matches[1];
            $rgb->g = $matches[2];
            $rgb->b = $matches[3];
            $opacity = isset($matches[4]) ? $matches[4] : 1;
            $opacity = substr($opacity, 0, 1) == '.' ? '0' . $opacity : $opacity;
        }
        $yiq = ((($rgb->r * 299) + ($rgb->g * 587) + ($rgb->b * 114)) / 1000) >= 128;
        $contrast = $yiq || ($opacity == 0 || (float) $opacity < 0.35);
        return $contrast;
    }


}
