<?php

$db = new mysqli('localhost', 'niewiado_skillmon', 'Pokemon123', 'niewiado_szkola');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }
?>
