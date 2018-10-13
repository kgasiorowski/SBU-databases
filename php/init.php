<?php 

$db = null;

try{

    $db = new PDO('mysql:dbname=IMDB_clone;host=localhost','root','password');

}catch(PDOException $e){

    echo 'Connection failed: i'.$e->getMessage();

}
   


?>
