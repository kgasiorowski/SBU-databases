<?php 
//require_once this file in order to acces the local mysql server.

$db = null;
try{

    $db = new PDO('mysql:dbname=imdb;host=localhost','root','password');

}catch(PDOException $e){

    echo 'Connection failed: i'.$e->getMessage();

}   
?>
