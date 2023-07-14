<?php
$to = 'lloyd@solicitors.co.za';
$subject = 'Testing the mail function';
$message = 'If you receive this email, it means the mail function is working!';

if (mail($to, $subject, $message)) {
    echo 'Email sent successfully!';
} else {
    echo 'Failed to send email.';
}
