<?php

return [
    'mia_auth' => [
        'key' => getenv('API_KEY') ? getenv('API_KEY') : 'KEYCODAHUB21PLATFORM',
        'method' => 'jwt',
        'iss' => 'https://agencycoda.com',
        'aud' => 'https://agencycoda.com',
        'expire' => 'P15D'
    ],
];