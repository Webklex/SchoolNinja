<?php
 /*
 * File: Module.php
 * Category: -
 * Author: MSG
 * Created: 09.10.14 22:26
 * Updated: -
 *
 * Description:
 *  -
 */

class Module extends ActiveRecord\Model {
    public function __toString() { return 'Modul '. $this->name; }

    static $validates_presence_of = array(array('name'));

    static $has_many = array(array('questions'));
}
?>
