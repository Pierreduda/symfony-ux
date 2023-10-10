SHELL := /bin/bash

DOCKER = docker compose exec
BACKEND = php
FRONT = node
DB = database
DB_NAME = db_name

# CONFIG
install:
	$(DOCKER) $(BACKEND) composer install
update:
	$(DOCKER) $(BACKEND) composer update
%:
	$(DOCKER) $(BACKEND) php bin/console make:$@
migration:
	$(DOCKER) $(BACKEND) php bin/console make:migration
migrate:
	$(DOCKER) $(BACKEND) php bin/console doctrine:migrations:migrate
migrate-test:
	$(DOCKER) $(BACKEND) php bin/console doctrine:migrations:migrate -n --env=test
generate:
	$(DOCKER) $(BACKEND) php bin/console doctrine:migrations:generate
watch:
	$(DOCKER) $(FRONT) yarn encore dev --watch

build:
	$(DOCKER) $(FRONT) yarn encore dev
up:
	$(DOCKER) compose up -d
cc:
	$(DOCKER) $(BACKEND) php bin/console c:c
ddb:
	$(DOCKER) $(BACKEND) php bin/console doctrine:database:create
ddb-test:
	$(DOCKER) $(BACKEND) php bin/console doctrine:database:create --env=test
init:
	docker compose up -d
	make update
	docker compose run --rm --no-deps $(FRONT) bash -ci 'yarn install'
	make ddb
	make migrate
#	make add-user

# COMMANDS

cities:
	curl -L -o import/cities.csv https://www.data.gouv.fr/fr/datasets/r/51606633-fb13-4820-b795-9a2a575a72f1
	$(DOCKER) $(BACKEND) php bin/console app:import-cities
.PHONY:
	cities

# exemple: make node E="yarn encore dev --watch"
node:
	$(DOCKER) $(FRONT) $(E)

php:
	$(DOCKER) $(BACKEND) $(E)
