<?php
// Replace with your real receiving email address
$receiving_email_address = 'rintokhan411@gmail.com';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize form fields
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    $phone = isset($_POST['phone']) ? filter_var($_POST['phone'], FILTER_SANITIZE_STRING) : '';

    // Build email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    if ($phone) {
        $email_content .= "Phone: $phone\n";
    }
    $email_content .= "Message:\n$message\n";

    // Email headers
    $headers = "From: $name <$email>";

    // Send the email and return JSON response
    if (mail($receiving_email_address, $subject, $email_content, $headers)) {
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send message.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>
