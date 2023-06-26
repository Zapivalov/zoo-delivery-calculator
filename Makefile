COLOR_WARNING = \033[31m
RUN_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))

COMPOSE_PROJECT_DIR=./

# do nothing if make is called without target
placeholder:
	@:
.PHONY: placeholder

bash:
	docker-compose --project-directory=${COMPOSE_PROJECT_DIR} exec php-fpm bash
.PHONY: bash

magic:
	$(MAKE) check-requirements
	$(MAKE) .env
	$(MAKE) docker-up
	@docker-compose --project-directory=${COMPOSE_PROJECT_DIR} ps
	@echo ""
.PHONY: magic

docker-down:
	docker-compose --project-directory=${COMPOSE_PROJECT_DIR} down -v --remove-orphans

docker-up: docker-down
	docker-compose --project-directory=${COMPOSE_PROJECT_DIR} up -d

check-requirements:
	@command -v docker > /dev/null 2>&1 || { printf "\nCould not find docker.\nPlease install and try again. Exiting.\n" >&2; exit 1; }
	@command -v docker-compose > /dev/null 2>&1 || { printf "\nCould not find docker-compose.\nPlease install and try again. Exiting.\n" >&2; exit 1; }
.PHONY: check-requirements

.env:
	cp .env.dist .env
	echo "\nUSER_ID=1000" >> .env
	echo "GROUP_ID=1000" >> .env

.PHONY: .env
%:
	@:
