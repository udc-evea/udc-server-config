<?php
  //si se usa xampp
  $doc_root = "/opt/lampp/htdocs";
  $php_bin  = "/opt/lampp/bin/php";
  
  //si se instalo LAMPP via apt-get
  $doc_root = "//var/www";
  $php_bin  = "/usr/bin/php";
  
  //datos de red
  $hash = "1e06432b70105cc3e2c8a8bf0ad5e763"; //prueba
  $url = "http://social.udc.edu.ar/udc_apps/backend.php/servers/$hash/report";
  //$proxy = 'tcp://10.0.0.1:3128';

  //no es necesario cambiar esto
  $rsync_status_file = "$doc_root/status/datasync.status";
  $mysql_replication_status_file = "$doc_root/status/mysql_replication.status";
  $gitsync_status_file = "/$doc_root/status/gitsync.status";
