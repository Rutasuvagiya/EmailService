<?php
namespace App;

abstract class EmailProvider{
    protected array $failures = [];

    // Track provider failures dynamically
    public function reportFailure(string $providerKey): void {
        if (!isset($this->failures[$providerKey])) {
            $this->failures[$providerKey] = 0;
        }
        $this->failures[$providerKey]++;
    }
    
}