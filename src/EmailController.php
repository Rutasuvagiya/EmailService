<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class EmailController
{
    private $providerManager;
    private $templateRenderer;

    public function __construct(ProviderManager $providerManager, TemplateRenderer $templateRenderer)
    {
        $this->providerManager = $providerManager;
        $this->templateRenderer = $templateRenderer;
    }

    public function sendEmail(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        // Validate input data
        // ...

        $emailData = [
            'to' => $data['to'],
            'subject' => $data['subject'],
            'body' => $this->templateRenderer->render($data['template'], $data['variables']),
        ];

        try {
            $this->providerManager->sendEmail($emailData);
            return $response->withStatus(200)->withJson(['message' => 'Email sent successfully.']);
        } catch (Exception $e) {
            return $response->withStatus(500)->withJson(['error' => 'Failed to send email.']);
        }
    }
}
?>
