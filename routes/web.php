<?php

/** @var TYPE_NAME $app */

use App\controllers\SiteController;
use App\controllers\AdminController;
use App\controllers\AdminUsersController;

$app->router->get('/', [SiteController::class, 'index']);
$app->router->get('/users/{id}', [SiteController::class, 'users']);
// $app->router->get('/admin/{id}', 'controllers/admin.php');

// // Admin
$app->router->get('/admin', [AdminController::class, 'admin']);
$app->router->get('/admin/users', [AdminUsersController::class, 'users']);
$app->router->post('/admin/users', [AdminUsersController::class, 'show_users']);
$app->router->post('/admin/users/create', [AdminUsersController::class, 'create_user']);
$app->router->post('/admin/users/edit', [AdminUsersController::class, 'edit_user']);
$app->router->post('/admin/users/trash', [AdminUsersController::class, 'trash']);
$app->router->post('/admin/users/details', [AdminUsersController::class, 'details']);

$app->router->get('/admin/stocks', [AdminController::class, 'stocks']);
$app->router->get('/admin/inquiries', [AdminController::class, 'inquiries']);
$app->router->get('/admin/help-center', [AdminController::class, 'help_center']);
$app->router->get('/admin/book-keeping', [AdminController::class, 'book_keeping']);