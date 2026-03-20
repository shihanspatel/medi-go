<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #007bff; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background-color: #f9f9f9; }
        .otp-box { background-color: #fff; padding: 20px; text-align: center; border: 2px solid #007bff; margin: 20px 0; }
        .otp-code { font-size: 32px; font-weight: bold; color: #007bff; letter-spacing: 5px; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Medi-Go Password Reset</h1>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>You requested to reset your password. Use the OTP below to proceed:</p>
            <div class="otp-box">
                <p>Your OTP Code:</p>
                <div class="otp-code">{{ $otp }}</div>
            </div>
            <p>This OTP is valid for 10 minutes. Do not share it with anyone.</p>
            <p>If you didn't request this, please ignore this email.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Medi-Go. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
