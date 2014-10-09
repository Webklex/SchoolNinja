<?php
/*
 * File: flasher.php
 * Category: -
 * Author: MSG
 * Created: 24.09.14 10:19
 * Updated: -
 *
 * Description:
 *  -
 */

$flasher = $this->app->getFlasher();

if($flasher !== false){
    foreach($flasher as $msg){
        ?>
        <div class="row">
            <div class="alert alert-<?=$msg['type']?>">
                <h4><?=$msg['title']?></h4>
                <p><?=$msg['content']?></p>
            </div>
        </div>
    <?php
    }
}
?>