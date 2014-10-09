<?php
/*
 * File: installController.php
 * Category: System, Installation
 * Author: MSG
 * Created: 23.09.14 10:41
 * Updated: -
 *
 * Description:
 *  System/App installation process
 */

class InstallController extends AppController {

    public function index(){}

    private function installDatabase(){
        $db = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

        $templine = '';
        $errors = false;
        $lines = file(APP_ROOT.'/app/sql/database.sql');

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

                    $db->query($templine) or $errors[] = array('Fehler während der Installation', $templine);
                    // Reset temp variable to empty
                    $templine = '';
                }
            }
            $success[] = 'Die Datenbank wurde erfolgreich installiert';
        }catch(Exception $e){
            $errors[] = array('Die Datenbank konnte nicht installiert werden',$e->getMessage());
        }

        return $errors;
    }
}