<?php
/*
 * File: header.php
 * Category: -
 * Author: MSG
 * Created: 23.09.14 10:31
 * Updated: -
 *
 * Description:
 *  -
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?=WEBSITE_NAME?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=PAGE_ROOT?>templates/<?=$this->theme?>/css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="<?=PAGE_ROOT?>templates/<?=$this->theme?>/css/bootswatch.min.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="<?=PAGE_ROOT?>" class="navbar-brand"><?=WEBSITE_NAME?></a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Themes <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="themes">
                        <li><a href="../default/">Default</a></li>
                        <li class="divider"></li>
                        <li><a href="../cerulean/">Cerulean</a></li>
                        <li><a href="../cosmo/">Cosmo</a></li>
                        <li><a href="../cyborg/">Cyborg</a></li>
                        <li><a href="../darkly/">Darkly</a></li>
                        <li><a href="../flatly/">Flatly</a></li>
                        <li><a href="../journal/">Journal</a></li>
                        <li><a href="../lumen/">Lumen</a></li>
                        <li><a href="../paper/">Paper</a></li>
                        <li><a href="../readable/">Readable</a></li>
                        <li><a href="../sandstone/">Sandstone</a></li>
                        <li><a href="../simplex/">Simplex</a></li>
                        <li><a href="../slate/">Slate</a></li>
                        <li><a href="../spacelab/">Spacelab</a></li>
                        <li><a href="../superhero/">Superhero</a></li>
                        <li><a href="../united/">United</a></li>
                        <li><a href="../yeti/">Yeti</a></li>
                    </ul>
                </li>
                <li>
                    <a href="../help/">Help</a>
                </li>
                <li>
                    <a href="http://news.bootswatch.com">Blog</a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Download <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="download">
                        <li><a href="./bootstrap.min.css">bootstrap.min.css</a></li>
                        <li><a href="./bootstrap.css">bootstrap.css</a></li>
                        <li class="divider"></li>
                        <li><a href="./variables.less">variables.less</a></li>
                        <li><a href="./bootswatch.less">bootswatch.less</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php
                if($this->app->user == null){
                    ?>
                    <li><a href="<?=PAGE_ROOT?>user/register/">Registrieren</a></li>
                    <li><a href="<?=PAGE_ROOT?>user/login/">Login</a></li>
                    <?php
                }else{
                    ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Willkommen <b><?=$this->app->user->name?></b> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=PAGE_ROOT?>user/profile/">Profil</a></li>
                            <li><a href="<?=PAGE_ROOT?>user/edit/">Einstellungen</a></li>
                            <li class="divider"></li>
                            <li><a href="<?=PAGE_ROOT?>user/logout/">Logout</a></li>
                        </ul>
                    </li>
                <?php
                }
                ?>
            </ul>

        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>&nbsp;</h1>
        </div>
    </div>
    <div class="jumbotron">