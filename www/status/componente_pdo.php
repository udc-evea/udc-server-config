<?php
global $componentes, $doc_root;
require("index_pass.php");

require_once 'ejemplo_PDO_conexion.php';

$componentes['init']['estado']  = 'alert-success';
$componentes['init']['icono'] = 'icon-thumbs-up';
$componentes['init']['mensaje'] = "Conexión exitosa.";