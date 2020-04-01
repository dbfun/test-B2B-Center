<?php

namespace App\Domain\Uri;

trait Helper {

  public function task2($str)
  {
    $ub = new UriBuilder($str);

    return $ub
      ->deleteParamsByVal("3")
      ->sortParamsByVal(true)
      ->addParam("url", "/test/index.html")
      ->setPath("/");
  }

}

