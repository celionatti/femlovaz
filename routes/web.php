<?php

/** @var TYPE_NAME $app */

use App\controllers\SiteController;
use App\controllers\AdminController;
use App\controllers\AdminLoginController;
use App\controllers\AdminUsersController;
use App\controllers\AdminStocksController;
use App\controllers\AdminPaymentsController;
use App\controllers\AdminCustomersController;
use App\controllers\AdminAccountingController;

$app->router->get('/', [SiteController::class, 'index']);
$app->router->get('/users/{id}', [SiteController::class, 'users']);
// $app->router->get('/admin/{id}', 'controllers/admin.php');

// // Admin
$app->router->get('/admin', [AdminController::class, 'admin']);
$app->router->get('/admin/login', [AdminLoginController::class, 'login']);
<<<<<<< HEAD
$app->router->post('/admin/login', [AdminLoginController::class, 'login_access']);
=======
$app->router->post('/admin/login', [AdminLoginController::class, 'login']);
>>>>>>> b9569b51105f966f4255c90230858d70849cf2c9

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
$app->router->post('/admin/payments/sales', [AdminPaymentsController::class, 'show_sales']);
$app->router->post('/admin/payments/sales/create', [AdminPaymentsController::class, 'create_sale']);
$app->router->post('/admin/payments/sales/edit', [AdminPaymentsController::class, 'edit_sale']);
$app->router->post('/admin/payments/sales/trash', [AdminPaymentsController::class, 'trash_sale']);

$app->router->get('/admin/payments/subscriptions', [AdminPaymentsController::class, 'subscriptions']);
$app->router->post('/admin/payments/subscriptions', [AdminPaymentsController::class, 'show_subscriptions']);
$app->router->post('/admin/payments/subscriptions/create', [AdminPaymentsController::class, 'create_subscription']);
$app->router->post('/admin/payments/subscriptions/edit', [AdminPaymentsController::class, 'edit_subscription']);
$app->router->post('/admin/payments/subscriptions/trash', [AdminPaymentsController::class, 'trash_subscription']);

//Admin Stocks
$app->router->get('/admin/stocks', [AdminStocksController::class, 'stocks']);
$app->router->post('/admin/stocks', [AdminStocksController::class, 'show_stocks']);
$app->router->post('/admin/stocks/create', [AdminStocksController::class, 'create_stock']);
$app->router->post('/admin/stocks/edit', [AdminStocksController::class, 'edit_stock']);
$app->router->post('/admin/stocks/trash', [AdminStocksController::class, 'trash']);
$app->router->post('/admin/stocks/details', [AdminStocksController::class, 'details']);

$app->router->get('/admin/inquiries', [AdminController::class, 'inquiries']);
$app->router->get('/admin/help-center', [AdminController::class, 'help_center']);

$app->router->get('/admin/book-keeping', [AdminAccountingController::class, 'book_keeping']);
$app->router->post('/admin/book-keeping/all', [AdminAccountingController::class, 'show_all']);
$app->router->post('/admin/book-keeping/create', [AdminAccountingController::class, 'create_flow']);
$app->router->post('/admin/book-keeping/edit', [AdminAccountingController::class, 'edit_flow']);
$app->router->post('/admin/book-keeping/trash', [AdminAccountingController::class, 'trash_flow']);