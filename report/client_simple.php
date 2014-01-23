<?php
  require_once dirname(__FILE__).'/client_config.php';
  
  //$report_rsync = file_get_contents($rsync_status_file);
  $report_rsync = "No hay detalles.";
  //$report_mysql = file_get_contents($mysql_replication_status_file);
  $report_mysql = "No hay detalles.";

  $report_template = <<<EOF
*****************************************************************
REPORTE DE ESTADO - SERVER HASH %s
FECHA/HORA: %s
*****************************************************************

ESTADO SINC. ARCHIVOS
-----------------------------------------------------------------
%s
------------------------------------------------------------------
FIN REPORTE

ESTADO REPLICACION BD
-----------------------------------------------------------------
%s
------------------------------------------------------------------
FIN REPORTE
EOF;

  $data = array('hash' => $hash, 'report' => sprintf($report_template, $hash, date("Y/m/d h:i:s"), $report_rsync, $report_mysql));

  // use key 'http' even if you send the request to https://...
  $options = array('http' => array('method'  => 'POST','content' => http_build_query($data), 'header' => 'Content-type: application/x-www-form-urlencoded'));
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
