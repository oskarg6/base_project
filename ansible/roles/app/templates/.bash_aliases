alias console="php /vagrant/bin/console"
alias phpunit="php /home/{{ ansible_user }}/vendor/bin/phpunit -c /vagrant/app"
alias phpunit-coverage="php -dzend_extension=xdebug.so /home/{{ ansible_user }}/vendor/bin/phpunit --coverage-html /vagrant/coverage -c /vagrant/app"
alias php-cs-fixer="/home/{{ ansible_user }}/vendor/bin/php-cs-fixer fix"
