<?php 

// Simulate form submission for testing (optional, for local test only)
// $request['reply'] = 'This is a test reply message.';

// Receiver email
$to = "choudaryshehroz450@gmail.com"; 

// Email subject
$subject = "Testing";

// Message body (escaped for safety)
$message = "Welcome"; 

// Proper header with "From:"
$headers = "From: choudaryshehroz450@gmail.com\r\n";

// Optional: add Content-Type if sending HTML
// $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$check = mail($to, $subject, $message, $headers);

if ($check) {
    echo "ok";
} else {
    echo 'error';
}
?>
