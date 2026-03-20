<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #059669 0%, #10b981 100%); color: white; padding: 20px; border-radius: 8px 8px 0 0; text-align: center; }
        .content { background: #f8fafc; padding: 30px; border-radius: 0 0 8px 8px; }
        .message-box { background: white; padding: 20px; border-left: 4px solid #059669; margin: 20px 0; border-radius: 4px; }
        .footer { text-align: center; margin-top: 30px; color: #64748b; font-size: 12px; }
        .btn { display: inline-block; background: #059669; color: white; padding: 12px 30px; text-decoration: none; border-radius: 6px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Medi-Go Support Reply</h2>
        </div>
        
        <div class="content">
            <p>Hello <strong>{{ $userName }}</strong>,</p>
            
            <p>Thank you for contacting Medi-Go. We have reviewed your message and here is our response:</p>
            
            <div class="message-box">
                <p>{{ $replyMessage }}</p>
            </div>
            
            <p>If you have any further questions or concerns, please don't hesitate to reach out to us.</p>
            
            <p>Best regards,<br><strong>Medi-Go Support Team</strong></p>
            
            <div class="footer">
                <p>&copy; 2024 Medi-Go. All rights reserved.</p>
                <p>This is an automated response. Please do not reply to this email.</p>
            </div>
        </div>
    </div>
</body>
</html>
