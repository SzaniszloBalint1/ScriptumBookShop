<?php

return [
   'paths' => ['api/*', 'sanctum/csrf-cookie'], // Engedélyezzük a szükséges endpointokat
    'allowed_methods' => ['*'], // Minden HTTP metódus engedélyezése
    'allowed_origins' => ['http://localhost:3000'], // Csak a frontend URL-je
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Minden fejléc engedélyezése
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
