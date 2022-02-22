<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

use Mia\Auth\Model\MIAUser;
use Mia\Auth\Handler\RegisterHandler;
use Mia\Auth\Handler\Social\GoogleSignInHandler;

/**
 * FastRoute route configuration
 *
 * @see https://github.com/nikic/FastRoute
 *
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/{id:\d+}', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('    /contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Mezzio\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */
return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/', App\Handler\HomePageHandler::class, 'home');
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');

    /** AUTHENTICATION **/
    $app->route('/mia-auth/login', [Mia\Auth\Handler\LoginHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia_auth.login');
    $app->route('/mia-auth/register', [\Mia\Mail\Handler\SendgridHandler::class, new RegisterHandler(false)], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia_auth.register');
    $app->route('/mia-auth/update-profile', [\Mia\Auth\Handler\AuthHandler::class, Mia\Auth\Handler\UpdateProfileHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia_auth.update-profile');
    $app->route('/mia-auth/recovery', [\Mia\Mail\Handler\SendgridHandler::class, Mia\Auth\Handler\MiaRecoveryHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia_auth.recovery');
    $app->route('/mia-auth/change-password-recovery', [Mia\Auth\Handler\MiaPasswordRecoveryHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia_auth.change-password-recovery');
    $app->route('/mia-auth/me', [\Mia\Auth\Handler\AuthHandler::class, Mia\Auth\Handler\FetchProfileHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia_auth.me');

    /** ROLES AND PERMISSIONS  */
    $app->route('/mia-auth/role/list', [Mia\Auth\Handler\Role\ListHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia_auth.role-list');
    $app->route('/mia-auth/role/all', [Mia\Auth\Handler\Role\AllHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia_auth.role-all');
    $app->route('/mia-auth/role/access', [\Mia\Auth\Handler\AuthHandler::class, Mia\Auth\Handler\Role\AccessHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia_auth.role-access');

    /** USERS */
    $app->route('/user/list', [\Mia\Auth\Handler\AuthHandler::class, new \Mia\Auth\Middleware\MiaRoleAuthMiddleware([MIAUser::ROLE_ADMIN]), \Mia\Auth\Handler\User\ListHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'user.list');
    $app->route('/user/block', [\Mia\Auth\Handler\AuthHandler::class, new \Mia\Auth\Middleware\MiaRoleAuthMiddleware([MIAUser::ROLE_ADMIN]), \Mia\Auth\Handler\User\BlockHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'user.block');
    $app->route('/user/save', [\Mia\Auth\Handler\AuthHandler::class, new \Mia\Auth\Middleware\MiaRoleAuthMiddleware([MIAUser::ROLE_ADMIN]), \Mia\Auth\Handler\User\SaveHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'user.save');

    /** PROJECTS */
    $app->route('/project/fetch/{id}', [\Mia\Auth\Handler\AuthHandler::class, App\Handler\Project\FetchHandler::class], ['GET', 'OPTIONS', 'HEAD'], 'project.fetch');
    $app->route('/project/list', [\Mia\Auth\Handler\AuthHandler::class, App\Handler\Project\ListHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'project.list');
    $app->route('/project/remove/{id}', [\Mia\Auth\Handler\AuthHandler::class, App\Handler\Project\RemoveHandler::class], ['GET', 'DELETE', 'OPTIONS', 'HEAD'], 'project.remove');
    $app->route('/project/save', [\Mia\Auth\Handler\AuthHandler::class, App\Handler\Project\SaveHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'project.save');
    
    /** CLIENTS */
    $app->route('/client/list', [\Mia\Auth\Handler\AuthHandler::class, App\Handler\Client\ListHandler::class], ['GET','POST', 'OPTIONS', 'HEAD'], 'client.list');
    $app->route('/client/fetch/{id}', [\Mia\Auth\Handler\AuthHandler::class, App\Handler\Client\FetchHandler::class], ['GET', 'OPTIONS', 'HEAD'], 'client.fetch');
    $app->route('/client/remove/{id}', [\Mia\Auth\Handler\AuthHandler::class, App\Handler\Client\RemoveHandler::class], ['GET', 'DELETE', 'OPTIONS', 'HEAD'], 'client.remove');
    $app->route('/client/save', [\Mia\Auth\Handler\AuthHandler::class, App\Handler\Client\SaveHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'client.save');
    $app->route('/client/assign-project', [\Mia\Auth\Handler\AuthHandler::class, App\Handler\Project\AssignHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'client.assign');
    $app->route('/client/dashboard', [\Mia\Auth\Handler\AuthHandler::class, App\Handler\Client\DashboardHandler::class], ['GET','POST', 'OPTIONS', 'HEAD'], 'client.dashboard');
};
