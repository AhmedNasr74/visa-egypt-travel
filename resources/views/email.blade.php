<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
        }
        .content h2 {
            color: #333333;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            color: #555555;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #aaaaaa;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>New Contact Form Submission</h1>
        </div>
        <div class="content">
            <h2>Hello,</h2>
            <p>You have received a new submission from your contact form. Here are the details:</p>
            <p><strong>Name:</strong> {{ $data['name'] }}</p>
            <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
            {{-- <a href="#" class="btn">View Details</a> --}}
        </div>
        <div class="footer">
            <p>Thank you for using our service!</p>
            <p>&copy; {{ date('Y') }} EgyptInStyle. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
