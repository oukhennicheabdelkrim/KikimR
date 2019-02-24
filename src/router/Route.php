<?php
namespace oukhennicheabdelkrim\KikimR\router;



use oukhennicheabdelkrim\KikimR\Conf;

/**
 *
 */
class route
{
    private $path=array();
    private $callable;
    private $matches=array();
    private $name;
    private $regExps=array();
    private $params=array();

    function __construct($path,$callable,$name="")
    {
        $this->path[]=trim($path,'/');
        $this->callable=$callable;
        $this->name=trim($name,'/');
    }

    /**
     * @param $url
     * @return bool
     */
    public function isMe($url)
    {
        $nb_paths=count($this->path);

        for ($i=0;$i<$nb_paths;$i++)
        {
            $this->clearParams();
            $path=preg_replace_callback('#\[[a-z0-9_]+\]#i', [$this,'paramsV'], $this->path[$i]);

            $regexp='#^'.trim($this->name.'/'.$path,'/').'$#'.(Conf::URL_CASE_SENSITIVE?'':'i');

            if(preg_match($regexp,$url,$matches))
            {
                array_shift($matches);
                $this->matches=$matches;
                $this->loadParams($matches);
                return true;
            }
        }
       $this->clearParams();
        return false;
    }

    private function paramsV($v)
    {

        $v=preg_replace('#\[|\]#','',$v[0]);
        $this->pushParam($v);
        if(!empty($this->regExps[$v]))
        {
            return '('.$this->regExps[$v].')';
        }
        else return '([^/]+)';
    }

    /**
     * @param $param
     * @param $regexp
     * @return $this
     */
    public function with($param, $regexp)
    {
        $this->regExps[$param]=$regexp;
        return $this;
    }

    /**
     * @param $path
     * @return $this
     */
    public function addPath($path)
    {
        $this->path[]=trim($path,'/');
        return $this;
    }


    /**
     *
     */
    public function call()
    {
        call_user_func_array($this->callable,$this->matches);
        //var_dump($this);
    }

    private  function clearParams()
    {
        $this->params=array();
    }

    /**
     * @param $paramName
     */
    private  function pushParam($paramName)
    {
        $this->params[]=$paramName;
    }

    private function loadParams($matches)
    {
        $nb_matches= count($matches);
        $paramsNames=$this->params;
        $this->clearParams();
        for ($i=0;$i<$nb_matches;$i++)
        {
            $this->params[$paramsNames[$i]]=$matches[$i];
        }
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

}

?>
