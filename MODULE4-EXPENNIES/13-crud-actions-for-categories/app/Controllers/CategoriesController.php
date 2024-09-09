<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\CategoryServiceInterface;
use App\Contracts\RequestValidatorFactoryInterface;
use App\DTOs\CategoryData;
use App\Models\Category;
use App\RequestValidators\CreateCategoryRequestValidator;
use App\Services\CategoryService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class CategoriesController
{

    public function __construct(private readonly Twig $twig, private readonly RequestValidatorFactoryInterface $requestValidatorFactory, private readonly CategoryServiceInterface $category) {}

    public function index(Request $request, Response $response): Response
    {

        return $this->twig->render($response, 'categories/index.twig');
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();


        ['name' => $name] = $data;

        $categoryData = new CategoryData($name);

        $data = $this->requestValidatorFactory
            ->make(CreateCategoryRequestValidator::class)
            ->validate($categoryData);

        $this->category->create($categoryData);

        return $response->withHeader('Location', '/categories')->withStatus(302);
    }


    public function delete(Request $request, Response $response): Response
    {
        // TODO

        return $response->withHeader('Location', '/categories')->withStatus(302);
    }
}
