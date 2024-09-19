<?php declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\EntityManagerServiceInterface;
use App\Contracts\RequestValidatorFactoryInterface;
use App\Entity\Receipt;
use App\Entity\Transaction;
use App\Entity\Transaction as EntityTransaction;
use App\RequestValidators\UploadReceiptRequestValidator;
use App\Services\ReceiptService;
use App\Services\TransactionService;
use League\Flysystem\Filesystem;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Psr7\Stream;


class ReceiptController
{

    public function __construct(
    private readonly Filesystem $filesystem, 
    private readonly RequestValidatorFactoryInterface $requestValidatorFactory,
    private readonly TransactionService $transactionService,
    private readonly ReceiptService $receiptService,
    private readonly EntityManagerServiceInterface $entityManager
    ) {}


    public function store(Request $request, Response $response, EntityTransaction $transaction): ResponseInterface
    {

        $file = $this->requestValidatorFactory->make(UploadReceiptRequestValidator::class)->validate($request->getUploadedFiles())['receipt'];

        $filename = $file->getClientFilename();


        $randomFilename = bin2hex(random_bytes(25));
        

        // * 'write()' + 'getContents()' is GOOD for small files, but bad for large files
        // * If you want to save large files, you should use 'writeStream()' instead of 'write()'.
        $this->filesystem->write('receipts/' . $randomFilename, $file->getStream()->getContents());

        $receipt =  $this->receiptService->create($transaction, $filename, $randomFilename, $file->getClientMediaType());

        $this->entityManager->sync($receipt);

        return $response;
    }

    public function download(Request $request, Response $response, Transaction $transaction, Receipt $receipt): ResponseInterface
    {

        if ($receipt->getTransaction()->getId() !== $transaction->getId()) {
            return $response->withStatus(401);
        }

        // read the stream, using the storageFileName as the filename:
        $file = $this->filesystem->readStream('receipts/' . $receipt->getStorageFilename());


        return $response->withHeader('Content-Type', $receipt->getMediaType())
                        ->withHeader('Content-Disposition', 'inline; filename=' . $receipt->getFilename()) // 'attachment' will make it so the file is downloaded directly. 'inline' will display the file in the browser window.
                        ->withBody(new Stream($file));
    }

    public function delete(Response $response, Transaction $transaction, Receipt $receipt): ResponseInterface
    {

        if ($receipt->getTransaction()->getId() !== $transaction->getId()) {
            return $response->withStatus(401);
        }

        $this->filesystem->delete('receipts/' . $receipt->getStorageFilename());

        $this->entityManager->delete($receipt, true); // 'true' to sync/flush, so changes are applied.

        return $response;
    }
}
