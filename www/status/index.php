<?php
$INDEX = true;
$doc_root = "/opt/lampp/htdocs";

$componentes = array(
    'init'        => array('nombre'  => 'Inicialización', 
                           'estado'  => 'alert',
                           'icono'   => 'icon-warning-sign',
                           'mensaje' => 'No comprobado'),
    'rsync'       => array('nombre'  => 'Sinc. archivos',
                           'estado'  => 'alert',
                           'icono'   => 'icon-warning-sign',
                           'mensaje' => 'No comprobado'),
    'replication' => array('nombre'  => 'Replicación BD',
                           'estado'  => 'alert',
                           'icono'   => 'icon-warning-sign',
                           'mensaje' => 'No comprobado'),
    'git'         => array('nombre'  => 'Sinc. código',
                           'estado'  => 'alert',
                           'icono'   => 'icon-warning-sign',
                           'mensaje' => 'No comprobado')
);

try
{
  require_once 'componente_pdo.php';
} catch(Exception $e) {
  terminar('init', $e->getMessage());
}

try
{
  require_once 'componente_rsync.php';
} catch(Exception $e) {
  $componentes['rsync']['mensaje'] = $e->getMessage();
  $componentes['rsync']['estado']  = 'alert-error';
  $componentes['rsync']['icono']   = 'icon-fire';
}

try
{
  require_once 'componente_codigo.php';
} catch(Exception $e) {
  $componentes['git']['mensaje'] = $e->getMessage();
  $componentes['git']['estado']  = 'alert-error';
  $componentes['git']['icono']   = 'icon-fire';
}

try
{
  require_once 'componente_replication.php';
} catch(Exception $e) {
  terminar('replication', $e->getMessage());
}

require_once 'template.php';

function terminar($componente, $error)
{
  global $componentes;
  $componentes[$componente]['estado']  = 'alert-error';
  $componentes[$componente]['icono'] = 'icon-fire';
  $componentes[$componente]['mensaje'] = $error;

  require_once 'template.php';
  die();
}