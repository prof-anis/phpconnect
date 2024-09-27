<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/rsync.php';
// Config

set('repository', 'git@github.com:prof-anis/phpconnect.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

set('rsync_src', function () {
    return __DIR__;
});

// Hosts

host('phpconnect.tobexkee.xyz')
    ->setHostname('65.109.232.116')
    ->setRemoteUser('root')
    ->setLabels(['stage' => 'production'])
    ->setDeployPath('/var/www/phpconnect');

task('deploy:secrets', function (): void {
    file_put_contents(__DIR__.'/.env', getenv('DOT_ENV'));
    upload('.env', get('deploy_path').'/shared');
});

task('deploy', [
    'deploy:setup',
    'deploy:info',
    'deploy:lock',
    'deploy:release',
    'rsync',
    'deploy:secrets',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'artisan:optimize',
    'artisan:migrate',
    'deploy:symlink',
    'deploy:unlock',
    'deploy:cleanup',
]);

// Hooks

after('deploy:failed', 'deploy:unlock');
