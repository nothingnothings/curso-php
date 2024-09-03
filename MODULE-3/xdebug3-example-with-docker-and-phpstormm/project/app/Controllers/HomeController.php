<?php declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Attributes\Put;
use App\Attributes\Route;
use App\Enums\HttpMethod;
use App\View;

class HomeController
{
    #[Get('/')]
    #[Route('/home', HttpMethod::Head)]
    public function index(): View
    {
        xdebug_info();

        $example_data = 'dasd';

        var_dump($example_data);

        // return throw new \Exception('This is a test');
        return View::make('index');
    }

    #[Post('/')]
    public function store() {}

    #[Put('/')]
    public function update() {}
}
