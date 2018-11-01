<?php
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DB','store');

function __autoload($class){
    require_once "classes/". $class.".php";
}

