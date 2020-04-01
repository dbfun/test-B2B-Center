<?php

require_once "vendor/autoload.php";

$str = "https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3";

echo (new App\Demo())->task2($str);

