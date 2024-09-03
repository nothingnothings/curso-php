<?php declare(strict_types=1);

namespace App\Controllers;

use Slim\Psr7\Request as Psr7Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

// ! Without slim framework + twig (only twig + a custom router implementation)
// class HomeController
// {
//     public function __construct(private Twig $twig) {}

//     #[Get('/')]
//     #[Route('/home', HttpMethod::Head)]
//     public function index()
//     {
//         return $this->twig->render('index.twig');
//     }

//     #[Post('/')]
//     public function store() {}

//     #[Put('/')]
//     public function update() {}
// }

// * With slim framework + twig component (slim's twig component)
class HomeController
{
    public function index(Psr7Request $request, Response $response): Response
    {
        return Twig::fromRequest($request)->render($response, 'index.twig');
    }

    public function store() {}

    public function update() {}
}
