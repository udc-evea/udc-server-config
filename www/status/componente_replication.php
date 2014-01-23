<?php
global $componentes, $doc_root;
require("index_pass.php");

try
{
  $replication_status_file = "$doc_root/status/mysql_replication.status";
  //hacer la query
  $statement = $pdo->query("SHOW SLAVE STATUS");
  $rep = $statement->fetch(PDO::FETCH_ASSOC);

  if(!$rep)
  {
    throw new Exception("Replicación no está configurada");
  }

  if($rep['Slave_IO_Running'] != "Yes")
    throw new Exception("Hilo I/O detenido: ". $rep['Slave_IO_State'].' - '. $rep['Last_IO_Error']);

  if($rep['Slave_SQL_Running'] != "Yes")
    throw new Exception("Hilo SQL detenido: ".$rep['Last_SQL_Error']);

  if($rep['Seconds_Behind_Master'] == "0")
  {
    $componentes['replication']['estado']  = 'alert-success';
    $componentes['replication']['icono']   = 'icon-thumbs-up';
    $componentes['replication']['mensaje'] = "Replicación actualizada";
  }
  else
  {
    //sigo en amarillo
    $componentes['replication']['mensaje'] = $rep['Slave_IO_State'];
  }

  $componentes['replication']['detalles'] = $rep;
  
  dump_status_report(array_to_table($rep));
}
catch(Exception $e)
{
  $componentes['replication']['detalles'] = $rep;
  dump_status_report(array_to_table($rep));
  
  throw $e;
}

function array_to_table($array)
{
  $data = '';
  foreach($array as $key => $value)
  {
    $data .= "$key: $value\n";
  }
  
  return $data;
}

function dump_status_report($data)
{
  global $doc_root;
  $replication_status_file = "$doc_root/status/mysql_replication.status";
  file_put_contents($replication_status_file, $data);
}