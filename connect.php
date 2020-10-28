<?php

$db = new mysqli('hs5.linux.pl', 'niewiado_skillmon', 'Pokemon123', 'niewiado_szkola');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }
?>
