<?php

namespace Nodopiano\Corda;

use Twig_Autoloader;
use Twig_Loader_Filesystem;
use Twig_Environment;
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
  }

}
