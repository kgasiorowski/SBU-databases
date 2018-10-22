<?php

$users = array(

    'user1' => 'pass1',
    'user2' => 'pass2',
    'user3' => 'pass3',
    'user4' => 'pass4',
    'user5' => 'pass5'


);

echo 'INSERT INTO user(username, password) VALUES'."\n";

$valstring = "";

foreach($users as $key => $value)
    $valstring .= "('$key', '$value'),\n";

$valstring = rtrim($valstring, ",\n");

$valstring .= ";";

echo $valstring;

?>
