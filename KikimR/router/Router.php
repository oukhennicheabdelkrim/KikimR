<?php
namespace KikimR\router;
use KikimR\data\DataInput;

class Router
{
    private static $url='';
    private static $routes=array();
    private static $withUrl=false;
    private static $statusCode =200;
    private static $middlewares =array();
    private static $routeOK = false;



    /**
     * init Router
     */
    public static function init()
    {

        if (isset($_SERVER['REQUEST_URI'])&&isset($_SERVER['SCRIPT_NAME']))
        {
            self::$url=self::getRequestPath();
            self::$withUrl=true;
        }
    }

    /**
     * @return string
     * get request path
     */
    private static function getRequestPath()
    {
        $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $script_name = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
        $parts = array_diff_assoc($request_uri, $script_name);
        if (empty($parts))
        {
            return '';
        }
        $path = implode('/', $parts);
        if (($position = strpos($path, '?')) !== false)
        {
            $path = substr($path, 0, $position);
        }
        return $path;
    }


    /**
     * @param $path
     * @param $callable
     * @param string $name
     * @return Route
     */
    public static function get($path, $callable, $name="")
    {
        $route= new Route ($path,$callable,$name);

        self::$routes['get'][]=$route;
        return $route;
    }

    /****************post*****************/

    public static function post($path,$callable,$name="")
    {

        $route= new Route ($path,$callable,$name);

        self::$routes['post'][]=$route;

        return $route;

    }

    /**
     * @param $callable callable Middleware
     * @param array $params
     */
    public static function addMiddleware($callable, $params=[])
    {
        $middleware=['fn'=>$callable,'params'=>$params];
        self::$middlewares[]=$middleware;
    }

    /**
     * @param int $statusCode
     * change the value of the statuscode in response
     */
    public static function setStatusCode($statusCode)
    {
        self::$statusCode = $statusCode;
    }


    /**
     * @param $statusCode
     * @param $callable
     * @param array $params
     *
     */
    public static function whenStatusCode($statusCode, $callable, $params=[])
    {
        $action=array('fn'=>$callable,'params'=>$params);
        RouterException::$statuCodes[$statusCode]["opp"]=$action;
    }


    /***************run******************/

    private static function runMiddlewares()
    {
        $nb_midelware=count(self::$middlewares);
        for ($i=0;$i<$nb_midelware;$i++)
            call_user_func_array(self::$middlewares[$i]['fn'],self::$middlewares[$i]['params']);
    }


    private static function message()
    {
        if (self::$statusCode!=200)
        {
            if (RouterException::isSetStatusCode(self::$statusCode))
            {
                http_response_code(self::$statusCode);
                if (RouterException::isSetOpp(self::$statusCode))
                {
                    $opp=RouterException::$statuCodes[self::$statusCode]["opp"];
                    call_user_func_array($opp['fn'],$opp['params']);
                }
                else
                {
                    View::showMessage(RouterException::$statuCodes[self::$statusCode]['message']);
                }
            }
            else
            {
                View::showMessage("Status code ".self::$statusCode." not difined.");
            }
        }
        return true;
    }

    public static function findRouteOk()
    {
        if (self::$withUrl)
        {       self::runMiddlewares();
                $method=strtolower($_SERVER['REQUEST_METHOD']);

                if (isset(self::$routes[$method]))
                {
                    foreach (self::$routes[$method] as $route)
                    {

                        if ($route->isMe(self::$url))
                        {
                            self::$statusCode=200;
                            return self::$routeOK=$route;
                        }
                    }
                    return self::$statusCode=404;
                }
                else
                {
                    return self::$statusCode=405;
                }
         }
         else
         {
             return self::$statusCode=404;
         }

    }

    public static function getRouteOkParams()
    {
        if (Router::$routeOK!==false)
        {
            return self::$routeOK->getParams();
        }
        return [];
    }
    public static function run()
    {
        if (self::$routeOK!==false)
        {
            self::$routeOK->call();
        }
        return self::message();
    }




}
?>