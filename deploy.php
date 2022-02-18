<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'dev.liberadeuda.iw.sv');
// set spscify stage
set('default_stage', 'master');
// Project repository
set('repository', 'git@git.iw.sv:id/libera-tu-deuda/libera-tu-deuda-web-admin.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

host('develop')
  ->hostname('104.131.130.10')
  ->stage('develop')
  ->user('root')
  ->set('branch', 'develop')
  ->set('php_version', '7.3')
  ->set('deploy_path', '/home/www/public/{{application}}');

host('master')
  ->hostname('167.71.249.51')
  ->stage('master')
  ->user('root')
  ->set('branch', 'master')
  ->set('php_version', '7.4')
  ->set('deploy_path', '/home/www/public/www.liberadeuda.com');

// Tasks

task('deploy:composer-command', function () {
  set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader');
})->onStage('master');

task('build', function () {
  run('cd {{release_path}} && build');
});

desc('Restart server php fpm');
task('artisan:optimize', function () {});
task('restart-fpm', function () {
  run('sudo service php{{php_version}}-fpm restart');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
after('deploy', 'restart-fpm');

// Migrate database before symlink new release.

// before('deploy:symlink', 'artisan:migrate');
// before('deploy:symlink','artisan:db:seed');
