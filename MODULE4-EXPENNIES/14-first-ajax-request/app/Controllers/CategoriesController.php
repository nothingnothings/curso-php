<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\CategoryServiceInterface;
use App\Contracts\RequestValidatorFactoryInterface;
use App\DTOs\CategoryData;
use App\Factories\ValidatorFactory;
use App\RequestValidators\CreateCategoryRequestValidator;
use App\ResponseFormatter;
use App\Services\CategoryService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class CategoriesController
{

    public function __construct(private readonly Twig $twig, 
    private readonly ValidatorFactory $requestValidatorFactory,
    private readonly CategoryService $categoryService,
    private readonly ResponseFormatter $responseFormatter
    ) {}

    public function index(Request $request, Response $response): Response
    {

        return $this->twig->render(
            $response,
            'categories/index.twig',
            [
                'categories' => $this->categoryService->getAll()
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

        $this->categoryService->create($categoryData, $user);

        return $response->withHeader('Location', '/categories')->withStatus(302);
    }


    public function delete(Request $request, Response $response, array $args): Response
    {  
         $categoryId = $request->getAttribute('categoryId');

        $this->categoryService->delete($categoryId);

        return $response->withHeader('Location', '/categories')->withStatus(302);
    }

    public function get(Request $request, Response $response, array $args): Response
    {
        $categoryId = (int) $args['id']; // inputs from the frontend are always strings, so it needs to be cast as int.

        $category = $this->categoryService->getById($categoryId);

        if (!$category) {
            return $response->withStatus(404);
        }
        
        $data = ['id' => $category->getId(), 'name' => $category->getName()];

        return $this->responseFormatter->asJson($response, $data);

    }
}