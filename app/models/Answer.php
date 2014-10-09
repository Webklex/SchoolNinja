<?php
 /*
 * File: Answer.php
 * Category: -
 * Author: MSG
 * Created: 09.10.14 22:25
 * Updated: -
 *
 * Description:
 *  -
 */

class Answer extends ActiveRecord\Model {
    static $has_many = array(
        array('histories'),
        array('users', 'through' => 'histories')
    );

    public function __toString() { return 'Answer '. $this->name; }
    static $validates_presence_of = array(array('answer'));
    static $belongs_to = array(array('question'));


}
?>