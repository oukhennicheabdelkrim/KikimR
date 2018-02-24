<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 22/02/2018
 * Time: 19:00
 */

namespace KikimR\validator;
class Validator
{
    public static $get;
    public static $post;
    public static $params;

    public static function init($params)
    {
        self::$get = new Get($_GET);
        self::$post = new Post($_POST);
        self::$params = new Params($params);
    }


}