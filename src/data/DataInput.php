<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 23/02/2018
 * Time: 18:01
 */
namespace oukhennicheabdelkrim\KikimR\data;
class DataInput
{
    public static $get=[];
    public static $post=[];
    public static $params;


    public static function loadInputs($params)
    {

        self::$get=$_GET;
        self::$post=$_POST;
        self::$params=$params;

    }

}