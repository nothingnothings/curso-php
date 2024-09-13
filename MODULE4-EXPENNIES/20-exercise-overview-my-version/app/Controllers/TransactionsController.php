<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DTOs\TransactionData;
use App\Entity\Transaction;
use App\Factories\ValidatorFactory;
use App\RequestValidators\CreateTransactionRequestValidator;
use App\RequestValidators\UpdateCategoryRequestValidator;
use App\RequestValidators\UpdateTransactionRequestValidator;
use App\ResponseFormatter;
use App\Services\TransactionService;
use App\Services\RequestService;
use DateTime;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class TransactionsController
{

    public function __construct(
        private readonly Twig $twig,
        private readonly ValidatorFactory $requestValidatorFactory,
        private readonly TransactionService $transactionService,
        private readonly RequestService $requestService,
        private readonly ResponseFormatter $responseFormatter
    ) {}

    public function index(Request $request, Response $response): Response
    {
        return $this->twig->render($response, 'transactions/index.twig');
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();


        ['description' => $description] = $data;
        ['category' =>  $category] = $data;
        ['amount' => $amount] = $data;
        ['date' => $date] = $data; // TODO: This is not working.
        
        // Format the date to the format that the database expects:
        $date = DateTime::createFromFormat('Y-m-d', $date);

        $transactionData = new TransactionData($description, (int) $category, (float) $amount, $date);

        $data = $this->requestValidatorFactory
            ->make(CreateTransactionRequestValidator::class)
            ->validate([
                'description' => $transactionData->description,
                'category' => $transactionData->categoryId,
                'amount' => $transactionData->amount,
                'date' => $transactionData->transactionDate
            ]);

        $user = $request->getAttribute('user');

        $this->transactionService->create($transactionData, $user);

        return $response->withHeader('Location', '/transactions')->withStatus(302);
    }


    public function delete(Request $request, Response $response, array $args): Response
    {
        $this->transactionService->delete((int) $args['id']);

        return $response;
    }

    public function get(Request $request, Response $response, array $args): Response
    {
        $transactionId = (int) $args['id']; // inputs from the frontend are always strings, so it needs to be cast as int.

        $transaction = $this->transactionService->getById($transactionId);

        if (!$transaction) {
            return $response->withStatus(404);
        }

        $data = ['id' => $transaction->getId(), 
        'description' => $transaction->getDescription(), 
        'amount' => $transaction->getAmount(),
        'category' => $transaction->getCategory()->getName(), 
        'category_id' => $transaction->getCategory()->getId()
        ];

        return $this->responseFormatter->asJson($response, $data);
    }

    
    public function update(Request $request, Response $response, array $args): Response
    {
        $data = $this->requestValidatorFactory->make(UpdateTransactionRequestValidator::class)->validate(
            $args + $request->getParsedBody()
        );

        $transaction = $this->transactionService->getById((int) $data['id']);

        if (! $transaction) {
            return $response->withStatus(404);
        }

        $transactionData = new TransactionData($data['description'], (int) $data['category'], (float) $data['amount'], $data['date'] ?? null );

        $this->transactionService->update($transaction, $transactionData);

        return $response;
    }


    public function load(Request $request, Response $response): ResponseInterface
    {

        $params = $this->requestService->getDataTableQueryParameters($request);

        $transactions = $this->transactionService->getPaginatedCategories($params);

        $transformer = function (Transaction $transaction) {
                    return [
                            'id' => $transaction->getId(),
                            'description' => $transaction->getDescription(),
                            'amount' => $transaction->getAmount(),
                            'category' => $transaction->getCategory()->getName(),
                            'date' => $transaction->getCreatedAt()->format('Y-m-d H:i:s'),
                            'category_id' => $transaction->getCategory()->getId()
                        ];
        };

        $transactionsAmount = count($transactions);

        return $this->responseFormatter->asDataTable(
                $response,
                array_map($transformer, (array) $transactions->getIterator()),
                $params->draw,
                $transactionsAmount
            );
    }
}
