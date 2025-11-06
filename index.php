<?php
require 'vendor/autoload.php';

use Google\Client;
use Google\Service\Drive;

// Initialize Google Client
$client = new Client();
$client->setAuthConfig('serviceaccount/meero-449508-7a96b12c2758.json');
$client->addScope(Drive::DRIVE_FILE);

// Authenticate and Initialize Google Drive Service
$service = new Drive($client);

// Check if a file is uploaded

    $fileTmpPath = 'upload/10page_sample.pdf';
    $fileName = '10page_sample.pdf';

    // Upload file to Google Drive
    $fileMetadata = new Drive\DriveFile([
        'name' => $fileName
    ]);
    $content = file_get_contents($fileTmpPath);

    $uploadedFile = $service->files->create(
        $fileMetadata,
        [
            'data' => $content,
            'mimeType' => mime_content_type($fileTmpPath),
            'uploadType' => 'multipart',
            'fields' => 'id'
        ]
    );

    echo "File uploaded successfully. File ID: " . $uploadedFile->id;

?>
