<?php
// Get the email file from URL parameter
$email_file = $_GET['file'] ?? '';

if (empty($email_file)) {
    header('Location: signup.html');
    exit;
}

// Security: only allow HTML files from emails directory
$email_file = basename($email_file);
$email_path = "emails/$email_file";

if (!file_exists($email_path) || pathinfo($email_file, PATHINFO_EXTENSION) !== 'html') {
    header('Location: signup.html');
    exit;
}

// Read the email content
$email_content = file_get_contents($email_path);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Email - The Pearl Vista</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            position: relative;
            overflow: hidden;
        }
        
        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #D4AF37, #B8860B, #D4AF37);
        }
        
        .header {
            text-align: center;
            padding: 40px 30px 30px;
            background: white;
        }
        
        .header h1 {
            color: #2c3e50;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .header p {
            color: #7f8c8d;
            font-size: 16px;
        }
        
        .content {
            padding: 0 30px 30px;
        }
        
        .info-box {
            background: linear-gradient(135deg, #e8f4fd 0%, #f0f8ff 100%);
            border: 1px solid #d1ecf1;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            position: relative;
        }
        
        .info-box::before {
            content: '📋';
            position: absolute;
            top: -10px;
            left: 20px;
            background: white;
            padding: 0 10px;
            font-size: 18px;
        }
        
        .info-box h3 {
            color: #2c3e50;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            margin-top: 5px;
        }
        
        .info-box p {
            color: #555;
            font-size: 14px;
            line-height: 1.6;
            margin: 8px 0;
        }
        
        .email-frame {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin: 25px 0;
            overflow: hidden;
            border: 1px solid #e1e8ed;
        }
        
        .actions {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e1e8ed;
        }
        
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%);
            color: white;
            padding: 14px 28px;
            text-decoration: none;
            border-radius: 10px;
            margin: 0 8px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #545b62 100%);
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }
        
        .btn-secondary:hover {
            box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
        }
        
        .success-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        
        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 15px;
            }
            
            .header {
                padding: 30px 20px 20px;
            }
            
            .content {
                padding: 0 20px 20px;
            }
            
            .btn {
                display: block;
                margin: 10px auto;
                max-width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="success-icon">✅</div>
            <h1>Verification Email Ready</h1>
            <p>Your verification email has been generated successfully</p>
        </div>
        
        <div class="content">
            <div class="info-box">
                <h3>Instructions</h3>
                <p><strong>1.</strong> Copy the verification code from the email below</p>
                <p><strong>2.</strong> Go to the verification page and enter the code</p>
                <p><strong>3.</strong> Complete your account setup</p>
            </div>
            
            <div class="email-frame">
                <?php echo $email_content; ?>
            </div>
            
            <div class="actions">
                <a href="email-verification.html?email=<?php echo urlencode($_GET['email'] ?? ''); ?>" class="btn">
                    🔐 Go to Verification Page
                </a>
                <a href="signup.html" class="btn btn-secondary">
                    ➕ Create Another Account
                </a>
            </div>
        </div>
    </div>
</body>
</html> 