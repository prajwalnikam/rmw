<!DOCTYPE html>
<html>
<head>
    <title>Contact Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Contact Request</h1>
        </div>
        <p>Dear Sir/Madam,</p>
        <p>You have received a contact request from a client with the following details:</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Message:</strong></p>
        <p>{{ $userMessage }}</p>
        <p>The client has seen the resource and wants to reach out to you regarding the following resource:</p>
        <p><strong>Resource:</strong> {{ $resourceName }}</p>
    </div>
</body>
</html>