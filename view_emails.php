<?php
// Simple page to view generated email files
$emails_dir = 'emails';
$email_files = [];

if (is_dir($emails_dir)) {
    $files = scandir($emails_dir);
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'html') {
            $email_files[] = $file;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Generated Emails - The Pearl Vista</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
        }
        .email-list {
            margin-top: 20px;
        }
        .email-item {
            background: #f8f9fa;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            border-left: 4px solid #D4AF37;
        }
        .email-item a {
            color: #D4AF37;
            text-decoration: none;
            font-weight: bold;
        }
        .email-item a:hover {
            text-decoration: underline;
        }
        .no-emails {
            text-align: center;
            color: #7f8c8d;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📧 Generated Verification Emails</h1>
        
        <div class="email-list">
            <?php if (empty($email_files)): ?>
                <div class="no-emails">
                    <p>No email files found. Sign up for a new account to generate verification emails.</p>
                </div>
            <?php else: ?>
                <p>Click on any email file below to view the verification email:</p>
                <?php foreach ($email_files as $file): ?>
                    <div class="email-item">
                        <a href="emails/<?php echo htmlspecialchars($file); ?>" target="_blank">
                            📧 <?php echo htmlspecialchars($file); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="signup.html" style="background: #D4AF37; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                Create New Account
            </a>
        </div>
    </div>
</body>
</html> 