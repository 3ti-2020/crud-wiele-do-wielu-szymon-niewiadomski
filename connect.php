<?php

$db = new mysqli('hs5.linux.pl', 'niewiado_skillmon', 'Pokemon123', 'niewiado_szkola');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";
?>
