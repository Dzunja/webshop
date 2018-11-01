<?php
class Session{

    public static function start(){
        if(!isset($_SESSION)){
            session_start();
        }
    }

    public static function set($key,$value){
        self::start();
        $_SESSION[$key]=$value;
    }

    public static function get($key,$default=null){
        if(isset($_SESSION[$key]))
            return $_SESSION[$key];
        else return $default;
    }

    public static function stop(){
        self::start();
        foreach ($_SESSION as $k=>$v){
            unset($_SESSION[$k]);
        }

        session_destroy();
    }


}