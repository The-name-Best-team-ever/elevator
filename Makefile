SHELL := /bin/bash

##default
.DEFAULT_GOAL := go

# lower case fore more comfortable input in console
from=1
to=3

_composer_install:
	@echo 'Installing dependencies...'
	@docker exec -i $(shell docker-compose ps -q php) /usr/local/bin/php /usr/local/bin/composer install --optimize-autoloader

_up:
	@echo 'Building containers...'
	@docker-compose build 1>/dev/null
	@echo 'Upping containers...'
	@docker-compose up -d --force-recreate 1>/dev/null

_ps:
	@docker-compose ps

install: _up _composer_install _ps

go:
	@docker exec -i $(shell docker-compose ps -q php) php /var/www/index.php $(from) $(to)

test:
	@echo 'Creating testing database...'

up: _up _ps
