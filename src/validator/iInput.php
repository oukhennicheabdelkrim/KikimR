<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 22/02/2018
 * Time: 19:18
 */

namespace  oukhennicheabdelkrim\KikimR\validator;


interface iInput
{

    public function exist($name);

    public function exists($arrayOfNames);

    public function is($arrayNamesRegexp);

    public function isNumber($name);

    public function isAlphanum($name);

    public function isEqual($name, $value);

}