#!/bin/bash

set -e
# detiene la replicación 
echo "Deteniendo replicación en servidor esclavo..."
/opt/lampp/bin/mysqladmin --login-path=local stop-slave

# trae el último backup de la base
echo "Generando backup remoto..."
ssh -C test.udc.edu.ar "/opt/lampp/bin/mysqldump --login-path=backup  --master-data --add-drop-database --opt --compress --databases moodle | gzip -9 -c" > moodle.sql.gz

# restaura el backup
echo "Restaurando backup en base local. Por favor espere..."
gunzip -c moodle.sql.gz | /opt/lampp/bin/mysql --login-path=local

# reinicia la replicación
echo "Reanudando replicación..."
/opt/lampp/bin/mysqladmin --login-path=local start-slave

# elimino el backup
rm -f moodle.sql.gz

echo "PROCESO COMPLETO."
