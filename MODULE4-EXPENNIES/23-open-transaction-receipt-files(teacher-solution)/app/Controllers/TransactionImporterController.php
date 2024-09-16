<?php declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\RequestValidatorFactoryInterface;
use App\DataObjects\TransactionData;
use App\RequestValidators\RequestValidatorFactory;
use App\RequestValidators\UploadTransactionRequestValidator;
use App\Services\CategoryService;
use App\Services\TransactionService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class TransactionImporterController
{

    public function __construct(
        private readonly CategoryService $categoryService,
        private readonly TransactionService $transactionService,
        private readonly RequestValidatorFactoryInterface $requestValidatorFactory

    ) {

    }


    public function import(Request $request, Response $response): Response
    {
         /** @var UploadedFileInterface $file */
         $file = $this->requestValidatorFactory->make(UploadTransactionRequestValidator::class)->validate(
            $request->getUploadedFiles()
        )['importFile'];

        $user = $request->getAttribute('user');
        $resource = fopen($file->getStream()->getMetadata('uri'), 'r');
        $categories = $this->categoryService->getAllKeyedByName(); // * This is MUCH BETTER than trying to find each category by name, individually.

        // Discard the header row
        fgetcsv($resource);

        while (($row = fgetcsv($resource)) !== false) {
            [$date, $description, $category, $amount] = $row;

            $date     = new \DateTime($date);
            $category = $categories[strtolower($category)] ?? null;
            $amount   = str_replace(['$', ','], '', $amount);

            $transactionData = new TransactionData($description, (float) $amount, $date, $category);

            $this->transactionService->create($transactionData, $user);
        }

        return $response;

    }
}
