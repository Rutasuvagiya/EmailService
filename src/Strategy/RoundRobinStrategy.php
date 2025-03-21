<?php
namespace App\Strategy;

use App\ProviderSelectionStrategy;
use App\EmailProvider;
use Exception;

class RoundRobinStrategy extends EmailProvider implements ProviderSelectionStrategy {
    private $index = 0;
    private array $providers;
    private array $keys;

    public function __construct(array $providers) {
        if (empty($providers)) {
            throw new Exception("Array cannot be empty.");
        }
        $this->providers = $providers;
        $this->keys = array_keys($providers); // Store keys for iteration
    }

    public function selectProvider(): array {
       
        $key = $this->keys[$this->index];  // Get current key
        $provider = $this->providers[$key];       // Get value
        $this->index = ($this->index + 1) % count($this->providers); // Move to next
        return [$key,$provider]; // Return key-value pair
    }

}
