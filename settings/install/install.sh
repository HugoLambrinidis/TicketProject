#!/usr/bin/env bash

if [ -z "$1" ] || [ -z "$2" ] || [ -z "$3" ];then
    echo $1
    echo $2
    echo $3
    echo usage : sh install.sh mysql_user mysql_password mysql_port
else
    composer install
    printf "export MYSQL_USER=$1\nexport MYSQL_PASSWORD=$2\nexport MYSQL_PORT=$3" > .env
    ./.env
    cat ./settings/db/projectTicket_db.sql |  mysql -u $1 -p$2
    if [ $? -eq 0 ]
    then
        echo database installed
    fi
    for db in `ls ./settings/db/*.sql | sort -g`
    do
       if [ $db != ./settings/db/projectTicket_db.sql ]
       then
             mysql -u $1 -p$2 projectTicket < $db
            if [ $? -eq 0 ]
             then
              echo $db > .last_update
            else
              exit 1
            fi
        fi
    done
fi