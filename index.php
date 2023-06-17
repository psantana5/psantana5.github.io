<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\Users\msali\Downloads\PHPMailer-master\src\Exception.php';
require 'C:\Users\msali\Downloads\PHPMailer-master\src\PHPMailer.php';
require 'C:\Users\msali\Downloads\PHPMailer-master\src\SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize inputs
    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? sanitizeInput($_POST['subject']) : '';
    $message = isset($_POST['message']) ? sanitizeInput($_POST['message']) : '';

    // Validate inputs
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo 'Please fill in all the required fields.';
        exit;
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pausantanapi2@gmail.com'; // Your Gmail email address
        $mail->Password = 'safe password :)'; // Your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom($email, $name);
        $mail->addAddress('pausantanapi2@gmail.com');

        // Email content
        $mail->isHTML(false);
        $mail->Subject = "Contact Form Submission: $subject";
        $mail->Body = "Name: $name\r\nEmail: $email\r\nSubject: $subject\r\nMessage:\r\n$message";

        // Send email
        if ($mail->send()) {
            echo 'Thank you for contacting me!';
        } else {
            echo 'Oops! An error occurred. Error message: ' . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo 'Oops! An error occurred. Error message: ' . $e->getMessage();
    }
}

/**
 * Sanitize user input to prevent email injection and other security issues
 *
 * @param string|null $input The user input string to sanitize
 * @return string The sanitized input
 */
function sanitizeInput($input)
{
    if (is_string($input)) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
    return '';
}
?>
