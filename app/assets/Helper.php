<?php
/*
 * File: Helper.php
 * Category: -
 * Author: MSG
 * Created: 24.09.14 12:51
 * Updated: -
 *
 * Description:
 *  -
 */

class Helper {
    public static function generatePasswd($str, $salt = false){
        $passwd_tmp = hash('sha256', $str);
        $passwd = hash('sha512', $passwd_tmp.substr($passwd_tmp, 2, 16));

        return ($salt == false?$passwd:substr($passwd_tmp, 2, 16));
    }
}