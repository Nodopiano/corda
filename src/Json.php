<?php

namespace Nodopiano\Corda;

use Nodopiano\Corda\Response;

/**
 * Class View
 * @author yourname
 */
class Json implements Response
{
  protected $data;

  /**
   * @param mixed $view,datadependencies
   */
  public function __construct($data)
  {
        $this->data = $data;
  }

  /**
   * undocumented function
   *
   * @return void
   */
  public function render()
  {
    header('Content-Type: application/json');
    echo json_encode($this->data);
  }

}
