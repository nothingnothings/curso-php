<?php declare(strict_types=1);

namespace App\Controllers;


use App\Contracts\RequestValidatorFactoryInterface;
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
    private readonly ReceiptService $receiptService
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

        $this->receiptService->create($transaction, $filename, $randomFilename, $file->getClientMediaType());

        return $response;
    }

    public function download(Request $request, Response $response, array $args): Response
    {

        $transactionId = (int) $args['transactionId'];
        $receiptId     = (int) $args['receiptId'];

        if (!$transactionId || ! ($transaction = $this->transactionService->getById($transactionId))) {
            return $response->withStatus(404);
        }

        if (!$receiptId || ! ($receipt = $this->receiptService->getById($receiptId))) {
            return $response->withStatus(404);
        }

        if ($receipt->getTransaction()->getId() !== $transactionId) {
            return $response->withStatus(401);
        }

        // read the stream, using the storageFileName as the filename:
        $file = $this->filesystem->readStream('receipts/' . $receipt->getStorageFilename());


        return $response->withHeader('Content-Type', $receipt->getMediaType())
                        ->withHeader('Content-Disposition', 'inline; filename=' . $receipt->getFilename()) // 'attachment' will make it so the file is downloaded directly. 'inline' will display the file in the browser window.
                        ->withBody(new Stream($file));
    }

    public function delete(Request $request, Response $response, array $args): Response
    {

        $transactionId = (int) $args['transactionId'];
        $receiptId     = (int) $args['receiptId'];

        if (!$transactionId || ! ($transaction = $this->transactionService->getById($transactionId))) {
            return $response->withStatus(404);
        }

        if (!$receiptId || ! ($receipt = $this->receiptService->getById($receiptId))) {
            return $response->withStatus(404);
        }

        if ($receipt->getTransaction()->getId() !== $transactionId) {
            return $response->withStatus(401);
        }

        $this->filesystem->delete('receipts/' . $receipt->getStorageFilename());

        $this->receiptService->delete($receipt);

        return $response;
    }
}
