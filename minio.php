<?php
use Aws\S3\S3Client;

require 'vendor/autoload.php';

function getMinioClient() {
    return new S3Client([
        'version' => 'latest',
        'region' => 'us-east-1',
        'endpoint' => 'http://127.0.0.1:9000',
        'use_path_style_endpoint' => true,
        'credentials' => [
            'key'    => 'minioadmin',
            'secret' => 'minioadmin',
        ],
    ]);
}

