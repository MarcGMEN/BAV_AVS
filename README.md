 tail -f EasyPHP-Devserver-17/eds-binaries/httpserver/apache2425vc11x86x201109112305/logs/error.log


## Fonctionnement avec docker
### Sous le repertoire `DOcker` du projet 
 
- `docker-compose up` -d => lancement du docker
  - application sous `http://localhost:8090/`
  - phpmyadmin sous `http://localhost:8091/`
  - base neuve a chaque fois
- `docker-compose down` => arret des dockers
- En cas de modification du sql de la base `../dbmigration/init_db`
  - refaire l'image db `docker-compose build --no-cache db`

- Pour visualiser le log php
  ```bash
    $ docker exec -it php_app  bash
    $ tail -f /var/log/apache2/error.log
  ```


### Sous window lancer le docker desktop

