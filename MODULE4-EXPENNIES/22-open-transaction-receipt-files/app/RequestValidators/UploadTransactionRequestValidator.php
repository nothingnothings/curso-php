<?php declare(strict_types=1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\Exception\ValidationException;
use League\MimeTypeDetection\FinfoMimeTypeDetector;

class UploadTransactionRequestValidator implements RequestValidatorInterface
{
    public function validate(array $data): array
    {
        /** @var UploadedFileInterface $uploadedFile */
        $uploadedFile = $data['importFile'] ?? null;

        // 1. Validate Uploaded File (check if it was created in the /tmp/ folder)
        if (!$uploadedFile) {
            throw new ValidationException(['transactions' => ['Please select a transactions file.']]);
        }

        if ($uploadedFile->getError() !== UPLOAD_ERR_OK) {
            throw new ValidationException(['transactions' => ['Failed to upload the transactions file.']]);
        }

        // 2. Validate File Size (check if the file is less than 5MB)
        $maxFileSize = 5;

        if ($uploadedFile->getSize() > $maxFileSize * 1024 * 1024) {
            throw new ValidationException(['transactions' => ['Maximum allowed file size is 5 MB.']]);
        }

        // 3. Validate File Name (check if the file name is valid, no invalid characters)
        $fileName = $uploadedFile->getClientFilename();

        if (!preg_match('/^[a-zA-Z0-9\s._-]+$/', $fileName)) {
            throw new ValidationException(['transactions' => ['Invalid file name.']]);
        }

        // 4. Validate File Extension (check if the file extension is valid... mime type can be invalid)
        $allowedMimeTypes = ['text/csv'];
        $tmpFilePath = $uploadedFile->getStream()->getMetadata('uri');

        // ! We must not trust only the file extension sent by the client, because it can be easily spoofed.
        if (!in_array($uploadedFile->getClientMediaType(), $allowedMimeTypes)) {
            throw new ValidationException(['transactions' => ['transactions must be in csv format']]);
        }

        $detector = new FinfoMimeTypeDetector();
        $mimeType = $detector->detectMimeTypeFromFile($tmpFilePath);

        if (!in_array($mimeType, $allowedMimeTypes)) {
            throw new ValidationException(['transactions' => ['Invalid file type.']]);
        }

        return $data;
    }
}
