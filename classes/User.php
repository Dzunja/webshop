<?php
class User extends ActiveRecord {
    public static $table='users';
    public static $key='user_id';


    public static function logout(){
        Session::stop();
    }
}