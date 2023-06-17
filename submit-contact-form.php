<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Send email
    $to = 'pausantanapi2@gmail.com'; // Replace with your email address
    $headers = "From: $name <$email>";
    $body = "Subject: $subject\n\n$message";

    if (mail($to, $subject, $body, $headers)) {
        echo 'Thank you for contacting us!';
    } else {
        echo 'Oops! An error occurred.';
    }
}
?>
