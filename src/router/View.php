<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 22/02/2018
 * Time: 18:11
 */

namespace  oukhennicheabdelkrim\KikimR\router;


class View implements  \oukhennicheabdelkrim\KikimR\view\View
{
    public static function showMessage($message)
    {
        self::showTitle(" KikimR / Router");
        echo '<br><div style="color:'.self::COLOR1.'">'.$message.'</div>';
    }


    public static function showTitle($title)
    {
       echo '<b>'.$title.'</b><br><hr>';
    }

}
