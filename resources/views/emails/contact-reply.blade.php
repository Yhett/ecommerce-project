<!DOCTYPE html>
<html>
<head>
    <title>Reply from NextMart</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto;">
    <div style="background: linear-gradient(135deg, #764ba2 0%, #493483 100%); padding: 40px 20px; text-align: center;">
        <h1 style="color: white; margin: 0; font-size: 28px;">NextMart</h1>
        <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0 0;">Thank you for contacting us!</p>
    </div>
    
    <div style="padding: 40px 30px; background: #f8f9fa;">
        <h2 style="color: #2f2340; border-bottom: 3px solid #764ba2; padding-bottom: 10px;">Re: {{ $message->subject ?: 'Contact Form Inquiry' }}</h2>
        
        <div style="background: white; border-left: 4px solid #764ba2; padding: 20px; margin: 20px 0;">
            <p><strong>From:</strong> {{ $message->name }} <{{ $message->email }}></p>
            <p><strong>Date:</strong> {{ $message->created_at->format('M d, Y g:i A') }}</p>
            <p><strong>Subject:</strong> {{ $message->subject ?: 'No Subject' }}</p>
            <h4 style="margin-top: 20px; color: #2f2340;">Original Message:</h4>
            <div style="background: #f1f3f4; padding: 15px; border-radius: 8px; font-size: 14px; white-space: pre-wrap;">
                {{ $message->message }}
            </div>
        </div>

        <h3 style="color: #2f2340; margin-top: 30px;">Our Reply:</h3>
        <div style="background: #e8f5e8; border: 1px solid #4caf50; padding: 20px; border-radius: 8px; white-space: pre-wrap;">
            {{ $message->reply }}
        </div>

        <div style="margin-top: 30px; padding: 20px; background: white; border-radius: 8px; text-align: center;">
            <p>Best regards,<br><strong>NextMart Team</strong></p>
            <p>Tomas Cabiles St., Tabaco City, Albay<br>+63 917 123 4567 | info@nextmart.com</p>
        </div>
    </div>

    <div style="background: #2f2340; color: white; text-align: center; padding: 20px; font-size: 12px;">
        <p>&copy; 2024 NextMart. All rights reserved.</p>
    </div>
</body>
</html>

