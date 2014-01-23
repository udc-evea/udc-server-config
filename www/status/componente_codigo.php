<?php
global $componentes, $doc_root;
require("index_pass.php");

$git_status_file = "$doc_root/status/gitsync.status";

if(!is_readable($git_status_file))
  throw new Exception("No hay información de estado");

$git = file_get_contents($git_status_file);

$componentes['git']['detalles'] = nl2br($git);
$falla = stripos($git, "error");

if($falla === FALSE)
{
  if(stripos($git, "exito") !== FALSE)
  {
    $componentes['git']['estado'] = 'alert-success';
    $componentes['git']['icono'] = 'icon-thumbs-up';
    $arr = explode("-", $git);
    $arr = array_reverse($arr);
    $componentes['git']['mensaje'] = "Éxito: ".$arr[0];
  }
}

else
{
  throw new Exception("Error al sincronizar código.");
}