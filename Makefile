# Default shell
SHELL := /bin/bash

# Variables
MAKE_PHP_8_3_EXE ?= php8.3
MAKE_COMPOSER_2_FILE ?= /usr/local/bin/composer

MAKE_PHP ?= ${MAKE_PHP_8_3_EXE}
MAKE_COMPOSER ?= ${MAKE_PHP} ${MAKE_COMPOSER_2_FILE}

# Default goal
.DEFAULT_GOAL := never

# Goals
.PHONY: audit
audit: audit_composer audit_npm

.PHONY: audit_composer
audit_composer: ./vendor ./composer.lock
	${MAKE_COMPOSER} audit
	${MAKE_COMPOSER} check-platform-reqs
	${MAKE_COMPOSER} validate --strict --no-check-all

.PHONY: audit_npm
audit_npm: ./package-lock.json
	npm audit --audit-level info --include prod --include dev --include peer --include optional

.PHONY: check
check: lint stan test audit

.PHONY: clean
clean:
	rm -rf ./node_modules ./package-lock.json ./vendor ./composer.lock ./.phpunit.result.cache ./.php-cs-fixer.cache ./.phpunit.cache ./.phpunit.coverage

.PHONY: coverage
coverage: test
	php -S 0.0.0.0:8000 -t ./.phpunit.coverage/html

.PHONY: development
development: install

.PHONY: distclean
distclean: clean
	git clean -xfd

.PHONY: fix
fix: fix_eslint fix_prettier fix_php_cs_fixer

.PHONY: fix_eslint
fix_eslint: ./node_modules/.bin/eslint
	./node_modules/.bin/eslint --fix .

.PHONY: fix_php_cs_fixer
fix_php_cs_fixer: ./vendor/bin/php-cs-fixer
	${MAKE_PHP} ./vendor/bin/php-cs-fixer fix

.PHONY: fix_prettier
fix_prettier: ./node_modules/.bin/prettier
	./node_modules/.bin/prettier -w .

.PHONY: install
install: install_composer install_npm

.PHONY: install_composer
install_composer:
	${MAKE_COMPOSER} install

.PHONY: install_npm
install_npm:
	npm install --install-links --include prod --include dev --include peer --include optional

.PHONY: lint
lint: lint_eslint lint_prettier lint_php_cs_fixer

.PHONY: lint_eslint
lint_eslint: ./node_modules/.bin/eslint
	./node_modules/.bin/eslint .

.PHONY: lint_php_cs_fixer
lint_php_cs_fixer: ./vendor/bin/php-cs-fixer
	${MAKE_PHP} ./vendor/bin/php-cs-fixer fix --dry-run --diff

.PHONY: lint_prettier
lint_prettier: ./node_modules/.bin/prettier
	./node_modules/.bin/prettier -c .

.PHONY: local
local: install

.PHONY: production
production: instal

.PHONY: staging
staging: install

.PHONY: stan
stan: stan_phpstan

.PHONY: stan_phpstan
stan_phpstan: ./vendor/bin/phpstan
	${MAKE_PHP} ./vendor/bin/phpstan analyse

.PHONY: test
test: test_phpunit

.PHONY: test_phpunit
test_phpunit: ./vendor/bin/phpunit
	${MAKE_PHP} ./vendor/bin/phpunit

.PHONY: testing
testing: install

.PHONY: update
update: update_composer update_npm

.PHONY: update_composer
update_composer:
	${MAKE_COMPOSER} update

.PHONY: update_npm
update_npm:
	npm update --install-links --include prod --include dev --include peer --include optional

# Dependencies
./composer.lock ./vendor ./vendor/bin/php-cs-fixer ./vendor/bin/phpstan ./vendor/bin/phpunit:
	${MAKE_COMPOSER} install

./node_modules ./node_modules/.bin/eslint ./node_modules/.bin/prettier ./package-lock.json:
	npm install --install-links --include prod --include dev --include peer --include optional
