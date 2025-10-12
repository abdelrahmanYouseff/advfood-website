<?php

// Test script for Noon API
$apiKey = '7726cb7587c645c39b8f30059c353dd9';
$apiUrl = 'https://api-test.noonpayments.com';

$payload = [
    'apiOperation' => 'INITIATE',
    'order' => [
        'reference' => 'TEST-' . time(),
        'amount' => '100.00',
        'currency' => 'SAR',
        'name' => 'Test Order',
        'channel' => 'web',
        'category' => 'food'
    ],
    'configuration' => [
        'tokenizeCc' => false,
        'returnUrl' => 'http://127.0.0.1:8000/test-callback',
        'locale' => 'ar',
    ],
    'billing' => [
        'address' => [
            'street' => 'Test Street',
            'city' => 'Riyadh',
            'countryCode' => 'SA',
        ],
    ],
    'customer' => [
        'email' => 'test@example.com',
        'firstName' => 'Test User',
        'phone' => [
            'countryCode' => '+966',
            'number' => '501234567',
        ],
    ],
];

echo "Testing Noon API...\n";
echo "URL: " . $apiUrl . "/payment/v1/order\n";
echo "Payload: " . json_encode($payload, JSON_PRETTY_PRINT) . "\n";

// Try different authorization formats
$authFormats = [
    'Format 1 (API Key only)' => $apiKey,
    'Format 2 (Bearer)' => 'Bearer ' . $apiKey,
    'Format 3 (Key test)' => 'Key test ' . $apiKey,
    'Format 4 (Key_test)' => 'Key_test ' . $apiKey,
];

foreach ($authFormats as $formatName => $authHeader) {
    echo "\n" . str_repeat('=', 50) . "\n";
    echo "Testing: " . $formatName . "\n";
    echo "Authorization: " . $authHeader . "\n";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl . '/payment/v1/order');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: ' . $authHeader,
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    echo "HTTP Code: " . $httpCode . "\n";
    if ($error) {
        echo "cURL Error: " . $error . "\n";
    } else {
        echo "Response: " . $response . "\n";

        if ($httpCode == 200) {
            echo "✅ SUCCESS! This format works!\n";
            break;
        }
    }
}

echo "\n" . str_repeat('=', 50) . "\n";
echo "Test completed.\n";
