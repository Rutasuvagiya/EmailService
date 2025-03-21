<?php
require_once '/path/to/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TemplateRenderer
{
    private $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('/path/to/templates');
        $this->twig = new Environment($loader);
    }

    public function render(string $templateName, array $variables): string
    {
        return $this->twig->render($templateName, $variables);
    }
}
?>
