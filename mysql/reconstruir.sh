#!/usr/bin/bash

# detiene la replicación 
/opt/lampp/bin/mysqladmin -u root -p stop-slave

# trae el último backup de la base
ssh -C test.udc.edu.ar "/opt/lampp/bin/mysqldump -p  --master-data --add-drop-database --opt --compress --databases moodle | gzip -9 -c" > moodle.sql.gz

# restaura el backup
gunzip -c moodle.sql.gz | mysql -u root -p

# reinicia la replicación
/opt/lampp/bin/mysqladmin -u root -p start-slave

# elimino el backup
rm moodle.sql.gz
