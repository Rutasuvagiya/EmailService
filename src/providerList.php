<?php
$providers = [
    'sendgrid' => function ($to, $subject, $body) {
        echo "Trying SendGrid...<br />";
        return rand(0, 1) === 1; // Simulate success/failure randomly
    },
    'mailgun' => function ($to, $subject, $body) {
        echo "Trying Mailgun...<br />";
        return rand(0, 1) === 1;
    },
    'smtp' => function ($to, $subject, $body) {
        echo "Trying SMTP...<br />";
        return rand(0, 1) === 1;
    },
    'sample1' => function ($to, $subject, $body) {
        echo "Trying Sample 1...<br />";
        return rand(0, 1) === 1;
    }
];


$successRates = [
    'sendgrid' => 10,
    'mailgun' => 99,
    'smtp' => 99,
    'sample1' => 70,

];