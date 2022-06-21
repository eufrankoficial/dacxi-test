#!/usr/bin/env bash

mysql --user=root --password="$MYSQL_ROOT_PASSWORD" <<-EOSQL
    CREATE DATABASE IF NOT EXISTS dacxi_database;
    GRANT ALL PRIVILEGES ON \`dacxi_database%\`.* TO '$MYSQL_USER'@'%';
EOSQL

./vendor/bin/sail artisan migrate

