##Forcer l'arret d'un docker##
```bash
marc@hautacam:~$ docker ps -a
CONTAINER ID   IMAGE            COMMAND                  CREATED      STATUS      PORTS                                     NAMES
725ee2ac466d   docker-php_bav   "docker-php-entrypoi…"   2 days ago   Up 2 days   0.0.0.0:8090->80/tcp, [::]:8090->80/tcp   php_app_bav

marc@hautacam:~$ docker rm php_app_bav --force
Error response from daemon: cannot remove container "php_app_bav": could not kill container: permission denied

marc@hautacam:~$ docker inspect --format '{{ .State.Pid }}' php_app_bav
83687
marc@hautacam:~$ sudo kill -9 83687

marc@hautacam:~$ docker ps -a
CONTAINER ID   IMAGE            COMMAND                  CREATED      STATUS                       PORTS     NAMES
725ee2ac466d   docker-php_bav   "docker-php-entrypoi…"   2 days ago   Exited (137) 4 seconds ago             php_app_bav

marc@hautacam:~$ docker rm  php_app_bav 
php_app_bav
```