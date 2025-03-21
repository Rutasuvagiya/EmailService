<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/providerList.php';

use App\ProviderManager;
use App\Strategy\RoundRobinStrategy;
use App\Strategy\PerformanceBasedStrategy;

$performanceBasedStrategy = function ($providers) {
    foreach ($providers as $providerKey) {
        if (isset($providers[$providerKey])) {
            return $providers[$providerKey];
        }
    }
    return reset($providers); // Default to the first provider if all fail
};

// Inject providers into ProviderManager
$strategy = new RoundRobinStrategy($providers);
// Inject strategy into ProviderManager
$emailService = new ProviderManager($strategy);

// Send an email
$emailService->sendEmail("user@example.com", "Welcome!", "Hello, welcome to our service!");

echo "<br/><hr>";
$emailService->sendEmail("user@example.com", "Welcome!", "Hello, welcome to our service!");


// Inject providers into ProviderManager
$strategy = new PerformanceBasedStrategy($providers, $successRates);
// Inject strategy into ProviderManager
$emailService = new ProviderManager($strategy);

echo "<br/><hr>";
// Send an email
$emailService->sendEmail("user@example.com", "Welcome!", "Hello, welcome to our service!");
