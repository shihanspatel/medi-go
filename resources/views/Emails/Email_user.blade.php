<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="margin:0; padding:0; background:#f4f7f9; font-family: Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
<tr>
<td align="center">

<table width="600" cellpadding="0" cellspacing="0"
       style="background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08);">

    <!-- Header -->
    <tr>
        <td style="background:linear-gradient(135deg,#059669,#047857); padding:30px; text-align:center; color:white;">
            <h1 style="margin:0;">🏥 Medi-Go</h1>
            <p style="margin:5px 0 0;">Fast, Secure & Trusted Medicine Delivery</p>
        </td>
    </tr>

    <!-- Body -->
    <tr>
        <td style="padding:40px 30px; text-align:center;">

            <h2 style="color:#111827;">Hello {{ $name }} 👋</h2>

            <p style="color:#6b7280; font-size:15px; line-height:1.6;">
                Thank you for registering with Medi-Go.
                Please verify your email address to activate your account.
            </p>

            <div style="margin:30px 0;">
                <a href="{{ $actionUrl }}"
                   style="background:#059669; color:white;
                          padding:14px 30px;
                          text-decoration:none;
                          border-radius:50px;
                          font-weight:bold;">
                    Verify My Account
                </a>
            </div>

            <p style="font-size:13px; color:#9ca3af;">
                If you did not create this account, please ignore this email.
            </p>

        </td>
    </tr>

    <!-- Footer -->
    <tr>
        <td style="background:#f9fafb; padding:20px; text-align:center; font-size:12px; color:#6b7280;">
            © {{ date('Y') }} Medi-Go. All rights reserved.
            <br>
            Rajkot, Gujarat, India
        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>