<?php
error_reporting(E_ALL);
ini_set("display_errors", true);
header('Content-Type: text/html; charset=UTF-8');

require_once 'conexion_bd.php';

try {
  $pdo = new PDO(
    "mysql:host=$db_host;dbname=$db_name",
    $db_user, $db_pass);
  
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec("SET NAMES UTF8");
}
catch (PDOException $e) {
  throw new RuntimeException('Error de conexión a la BD: ' . $e->getMessage());
}