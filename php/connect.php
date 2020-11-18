<?php

$db = new mysqli('mysql-propsu.alwaysdata.net', 'propsu', 'P0kemon12#', 'propsu_szkola');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

function checkPermission($id){
  if(!in_array($id, $_SESSION['permissions']))
    die("NO PERMISSION TO ACCESS!");
}

session_start();
?>
