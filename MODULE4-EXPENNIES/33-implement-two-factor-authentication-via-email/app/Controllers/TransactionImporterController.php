<?php declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\RequestValidatorFactoryInterface;
use App\DataObjects\TransactionData;
use App\RequestValidators\RequestValidatorFactory;
use App\RequestValidators\UploadTransactionRequestValidator;
use App\Services\CategoryService;
use App\Services\TransactionImportService;
use App\Services\TransactionService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class TransactionImporterController
{

    public function __construct(
        private readonly RequestValidatorFactoryInterface $requestValidatorFactory,
        private readonly TransactionImportService $transactionImportService

    ) {

    }


    public function import(Request $request, Response $response): Response
    {
         /** @var UploadedFileInterface $file */
         $file = $this->requestValidatorFactory->make(UploadTransactionRequestValidator::class)->validate(
            $request->getUploadedFiles()
        )['importFile'];

        $user = $request->getAttribute('user');


        $this->transactionImportService->importFromFile($file->getStream()->getMetadata('uri'), $user);

        return $response;

    }
}
