<?php
$db = new Mysqli("mysql-propsu.alwaysdata.net", "propsu", "P0kemon12#", "propsu_szkola");
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }
?>
