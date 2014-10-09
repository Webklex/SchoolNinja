<?php
/*
 * File: index.php
 * Category: -
 * Author: MSG
 * Created: 23.09.14 09:16
 * Updated: -
 *
 * Description:
 *  -Main app index
 */

error_reporting(1);
ini_set('display_errors',1);

require_once __DIR__.'/../app/assets/Router.php';

$app = new Router();