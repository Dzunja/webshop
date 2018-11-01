<?php
class Orders extends ActiveRecord{
    public $order_id,$p_id,$c_id,$qty,$order_date;
    public static $table="orders";
    public static $key="order_id";
}