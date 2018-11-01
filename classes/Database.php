<?php

class Database {
    private static $instance = null;
    private function __construct()
    {
    }

    public static function getInstance(){
        if(!self::$instance)
            self::$instance=new PDO("mysql:host=localhost;dbname=store","root","");
        return self::$instance;
    }
}

