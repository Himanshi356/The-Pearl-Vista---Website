<?php
function generateVerificationEmailHTML($email, $verification_code, $username) {
    $html = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Email Verification - The Pearl Vista</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f4f4f4;
            }
            .email-container {
                background-color: #ffffff;
                border-radius: 10px;
                padding: 30px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .header {
                text-align: center;
                border-bottom: 3px solid #D4AF37;
                padding-bottom: 20px;
                margin-bottom: 30px;
            }
            .logo {
                font-size: 28px;
                font-weight: bold;
                color: #2c3e50;
                margin-bottom: 10px;
            }
            .subtitle {
                color: #7f8c8d;
                font-size: 16px;
            }
            .verification-code {
                background: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%);
                color: white;
                font-size: 32px;
                font-weight: bold;
                text-align: center;
                padding: 20px;
                border-radius: 10px;
                margin: 30px 0;
                letter-spacing: 5px;
            }
            .content {
                margin: 30px 0;
            }
            .footer {
                text-align: center;
                margin-top: 30px;
                padding-top: 20px;
                border-top: 1px solid #eee;
                color: #7f8c8d;
                font-size: 14px;
            }
            .button {
                display: inline-block;
                background: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%);
                color: white;
                text-decoration: none;
                padding: 12px 30px;
                border-radius: 5px;
                margin: 20px 0;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="header">
                <div class="logo">The Pearl Vista</div>
                <div class="subtitle">Email Verification</div>
            </div>
            
            <div class="content">
                <h2>Hello ' . htmlspecialchars($username) . '!</h2>
                
                <p>Thank you for creating an account with The Pearl Vista. To complete your registration, please use the verification code below:</p>
                
                <div class="verification-code">' . $verification_code . '</div>
                
                <p><strong>Important:</strong></p>
                <ul>
                    <li>This code will expire in 10 minutes</li>
                    <li>Do not share this code with anyone</li>
                    <li>If you did not request this code, please ignore this email</li>
                </ul>
                
                <p>If you have any questions, please contact our support team.</p>
                
                <p>Best regards,<br>The Pearl Vista Team</p>
            </div>
            
            <div class="footer">
                <p>This is an automated message. Please do not reply to this email.</p>
                <p>&copy; 2025 The Pearl Vista. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>';
    
    return $html;
}

function saveVerificationEmail($email, $verification_code, $username) {
    $html_content = generateVerificationEmailHTML($email, $verification_code, $username);
    
    // Create emails directory if it doesn't exist
    $emails_dir = '../emails';
    if (!is_dir($emails_dir)) {
        mkdir($emails_dir, 0755, true);
    }
    
    // Save the HTML email to a file
    $filename = $emails_dir . '/verification_' . time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $email) . '.html';
    file_put_contents($filename, $html_content);
    
    return $filename;
}
?> 