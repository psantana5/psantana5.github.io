<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize inputs
    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? sanitizeInput($_POST['subject']) : '';
    $message = isset($_POST['message']) ? sanitizeInput($_POST['message']) : '';

    // Set recipient email and prepare email headers
    $to = 'pausantanapi2@gmail.com';
    $emailSubject = "Contact Form Submission: $subject";
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $name <$email>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Prepare email body
    $emailBody = "Name: $name\r\n";
    $emailBody .= "Email: $email\r\n";
    $emailBody .= "Subject: $subject\r\n";
    $emailBody .= "Message:\r\n$message";

    // Send email
    if (mail($to, $emailSubject, $emailBody, $headers)) {
        echo 'Thank you for contacting us!';
    } else {
        echo 'Oops! An error occurred.';
    }
}