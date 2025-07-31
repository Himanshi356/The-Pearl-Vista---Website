<?php
/**
 * Email helper for development/testing
 * In production, replace this with a proper SMTP service
 */

function sendVerificationEmail($email, $verification_code) {
    // For development, log the verification code
    $log_message = date('Y-m-d H:i:s') . " - Verification code for $email: $verification_code\n";
    error_log($log_message, 3, '../logs/verification_codes.log');
    
    // In production, you would use a service like SendGrid, Mailgun, etc.
    // Example with PHPMailer:
    /*
    require 'vendor/autoload.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your-email@gmail.com';
    $mail->Password = 'your-app-password';
    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    
    $mail->setFrom('noreply@pearlvista.com', 'The Pearl Vista');
    $mail->addAddress($email);
    $mail->Subject = 'Your Verification Code';
    $mail->Body = "Your verification code is: $verification_code";
    
    return $mail->send();
    */
    
    return true; // For development, always return true
}

function getVerificationCode($email) {
    // For development, read from log file
    $log_file = '../logs/verification_codes.log';
    if (file_exists($log_file)) {
        $lines = file($log_file, FILE_IGNORE_NEW_LINES);
        foreach (array_reverse($lines) as $line) {
            if (strpos($line, $email) !== false) {
                preg_match('/Verification code for ' . preg_quote($email) . ': (\d+)/', $line, $matches);
                if (isset($matches[1])) {
                    return $matches[1];
                }
            }
        }
    }
    return null;
}
?> 