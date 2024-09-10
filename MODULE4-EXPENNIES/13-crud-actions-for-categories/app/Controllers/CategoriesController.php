<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\CategoryServiceInterface;
use App\Contracts\RequestValidatorFactoryInterface;
use App\DTOs\CategoryData;
use App\Factories\ValidatorFactory;
use App\RequestValidators\CreateCategoryRequestValidator;
use App\Services\CategoryService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class CategoriesController
{

    public function __construct(private readonly Twig $twig, private readonly ValidatorFactory $requestValidatorFactory, private readonly CategoryService $category) {}

    public function index(Request $request, Response $response): Response
    {

        return $this->twig->render(
            $response,
            'categories/index.twig',
            [
                'categories' => $this->category->getAll()
            ]
        );
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();


        ['name' => $name] = $data;

        $categoryData = new CategoryData($name);

        $data = $this->requestValidatorFactory
            ->make(CreateCategoryRequestValidator::class)
            ->validate($categoryData);

        $user = $request->getAttribute('user');

        $this->category->create($categoryData, $user);

        return $response->withHeader('Location', '/categories')->withStatus(302);
    }


    public function delete(Request $request, Response $response): Response
    {
        // TODO

        return $response->withHeader('Location', '/categories')->withStatus(302);
    }
}
