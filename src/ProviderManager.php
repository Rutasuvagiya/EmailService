<?php
namespace App;

use Exception;


class ProviderManager {
   // private $providers = [];
    private $strategy;

    public function __construct(ProviderSelectionStrategy $strategy) {
     //   $this->providers = $providers;
        $this->strategy = $strategy;
    }

    public function sendEmail(string $to, string $subject, string $body): bool {
        $failCount = 0;
        $maxRetries = 3;

        while ($failCount < $maxRetries) {
            $provider = $this->strategy->selectProvider();

            try {
                if ($provider[1]($to, $subject, $body)) {
                    echo "Email sent successfully via {$provider[0]}\n";
                    return true;
                } else {
                    echo "{$provider[0]} failed. Retrying...\n";
                    $this->strategy->reportFailure($provider[0]);
                }
            } catch (Exception $e) {
                echo "{$provider[0]} threw an exception: " . $e->getMessage() . "\n";
                $this->strategy->reportFailure($provider[0]);
            }

            $failCount++;
        }

        echo "All email providers failed after $maxRetries retries.\n";
        return false;
    
    }
}
