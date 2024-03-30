<?php

$host = "localhost";
$database = "contacts_app";
$user = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$host;dbname=$database",$user,$password);
  // foreach ($conn->query("SELECT * FROM contacts") as $fila) {
  //   print_r($fila);
  // }
  // $conn = null;
} catch (PDOException $e) {
  print "¡Error!: ". $e->getMessage() . "<br/>";
  die();
}
