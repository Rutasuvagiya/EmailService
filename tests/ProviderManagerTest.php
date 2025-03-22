<?php
use PHPUnit\Framework\TestCase;
use App\ProviderManager;
use App\Strategy\RoundRobinStrategy;
use App\Strategy\PerformanceBasedStrategy;

class ProviderManagerTest extends TestCase {
    private array $providers;
    private $roundRobinStrategy;
    private ProviderManager $providerManager;

    protected function setUp(): void {
        $this->providers = [
            "sendgrid" => function ($to, $subject, $body) { return true; },
            "mailgun" => function ($to, $subject, $body) { return false; },
            "smtp" => function ($to, $subject, $body) { return true; },
            "sample1" => function ($to, $subject, $body) { return false; },
            "sample2" => function ($to, $subject, $body) { return true; },
            "sample3" => function ($to, $subject, $body) { return false; }
        ];

        $this->roundRobinStrategy = new RoundRobinStrategy($this->providers);

        $this->providerManager = new ProviderManager($this->roundRobinStrategy);
    }



    public function testSuccessfulEmailSending() {
       
        $this->assertTrue($this->providerManager->sendEmail("user@example.com", "Test", "Hello!"));
    }

    public function testFailoverMechanism() {

        $providers = [
            "sendgrid" => function ($to, $subject, $body) { return false; },
            "mailgun" => function ($to, $subject, $body) { return false; },
            "smtp" => function ($to, $subject, $body) { return true; },
            "sample1" => function ($to, $subject, $body) { return false; },
            "sample2" => function ($to, $subject, $body) { return false; },
            "sample3" => function ($to, $subject, $body) { return true; }
        ];

        $roundRobinStrategy = new RoundRobinStrategy($providers);

        $emailService = new ProviderManager($roundRobinStrategy);

        $this->assertTrue($emailService->sendEmail("user@example.com", "Test", "Hello!"));
    }

    public function testMaximumFailoverAttepts() {

        $providers = [
            "sendgrid" => function ($to, $subject, $body) { return false; },
            "mailgun" => function ($to, $subject, $body) { return false; },
            "smtp" => function ($to, $subject, $body) { return false; },
            "sample1" => function ($to, $subject, $body) { return true; }
        ];

        $roundRobinStrategy = new RoundRobinStrategy($providers);

        $emailService = new ProviderManager($roundRobinStrategy);

        $this->assertFalse($emailService->sendEmail("user@example.com", "Test", "Hello!"));
    }

    public function testAllProvidersFail() {
        $providers = [
            "sendgrid" => function ($to, $subject, $body) { return false; },
            "mailgun" => function ($to, $subject, $body) { return false; },
            "smtp" => function ($to, $subject, $body) { return false; },
            "sample1" => function ($to, $subject, $body) { return false; }
        ];

        $roundRobinStrategy = new RoundRobinStrategy($providers);

        $emailService = new ProviderManager($roundRobinStrategy);
        $this->assertFalse($emailService->sendEmail("user@example.com", "Test", "Hello!"));
    }
}
