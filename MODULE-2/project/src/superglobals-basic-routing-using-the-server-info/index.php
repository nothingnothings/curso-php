<?php 

declare(strict_types= 1);

namespace App18;


require_once '../../src/vendor/autoload.php'; // imports the composer's autoloader


// All of the following code must be put inside of the 'index.php' file, of the public folder of your php app.
echo '<pre>';
print_r($_SERVER);
echo '</pre>';



$router = new Router();

// Registering the routes:
// $router->register('/', function () {
//     echo '<h1>Home</h1>';
// });


$router->register('/', [\App18\Classes\Home::class, 'index'])
        ->register('/invoices', [\App18\Classes\Invoices::class, 'index'])
        ->register('/invoices/create', [\App18\Classes\Invoices::class, 'create']);





$router->register('/invoices', function () {
    echo '<h1>Invoices</h1>';
});


echo $router->resolve($_SERVER['REQUEST_URI']);
