<?php 
//require_once this file in order to acces the local mysql server.

$db = null;
try{

    $db = new PDO('mysql:dbname=imdbc;host=localhost','imdbc_frontend','frontend_password');

}catch(PDOException $e){

    echo 'Connection failed: i'.$e->getMessage();

}   
?>
