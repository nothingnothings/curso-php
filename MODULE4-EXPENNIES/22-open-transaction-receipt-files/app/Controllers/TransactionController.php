<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\RequestValidatorFactoryInterface;
use App\DataObjects\TransactionData;
use App\Entity\Receipt;
use App\Entity\Transaction;
use App\RequestValidators\TransactionRequestValidator;
use App\RequestValidators\UploadTransactionRequestValidator;
use App\ResponseFormatter;
use App\Services\CategoryService;
use App\Services\RequestService;
use App\Services\TransactionService;
use DateTime;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class TransactionController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly RequestValidatorFactoryInterface $requestValidatorFactory,
        private readonly TransactionService $transactionService,
        private readonly ResponseFormatter $responseFormatter,
        private readonly RequestService $requestService,
        private readonly CategoryService $categoryService
    ) {}

    public function index(Request $request, Response $response): Response
    {
        return $this->twig->render(
            $response,
            'transactions/index.twig',
            ['categories' => $this->categoryService->getCategoryNames()]
        );
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $this->requestValidatorFactory->make(TransactionRequestValidator::class)->validate(
            $request->getParsedBody()
        );

        $this->transactionService->create(
            new TransactionData(
                $data['description'],
                (float) $data['amount'],
                new DateTime($data['date']),
                $data['category']
            ),
            $request->getAttribute('user')
        );

        return $response;
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        $this->transactionService->delete((int) $args['id']);

        return $response;
    }

    public function get(Request $request, Response $response, array $args): Response
    {
        $transaction = $this->transactionService->getById((int) $args['id']);

        if (! $transaction) {
            return $response->withStatus(404);
        }

        $data = [
            'id'          => $transaction->getId(),
            'description' => $transaction->getDescription(),
            'amount'      => $transaction->getAmount(),
            'date'        => $transaction->getDate()->format('Y-m-d\TH:i'),
            'category'    => $transaction->getCategory()->getId(),
        ];

        return $this->responseFormatter->asJson($response, $data);
    }

    public function update(Request $request, Response $response, array $args): Response
    {
        $data = $this->requestValidatorFactory->make(TransactionRequestValidator::class)->validate(
            $args + $request->getParsedBody()
        );

        $id = (int) $data['id'];

        if (! $id || ! ($transaction = $this->transactionService->getById($id))) {
            return $response->withStatus(404);
        }

        $this->transactionService->update(
            $transaction,
            new TransactionData(
                $data['description'],
                (float) $data['amount'],
                new DateTime($data['date']),
                $data['category']
            )
        );

        return $response;
    }

    public function load(Request $request, Response $response): Response
    {
        $params       = $this->requestService->getDataTableQueryParameters($request);
        $transactions = $this->transactionService->getPaginatedTransactions($params);
        $transformer  = function (Transaction $transaction) {
            return [
                'id'          => $transaction->getId(),
                'description' => $transaction->getDescription(),
                'amount'      => $transaction->getAmount(),
                'date'        => $transaction->getDate()->format('m/d/Y g:i A'),
                'category'    => $transaction->getCategory()?->getName(),
                'receipts' => $transaction->getReceipts()->map(function (Receipt $receipt) {
                    return [
                        'id' => $receipt->getId(),
                        'name' => $receipt->getFilename(),
                    ];
                })->toArray(),
            ];
        };

        $totalTransactions = count($transactions);

        return $this->responseFormatter->asDataTable(
            $response,
            array_map($transformer, (array) $transactions->getIterator()),
            $params->draw,
            $totalTransactions
        );
    }

    public function upload(Request $request, Response $response): Response
    {

        $data = $this->requestValidatorFactory->make(UploadTransactionRequestValidator::class)->validate($request->getUploadedFiles());

        // Transactions will be in a csv. We need to read the csv's contents, using fgetcsv(), to create a single transaction for each row
        $csvContent = $data['importFile'];

        // Csv file will be in stream format, so we need to convert it to a string
        $csvContent = stream_get_contents($csvContent->getStream()->detach());

        // Convert CSV string to an array
        $rows = array_map('str_getcsv', explode("\n", $csvContent));

        $user = $request->getAttribute('user');

        // Skip first line:
        array_shift($rows);

        // Process each row
        foreach ($rows as $index => $row) {
            // Skip empty rows
            if (empty(array_filter($row))) {
                continue;
            }

            // Extract data from the row
            $description = $row[1] ?? '';
            $amount = preg_replace('/[^\d.-]/', '', $row[3]) ?? '';
            $date = $row[0] ?? '';
            $categoryId = $this->categoryService->getCategoryIdByName($row[2] ?? '');
            $category = $categoryId ? $this->categoryService->getById($categoryId) : null;

            $this->transactionService->create(
                new TransactionData(
                    $description,
                    (float) $amount,
                    new DateTime($date),
                    $category
                ),
                $user
            );
        }


        // $this->transactionService->importTransactions($user, $rows);

        return $response;
    }
}
