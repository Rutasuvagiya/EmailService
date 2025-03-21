<?php
namespace App;

interface ProviderSelectionStrategy {
    public function selectProvider(): array;
}
