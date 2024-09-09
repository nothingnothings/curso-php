<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Category;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class CategoriesController
{

    public function __construct(private readonly Twig $twig) {}

    public function index(Request $request, Response $response): Response
    {

        return $this->twig->render($response, 'categories/index.twig');
    }

    public function store(Request $request, Response $response): Response
    {
        // TODO

        return $response->withHeader('Location', '/categories')->withStatus(302);
    }

    public function delete(Request $request, Response $response): Response
    {
        // TODO

        return $response->withHeader('Location', '/categories')->withStatus(302);
    }
}
