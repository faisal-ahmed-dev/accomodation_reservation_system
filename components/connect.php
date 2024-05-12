<?php

$db_name = 'mysql:host=localhost;dbname=airbnb';
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_name, $user_name, $user_password);
$conn1 = new PDO($db_name, $user_name, $user_password);

?>