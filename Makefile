test:
	bin/phpspec run -fpretty -vvv -fpretty
	bin/php-cs-fixer --diff --dry-run -v fix

fix:
	bin/php-cs-fixer --diff -v fix
