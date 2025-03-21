<?php
namespace App;
/**
 * Interface EmailProviderInterface
 *
 * Provides a standard method for sending emails.
 */
interface EmailProviderInterface
{
    /**
     * Sends an email.
     *
     * @param string $to Recipient email address.
     * @param string $subject Subject of the email.
     * @param string $body Body content of the email.
     * @return void
     */
    public function sendEmail(string $to, string $subject, string $body): bool;
}
?>
