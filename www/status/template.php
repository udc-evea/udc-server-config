<?php require("index_pass.php");?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="es"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="es"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="es"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>UDC:: Estado del servidor Aula Virtual</title>

    <!-- more metas -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    
    <link rel="stylesheet" type="text/css" media="screen" href="assets/bootstrap/css/bootstrap.min.css" />
    <script src="assets/jquery-1.10.2.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
  <!--[if lt IE 8]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
    <!-- sample navbar -->
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          <h2>Estado del servidor</h2>
          <?php foreach($componentes as $item):?>
          <div class="row-fluid">
            <div class="span4">
              <h4><?php echo $item['nombre'];?></h4>
            </div>
            <div class="span6">
              <div class="alert <?php echo $item['estado'];?>">
                <i class="icon <?php echo $item['icono'];?>"></i> 
                <?php echo $item['mensaje'];?>
              </div>
            </div>
          </div>
          <?php endforeach;?>
        </div>
      </div>
      <div class="row-fluid">
        <div class="span12">
          <?php if(isset($componentes['replication']['detalles']) && !empty($componentes['replication']['detalles'])):?>
          <a href="#detalles-replication" class="btn" data-toggle="modal"><i class="icon icon-list-alt"></i> Detalles replicación BD</a>
          <div id="detalles-replication" class="modal hide">
            <div class="modal-header"><h3>Replicación BD</h3></div>
            <div class="modal-body">
              <table class="table- table-bordered table-condensed table-striped">
              <?php foreach($componentes['replication']['detalles'] as $key => $value):?>
                <tr>
                  <th><?php echo $key;?></th>
                  <td><?php echo $value;?></td>
                </tr>
              <?php endforeach;?>
              </table>
            </div>
            <div class="modal-footer">
              <a class="btn" href="#" data-dismiss="modal">Cerrar</a>
            </div>
          </div>
          <?php endif;?>
          <?php if(isset($componentes['rsync']['detalles']) && !empty($componentes['rsync']['detalles'])):?>
          <a href="#detalles-rsync" class="btn" data-toggle="modal"><i class="icon icon-list-alt"></i> Detalles sinc. archivos</a>
          <div id="detalles-rsync" class="modal hide">
            <div class="modal-header"><h3>Sinc. archivos</h3></div>
            <div class="modal-body">
              <?php echo $componentes['rsync']['detalles'];?>
            </div>
            <div class="modal-footer">
              <a class="btn" href="#" data-dismiss="modal">Cerrar</a>
            </div>
          </div>
          <?php endif;?>
          <?php if(isset($componentes['git']['detalles']) && !empty($componentes['git']['detalles'])):?>
          <a href="#detalles-git" class="btn" data-toggle="modal"><i class="icon icon-list-alt"></i> Detalles sinc. código</a>
          <div id="detalles-git" class="modal hide">
            <div class="modal-header"><h3>Sinc. código</h3></div>
            <div class="modal-body">
              <?php echo $componentes['git']['detalles'];?>
            </div>
            <div class="modal-footer">
              <a class="btn" href="#" data-dismiss="modal">Cerrar</a>
            </div>
          </div>
          <?php endif;?>
        </div>
      </div>
    </div> <!-- /container -->
  </body>
</html>
