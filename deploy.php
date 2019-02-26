<?php
namespace Deployer;
require_once 'usergit.php';
require 'recipe/symfony3.php';

// Configuration

set('ssh_type', 'native');
set('ssh_multiplexing', true);
set('keep_releases', 5);

set('repository', 'git@github.com:oskarg6/base_project.git');

add('shared_files', ['web/.htaccess']);
add('shared_dirs', ['web/uploads']);

add('writable_dirs', ['web/uploads']);
set('writable_mode', 'chmod');
set('writable_chmod_mode', '775');

// Serversaa
serverList('servers.yml');


// Tasks

//desc('Restart PHP-FPM service');
//task('php-fpm:restart', function () {
//    // The user must have rights for restart service
//    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
//    run('sudo systemctl restart php-fpm.service');
//});
//after('deploy:symlink', 'php-fpm:restart');

/**
 * install FOS ckeditor
 */
task('fosckeditor:install', function () {
	run('{{env_vars}} {{bin/php}} {{bin/console}} ckeditor:install');
	run('{{env_vars}} {{bin/php}} {{bin/console}} assets:install web');
})->desc('Migrate database');

after('deploy:assets:install', 'fosckeditor:install');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'database:migrate');
