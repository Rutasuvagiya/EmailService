<?php
namespace App\Strategy;

use App\ProviderSelectionStrategy;
use App\EmailProvider;

class PerformanceBasedStrategy extends EmailProvider implements ProviderSelectionStrategy {
    private array $successRates = [];
    private array $providers;

    public function __construct(array $providers, array $successRates) {
        $this->successRates = $successRates;
        $this->providers = $providers;
    }

    public function selectProvider(): array {
        // Sort providers dynamically based on lowest failures and highest success rate
        $arr = array_keys($this->successRates);
        uasort($arr, function ($a, $b) {
          echo '========<br/>'.($this->failures[$a] ?? 0) <=> (isset($this->failures[$b]) && $this->failures[$b] ?? 0) . '<br/>';
            return ($this->failures[$a] ?? 0) <=> (isset($this->failures[$b]) && $this->failures[$b] ?? 0) ?: ($b <=> $a);
        });
        
        print_r($this->successRates);
        print_r($this->failures);
        foreach (array_keys($this->successRates) as $index) {
            
            echo $index;
            if (isset($this->providers[$index])) {
                return [$index,$this->providers[$index]];
            }
        }
        $key= array_key_first($this->providers);
        return [$key,$this->providers[$key]]; // Default fallback
    }

    
}
