<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 22/02/2018
 * Time: 20:19
 */

namespace  oukhennicheabdelkrim\KikimR\validator;


abstract class Input implements iInput
{

    private $data;

    public function __construct($data)
    {
      $this->data=$data;
    }

    public function exist($name)
    {
        return isset($this->data[$name]);
    }


    public function exists($names)
    {
        if (is_array($names))
        {
            $nb = count($names);
            for ($i = 0; $i < $nb; $i++) if (!$this->exist($names[$i])) return false;
            return true;
        }
        else
        {
            return $this->exist($names);
        }

    }

    public function is($arrayNamesRegexp)
    {
       if (count($arrayNamesRegexp)>0)
       {
           foreach ($arrayNamesRegexp as $name=>$regExp)
           {

               if (!isset($this->data[$name]) || !preg_match('#^' . $regExp . '$#', $this->data[$name]))
               {
                   return false;
               }
           }
           return true;
       }

    }


    public function isNumber ($name)
    {
        return $this->is([$name=>RegExp::NUMBER]);
    }
    public function isAlphanum ($name)
    {

        return $this->is([$name=>RegExp::ALPHNUMS]);
    }

    public function isEqual($name,$value)
    {
        return isset($this->data[$name])&&$this->data[$name]===$value;
    }




}