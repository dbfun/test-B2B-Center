<?php

namespace App\Domain\Uri;

class UriBuilder
{

  protected $parts;

  public function __construct(string $str)
  {
    $this->parts = parse_url($str);
    if ($this->parts === false) throw new \Exception(sprintf("Wrong uri %s", $str));
    parse_str($this->parts["query"], $this->parts["query"]);
  }

  public function deleteParamsByVal(string $val): self
  {
    $this->parts["query"] = array_filter($this->parts["query"], function ($paramVal) use ($val) {
      return $paramVal !== $val;
    });
    return $this;
  }

  public function sortParamsByVal(bool $isOrderAsc): self
  {
    $isOrderAsc ? asort($this->parts["query"]) : arsort($this->parts["query"]);
    return $this;
  }

  public function addParam($param, $val): self
  {
    $this->parts["query"][$param] = $val;
    return $this;
  }

  public function setPath(string $str): self
  {
    $this->parts["path"] = $str;
    return $this;
  }

  public function __toString()
  {
    extract($this->parts);

    $uri = "$scheme://";

    if (isset($user)) {
      $uri .= "$user";
      if (isset($pass)) {
        $uri .= ":$pass";
      }
      $uri .= "@";
    }

    $uri .= "$host";
    if (isset($port)) {
      $uri .= ":$port";
    }
    $uri .= $path;

    if (count($query)) {
      $uri .= "?" . http_build_query($this->parts["query"]);
    }

    if (isset($fragment)) {
      $uri .= "#$fragment";
    }
    return $uri;
  }
}



