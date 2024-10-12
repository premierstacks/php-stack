# Default shell
SHELL := /bin/bash

# Default goal
.DEFAULT_GOAL := never

# Variables
SOURCES = $(shell rg --files --hidden --iglob '!.git')
PHP_SOURCES = $(shell rg --files --hidden --iglob '!.git' --iglob '*.php')

MAKE_PHP_8_3_EXE ?= php8.3
MAKE_COMPOSER_2_EXE ?= /usr/local/bin/composer

MAKE_PHP ?= ${MAKE_PHP_8_3_EXE}
MAKE_COMPOSER ?= ${MAKE_PHP} ${MAKE_COMPOSER_2_EXE}

# Goals
.PHONY: audit
audit: audit_npm audit_composer

.PHONY: audit_composer
audit_composer: ./vendor/audit_stamp

./vendor/audit_stamp: ./vendor ./composer.lock
	${MAKE_COMPOSER} audit
	${MAKE_COMPOSER} check-platform-reqs
	${MAKE_COMPOSER} validate --strict --no-check-all
	touch ./vendor/audit_stamp

.PHONY: audit_npm
audit_npm: ./node_modules/audit_stamp

./node_modules/audit_stamp: ./node_modules ./package-lock.json
	npm audit --audit-level info --include prod --include dev --include peer --include optional
	touch ./node_modules/audit_stamp

.PHONY: check
check: lint stan test audit

.PHONY: clean
clean:
	rm -rf ./vendor
	rm -rf ./node_modules
	git clean -Xfd

.PHONY: commit
commit: tree fix fix fix check

.PHONY: coverage
coverage: ./.phpunit.coverage/html
	php -S 0.0.0.0:8000 -t ./.phpunit.coverage/html

.PHONY: development
development:

.PHONY: distclean
distclean: clean
	git clean -xfd

.PHONY: fix
fix: fix_eslint fix_prettier fix_php_cs_fixer

.PHONY: fix_eslint
fix_eslint: ./node_modules/eslint_fix_stamp

./node_modules/eslint_fix_stamp: ./node_modules/.bin/eslint ./eslint.config.js ${SOURCES}
	./node_modules/.bin/eslint --fix .
	touch ./node_modules/eslint_fix_stamp
	touch ./node_modules/eslint_lint_stamp

.PHONY: fix_php_cs_fixer
fix_php_cs_fixer: ./vendor/php_cs_fixer_fix_stamp

./vendor/php_cs_fixer_fix_stamp: ./vendor/bin/php-cs-fixer ./.php-cs-fixer.php ${PHP_SOURCES}
	${MAKE_PHP} ./vendor/bin/php-cs-fixer fix
	touch ./vendor/php_cs_fixer_fix_stamp
	touch ./vendor/php_cs_fixer_lint_stamp

.PHONY: fix_prettier
fix_prettier: ./node_modules/prettier_fix_stamp

./node_modules/prettier_fix_stamp: ./node_modules/.bin/prettier ./prettier.config.js ${SOURCES}
	./node_modules/.bin/prettier -w .
	touch ./node_modules/prettier_fix_stamp
	touch ./node_modules/prettier_lint_stamp

.PHONY: lint
lint: lint_eslint lint_prettier lint_php_cs_fixer

.PHONY: lint_eslint
lint_eslint: ./node_modules/eslint_lint_stamp

./node_modules/eslint_lint_stamp: ./node_modules/.bin/eslint ./eslint.config.js ${SOURCES}
	./node_modules/.bin/eslint .
	touch ./node_modules/eslint_lint_stamp
	touch ./node_modules/eslint_fix_stamp

.PHONY: lint_php_cs_fixer
lint_php_cs_fixer: ./vendor/php_cs_fixer_lint_stamp

./vendor/php_cs_fixer_lint_stamp: ./vendor/bin/php-cs-fixer ./.php-cs-fixer.php ${PHP_SOURCES}
	${MAKE_PHP} ./vendor/bin/php-cs-fixer fix --dry-run --diff
	touch ./vendor/php_cs_fixer_lint_stamp
	touch ./vendor/php_cs_fixer_fix_stamp

.PHONY: lint_prettier
lint_prettier: ./node_modules/prettier_lint_stamp

./node_modules/prettier_lint_stamp: ./node_modules/.bin/prettier ./prettier.config.js ${SOURCES}
	./node_modules/.bin/prettier -c .
	touch ./node_modules/prettier_lint_stamp
	touch ./node_modules/prettier_fix_stamp

.PHONY: local
local:

.PHONY: production
production:

.PHONY: staging
staging:

.PHONY: stan
stan: stan_phpstan

.PHONY: stan_phpstan
stan_phpstan: ./vendor/phpstan_stamp

./vendor/phpstan_stamp: ./vendor/bin/phpstan ./phpstan.neon ${PHP_SOURCES}
	${MAKE_PHP} ./vendor/bin/phpstan analyse
	touch ./vendor/phpstan_stamp

.PHONY: test
test: test_phpunit

.PHONY: test_phpunit
test_phpunit: ./.phpunit.coverage/html

./.phpunit.coverage/html: ./vendor/bin/phpunit ./phpunit.xml ${PHP_SOURCES}
	${MAKE_PHP} ./vendor/bin/phpunit

.PHONY: testing
testing:

.PHONY: tree
tree: ./README.md
	sed -i '/## Tree/,$$d' README.md
	echo '## Tree' >> README.md
	echo '' >> README.md
	echo 'The following is a breakdown of the folder and file structure within this repository. It provides an overview of how the code is organized and where to find key components.' >> README.md
	echo '' >> README.md
	echo '```bash' >> README.md
	rg --files --hidden --iglob '!.git' | tree --fromfile >> README.md
	echo '```' >> README.md

.PHONY: update
update: update_npm update_composer

.PHONY: update_composer
update_composer: ./composer.json
	rm -rf ./vendor
	${MAKE_COMPOSER} update

.PHONY: update_npm
update_npm: ./package.json
	rm -rf ./node_modules
	npm update --install-links --include prod --include dev --include peer --include optional

# Dependencies
./package-lock.json ./node_modules ./node_modules/.bin/eslint ./node_modules/.bin/prettier: ./package.json
	rm -rf ./node_modules
	npm install --install-links --include prod --include dev --include peer --include optional

./composer.lock ./vendor ./vendor/bin/php-cs-fixer ./vendor/bin/phpstan ./vendor/bin/phpunit: ./composer.json
	rm -rf ./vendor
	${MAKE_COMPOSER} install
