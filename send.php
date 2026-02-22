<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recipient Email
    $to = "ouiranna.sejour@gmail.com";

    // Sanitize and Validate Inputs
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Check for empty fields
    if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Redirect back with error (optional handling)
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
    }

    // Email Body
    $email_content = "You have received a new contact message.\n\n";
    $email_content .= "Sender Name: $name\n";
    $email_content .= "Sender Email: $email\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message Content:\n$message\n";

    // Email Headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send Email
    mail($to, $subject, $email_content, $headers);

    // Redirect back to the page
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
}
?>