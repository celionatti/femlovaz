<?php

/** @var TYPE_NAME $app */

use App\controllers\SiteController;
use App\controllers\AdminController;
use App\controllers\AdminCustomersController;
use App\controllers\AdminPaymentsController;
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

// Admin Customers
$app->router->get('/admin/customers', [AdminCustomersController::class, 'customers']);
$app->router->post('/admin/customers', [AdminCustomersController::class, 'show_customers']);
$app->router->post('/admin/customers/create', [AdminCustomersController::class, 'create_customer']);
$app->router->post('/admin/customers/edit', [AdminCustomersController::class, 'edit_customer']);
$app->router->post('/admin/customers/trash', [AdminCustomersController::class, 'trash']);
$app->router->post('/admin/customers/details', [AdminCustomersController::class, 'details']);

//Admin Payments
$app->router->get('/admin/payments', [AdminPaymentsController::class, 'payments']);
$app->router->get('/admin/payments/sales', [AdminPaymentsController::class, 'sales']);
$app->router->get('/admin/payments/subscriptions', [AdminPaymentsController::class, 'subscriptions']);

$app->router->get('/admin/stocks', [AdminController::class, 'stocks']);
$app->router->get('/admin/inquiries', [AdminController::class, 'inquiries']);
$app->router->get('/admin/help-center', [AdminController::class, 'help_center']);
$app->router->get('/admin/book-keeping', [AdminController::class, 'book_keeping']);