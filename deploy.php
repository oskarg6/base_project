<?php
namespace Deployer;
require_once 'usergit.php';
require 'recipe/symfony3.php';

// Configuration

set('ssh_type', 'native');
set('ssh_multiplexing', true);
set('keep_releases', 5);

set('repository', '');

add('shared_files', ['web/.htaccess']);
add('shared_dirs', []);

add('writable_dirs', []);

// Servers
serverList('servers.yml');


// Tasks

desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    // The user must have rights for restart service
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
    run('sudo systemctl restart php-fpm.service');
});
after('deploy:symlink', 'php-fpm:restart');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'database:migrate');
