<?php
class Artikli extends ActiveRecord{
    public $id,$descr,$price,$in_stock,$image,$cat_id;
    public static $table="products";
    public static $key="id";
}