<?php
require_once __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;

$router = new Router();

$router->get('info', 'App\Controllers\Payeer@info');
$router->post('account', 'App\Controllers\Payeer@account');
$router->post('my_orders', 'App\Controllers\Payeer@myOrders');
$router->post('order_create', 'App\Controllers\Payeer@orderCreate');
$router->post('order_status', 'App\Controllers\Payeer@orderStatus');
$router->post('orders', 'App\Controllers\Payeer@orders');

$router->set404('App\Controllers\Payeer@notFound');

$router->run();

