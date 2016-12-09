<?php

//require_once("config.php");

/**
 * 
 */

 
class dbcon
{
 
   public function getDBCon(){
        $dbhost = "localhost";
        $dbusername = "stephenkearns1";
        $dbpassword = "";
        $dbname = "c9";
        $con = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    }
}




?>