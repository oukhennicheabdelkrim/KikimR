<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 22/02/2018
 * Time: 22:08
 */

namespace  oukhennicheabdelkrim\KikimR;


use  oukhennicheabdelkrim\KikimR\router\Router;
use  oukhennicheabdelkrim\KikimR\validator\Validator;
use  oukhennicheabdelkrim\KikimR\data\DataInput;

class KikimR
{

    private static $devMode;
    public static function Init($devMode = false, $module = ['validator' => 1])
    {
        self::$devMode = $devMode;
        Router::init(); //Init router
    }

    public static function run()
    {
        Router::findRouteOk(); // routeOk
        DataInput::loadInputs(Router::getRouteOkParams()); // load data post get and params
        Validator::init(DataInput::$params); // init validator with dataInput
        Router::run();


    }

}