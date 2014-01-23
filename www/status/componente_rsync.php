<?php
global $componentes, $doc_root;
require("index_pass.php");

$rsync_status_file = "$doc_root/status/datasync.status";

if(!is_readable($rsync_status_file))
  throw new Exception("No hay información de estado");

$rsync = file_get_contents($rsync_status_file);

$componentes['rsync']['detalles'] = nl2br($rsync);
$falla = stripos($rsync, "error");

if($falla === FALSE)
{
  if(stripos($rsync, "exito") !== FALSE)
  {
    $componentes['rsync']['estado'] = 'alert-success';
    $componentes['rsync']['icono'] = 'icon-thumbs-up';
    $arr = explode("-", $rsync);
    $componentes['rsync']['mensaje'] = "Éxito: ".$arr[1];
  }
}

else
{
  throw new Exception("Error al sincronizar archivos.");
  
}