SHELL := /bin/bash # Use bash syntax


up:
    ./vendor/bin/sail up

artisan-migrate:
    ./docker/scripts/artisan-migrate.sh

default: up
