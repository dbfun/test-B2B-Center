<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../vendor/autoload.php";

class DemoTest extends TestCase
{
  use \App\Domain\Uri\Helper;

  /**
   * @dataProvider demoTestProvider
   * @return void
   */
  public function testDemo($str, $expected)
  {
    $obj = new \App\Demo();
    $actual = (string)$obj->task2($str);
    $this->assertSame($expected, $actual);
  }

  public function demoTestProvider()
  {
    return [
      [
        "https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3",
        "https://www.somehost.com/?param4=1&param3=2&param1=4&url=%2Ftest%2Findex.html"
      ],
      [
        "https://user:pass@www.somehost.com:8082/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3#foo",
        "https://user:pass@www.somehost.com:8082/?param4=1&param3=2&param1=4&url=%2Ftest%2Findex.html#foo"
      ]
    ];
  }
}
