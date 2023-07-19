<!DOCTYPE html>
<html>
<head>
    <title>Hello,  {{ $details['name'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        h1 {
            color: #333;
        }
        
        p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Your Details added by Admin. Kindly use below password for login</h1>

    <p>Username: {{ $details['email'] }}</p>
    <p>Password: {{ $details['password'] }}</p>
</body>
</html>
