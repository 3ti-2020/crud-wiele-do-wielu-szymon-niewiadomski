<?php

$db = new mysqli('95.216.64.27', 'niewiado_skillmon', 'Pokemon123', 'niewiado_szkola');

if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>
