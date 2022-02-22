<?php
// In config/autoload/cors.global.php
declare(strict_types=1);

use \Mezzio\Cors\Configuration\ConfigurationInterface;

return [
    ConfigurationInterface::CONFIGURATION_IDENTIFIER => [
        'allowed_origins' => [ConfigurationInterface::ANY_ORIGIN], // Allow any origin
        'allowed_headers' => ["Authorization", "If-Match", "If-Unmodified-Since", "Content-Type", "Content-Language", "Access-Control-Request-Headers", "Access-Control-Request-Method", "Accept", "Accept-Encoding", "Accept-Language", "Origin", "X-Auth-Token", "X-Requested-With", "Access-Control-Allow-Headers", "Access-Control-Allow-Origin", "X-Api-Key", "Referer", "User-Agent", "Cache-Control", "Connection", "Content-Length", "Host", "Pragma", "Sec-Fetch-Mode", "Accept-Charset", "Vary", "Date"], // No custom headers allowed
        'allowed_max_age' => '600', // 10 minutes
        'credentials_allowed' => false, // Allow cookies
        'exposed_headers' => ['X-Custom-Header', 'Etag'], // Tell client that the API will always return this header
        //'allowed_methods' => ["GET", "POST", "PUT", "PATCH", "DELETE"]
    ],
];