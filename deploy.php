<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/rsync.php';
require 'contrib/slack.php';
require 'contrib/crontab.php';
// Config

set('repository', 'git@github.com:prof-anis/phpconnect.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

set('rsync_src', function () {
    return __DIR__;
});

/**
 * Setup slack
 */
set('slack_webhook', getenv('SLACK_WEBHOOK'));

// Hosts

host('phpconnect.tobexkee.xyz')
    ->setHostname('65.109.232.116')
    ->setRemoteUser('root')
    ->setLabels(['stage' => 'production'])
    ->setDeployPath('/var/www/phpconnect2');

task('deploy:secrets', function (): void {
    file_put_contents(__DIR__.'/.env', getenv('DOT_ENV'));
    upload('.env', get('deploy_path').'/shared');
});

before('deploy', 'slack:notify');

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
    'crontab:sync',
    'deploy:unlock',
    'deploy:cleanup',
]);

add('crontab:jobs', [
    '* * * * * cd {{current_path}} && {{bin/php}} artisan schedule:run >> /dev/null 2>&1',
]);

// Hooks
after('deploy:success', 'slack:notify:success');
after('deploy:failed', 'slack:notify:failure');
after('deploy:failed', 'deploy:unlock');
