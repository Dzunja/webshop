<?php
class Customer_Reg extends ActiveRecord{
    public $customer_id,$customer_ip,$customer_name,$customer_email,$customer_pass,$customer_country,$customer_city,$customer_contact,$customer_address,$customer_image;
    public static $table="customers";
    public static $key="customer_id";
}