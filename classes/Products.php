<?php
class Products extends ActiveRecord{
    public $id,$desc,$price,$in_stock,$image,$cat_id;
    public static $table="products";
    public static $key="id";
}