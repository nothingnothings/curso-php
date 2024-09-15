<?php declare(strict_types=1);

namespace App\RequestValidators;

use App\Contracts\RequestValidatorInterface;
use App\Exception\ValidationException;
use League\MimeTypeDetection\FinfoMimeTypeDetector;
use Psr\Http\Message\UploadedFileInterface;
use finfo;

class UploadReceiptRequestValidator implements RequestValidatorInterface
{
    public function validate(array $data): array
    {
        /** @var UploadedFileInterface $uploadedFile */
        $uploadedFile = $data['receipt'] ?? null;

        // 1. Validate Uploaded File (check if it was created in the /tmp/ folder)
        if (!$uploadedFile) {
            throw new ValidationException(['receipt' => ['Please select a receipt file.']]);
        }

        if ($uploadedFile->getError() !== UPLOAD_ERR_OK) {
            throw new ValidationException(['receipt' => ['Failed to upload the receipt file.']]);
        }

        // 2. Validate File Size (check if the file is less than 5MB)
        $maxFileSize = 5;

        if ($uploadedFile->getSize() > $maxFileSize * 1024 * 1024) {
            throw new ValidationException(['receipt' => ['Maximum allowed file size is 5 MB.']]);
        }

        // 3. Validate File Name (check if the file name is valid, no invalid characters)
        $fileName = $uploadedFile->getClientFilename();

        if (!preg_match('/^[a-zA-Z0-9\s._-]+$/', $fileName)) {
            throw new ValidationException(['receipt' => ['Invalid file name.']]);
        }

        // 4. Validate File Extension (check if the file extension is valid... mime type can be invalid)
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        $allowedExtensions = ['pdf', 'png', 'jpeg', 'jpg'];
        $tmpFilePath = $uploadedFile->getStream()->getMetadata('uri');

        // ! We must not trust only the file extension sent by the client, because it can be easily spoofed.
        if (!in_array($uploadedFile->getClientMediaType(), $allowedMimeTypes)) {
            throw new ValidationException(['receipt' => ['Receipt must be either an image or a pdf document.']]);
        }

        $detector = new FinfoMimeTypeDetector();
        $mimeType = $detector->detectMimeTypeFromFile($tmpFilePath);

        if (!in_array($mimeType, $allowedMimeTypes)) {
            throw new ValidationException(['receipt' => ['Invalid file type.']]);
        }

        return $data;
    }

    // private function getExtension(mixed $tmpFilePath): string
    // {
    //     // * With this, we can validate the file extensions with more confidence:
    //     $fileInfo = new finfo(FILEINFO_EXTENSION);
    //     $extension = $fileInfo->file($tmpFilePath);

    //     return $extension ?: '';
    // }

    // private function getMimeType(mixed $tmpFilePath): string
    // {
    //     // * With this, we can validate the mime types with more confidence:
    //     $fileInfo = new finfo(FILEINFO_MIME_TYPE);
    //     $mimeType = $fileInfo->file($tmpFilePath);

    //     return $mimeType ?: '';
    // }
}
