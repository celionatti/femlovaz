<?php

/** @var TYPE_NAME $app */

use App\controllers\SiteController;
use App\controllers\AdminController;


$app->router->get('/', [SiteController::class, 'index']);
$app->router->get('/users/{id}', [SiteController::class, 'users']);
// $app->router->get('/admin/{id}', 'controllers/admin.php');

// // Admin
$app->router->get('/admin', [AdminController::class, 'admin']);
$app->router->get('/admin/users', [AdminController::class, 'users']);
$app->router->get('/admin/stocks', [AdminController::class, 'stocks']);
$app->router->get('/admin/inquiries', [AdminController::class, 'inquiries']);
$app->router->get('/admin/help-center', [AdminController::class, 'help_center']);
$app->router->get('/admin/book-keeping', [AdminController::class, 'book_keeping']);