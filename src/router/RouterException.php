<?php
/**
* 
*/
namespace oukhennicheabdelkrim\KikimR\router;
class RouterException
{
	
    public static $statuCodes = array(
          "400"=>array("message"=>"Bad Request."),
          "401"=>array("message"=>"Unauthorized."),
          "404"=>array("message"=>"Not Found."),
          "405"=>array("message"=>"Method not alowed."),
          "500"=>array("message"=>"Internal Server Error."));

    public static function isSetStatusCode($statusCode)
    {
        return !empty(self::$statuCodes[$statusCode]);
    }

    public static function isSetOpp($statusCode)
    {
        return !empty(self::$statuCodes[$statusCode]["opp"]);
    }

}
?>