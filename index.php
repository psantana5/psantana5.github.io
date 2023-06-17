<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize inputs
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $subject = sanitizeInput($_POST['subject']);
    $message = sanitizeInput($_POST['message']);

    // Validate inputs
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo 'Please fill in all the required fields.';
        exit;
    }

    // Set recipient email and prepare email headers
    $to = 'pausantanapi2@gmail.com';
    $subject = "Contact Form Submission: $subject";
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $name <$email>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Prepare email body
    $body = "Name: $name\r\n";
    $body .= "Email: $email\r\n";
    $body .= "Subject: $subject\r\n";
    $body .= "Message:\r\n$message";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo 'Thank you for contacting us!';
    } else {
        echo 'Oops! An error occurred.';
    }
}

/**
 * Sanitize user input to prevent email injection and other security issues
 *
 * @param string $input The user input string to sanitize
 * @return string The sanitized input
 */
function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>
