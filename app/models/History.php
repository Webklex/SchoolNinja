<?php
 /*
 * File: History.php
 * Category: -
 * Author: MSG
 * Created: 09.10.14 22:26
 * Updated: -
 *
 * Description:
 *  -
 */

class History extends ActiveRecord\Model {
    static $belongs_to = array(
        array('user'),
        array('answer')
    );
}
?>
