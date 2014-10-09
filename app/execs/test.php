<?php
/*
 * File: test.php
 * Category: -
 * Author: MSG
 * Created: 24.09.14 08:39
 * Updated: -
 *
 * Description:
 *  -
 */

$str = 'admin';

$passwd_tmp = hash('sha256', $str);

$salt = substr($passwd_tmp, 2, 16);

$passwd = hash('sha512', $passwd_tmp.$salt);

echo "\n\n";
echo $passwd."\n";
echo $salt."\n";