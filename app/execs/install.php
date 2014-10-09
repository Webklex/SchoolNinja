<?php
/*
 * File: install.php
 * Category: -
 * Author: MSG
 * Created: 24.09.14 08:28
 * Updated: -
 *
 * Description:
 *  -
 */

require_once __DIR__.'/../core/coreController.php';
$core = new coreController();

$db = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

$templine = '';
$errors = false;
$lines = file('../sql/database.sql');

try{
    foreach ($lines as $line){
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == ''){
            continue;
        }

        // Add this line to the current segment
        $templine .= $line;
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';'){
            // Perform the query
            $templine = str_replace('[%DB%]', DATABASE_NAME, $templine);

            $db->query($templine) or $errors[] = array('Fehler während der Installation => '.$db->error, $templine);
            // Reset temp variable to empty
            $templine = '';
        }
    }
    $success[] = 'Die Datenbank wurde erfolgreich installiert';
}catch(Exception $e){
    $errors[] = array('Die Datenbank konnte nicht installiert werden',$e->getMessage());
}

var_dump($errors);