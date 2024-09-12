<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\CategoryServiceInterface;
use App\Contracts\RequestValidatorFactoryInterface;
use App\DTOs\CategoryData;
use App\Entity\Category;
use App\Factories\ValidatorFactory;
use App\RequestValidators\CreateCategoryRequestValidator;
use App\RequestValidators\UpdateCategoryRequestValidator;
use App\ResponseFormatter;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class CategoriesController
{

    public function __construct(private readonly Twig $twig, 
    private readonly ValidatorFactory $requestValidatorFactory,
    private readonly CategoryServiceInterface $categoryService,
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

        return $response;
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

    public function update(Request $request, Response $response, array $args): Response
    {
        $data = $this->requestValidatorFactory->make(UpdateCategoryRequestValidator::class)->validate(
            $args + $request->getParsedBody()
        );

        $category = $this->categoryService->getById((int) $data['id']);

        if (! $category) {
            return $response->withStatus(404);
        }

        $this->categoryService->update($category, $data['name']);

        return $response;
    }

    public function load(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();

        $categories = $this->categoryService->getPaginatedCategories((int) $params['start'], (int) $params['length']);

        $transformer = function(Category $category) {
            return [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'createdAt' => $category->getCreatedAt()->format('Y-m-d H:i:s'),
                'updatedAt' => $category->getUpdatedAt()->format('Y-m-d H:i:s'),
            ];
        };

        $categoryAmount = count($categories);

        return $this->responseFormatter->asJson($response, [
            'data' => array_map($transformer, (array) $categories->getIterator()),
            'draw' => (int) $params['draw'],
            'recordsTotal' => $categoryAmount,
            'recordsFiltered' => $categoryAmount,
        ]);
    }
}