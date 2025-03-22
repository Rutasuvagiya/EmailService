# Email Service API

A versatile and scalable email service API designed to abstract multiple email service providers, support dynamic HTML templates with personalized data, and efficiently handle high volumes of concurrent emails.

## Features

- **Multiple Provider Support** 
- **Dynamic HTML Templates** 
- **High Concurrency Handling** 


## Installation

1. **Clone the Repository:**
`git clone https://github.com/Rutasuvagiya/EmailService.git`

2. Navigate to the Project Directory:
`cd EmailService`

3. Install Dependencies Using Composer:
`composer install`

4. Implementing asynchronous email sending in PHP on Windows using Redis involves setting up a queuing system where emails are queued for sending, and a background worker processes these queues to send the emails. Here's a step-by-step guide to achieve this:

    Install Redis on Windows

    Although Redis is primarily designed for Unix-based systems, you can run it on Windows using the following methods:

    Using Windows Subsystem for Linux (WSL): Install WSL and then install Redis within the Linux environment.

    Using Docker: Run a Redis container using Docker Desktop for Windows.

    For detailed instructions, refer to the official Redis installation guide for Windows.



Usage
## API with json data

### Request

`POST sendEmail`

    curl -X POST -H "Content-Type: application/json" -d "{\"template_name\":\"welcome_email\",\"to\": \"test@nca.com\",\"data\":{\"name\":\"Test User\"}}" http://localhost/emailService/sendEmail.php

### Response
HTTP/1.1 200 OK
      {
        "status": "success",
        "message": "Email(s) queued successfully."
      }

## API with json data in file

### Request

`POST sendEmail`

    curl -X POST -F "json_file=@C:\xampp\htdocs\emailService\src\emailQueue.json" http://localhost/emailService/sendEmail.php

# json file format
    [{
    "to": "tracikinney@kozgene.com",
    "data": {
      "name": "Corine",
      "reset_link": "<a>Reset Password</a>"
    },
    "template_name": "subscription_email"
  },
  {
    "to": "corinekinney@joviold.com",
    "data": {
      "name": "Hollie"
    },
    "template_name": "welcome_email"
  }]

### Response
HTTP/1.1 200 OK
      {
        "status": "success",
        "message": "Email(s) queued successfully."
      }

