<?php declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\ReceiptServiceInterface;
use App\Contracts\RequestValidatorFactoryInterface;
use App\Contracts\TransactionServiceInterface;
use App\RequestValidators\UploadReceiptRequestValidator;
use League\Flysystem\Filesystem;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ReceiptController
{

    public function __construct(
    private readonly Filesystem $filesystem, 
    private readonly RequestValidatorFactoryInterface $requestValidatorFactory,
    private readonly TransactionServiceInterface $transactionService,
    private readonly ReceiptServiceInterface $receiptService
    ) {}


    public function store(Request $request, Response $response, array $args): ResponseInterface
    {

        $file = $this->requestValidatorFactory->make(UploadReceiptRequestValidator::class)->validate($request->getUploadedFiles())['receipt'];

        $filename = $file->getClientFilename();

        $id = (int) $args['id'];

        if (! $id || ! ($transaction = $this->transactionService->getById($id))) {
            return $response->withStatus(404);
        }

        $randomFilename = bin2hex(random_bytes(25));
        

        // * 'write()' + 'getContents()' is GOOD for small files, but bad for large files
        // * If you want to save large files, you should use 'writeStream()' instead of 'write()'.
        $this->filesystem->write('receipts/' . $randomFilename, $file->getStream()->getContents());


        $this->receiptService->create($transaction, $filename, $randomFilename);

        return $response;
    }
}
