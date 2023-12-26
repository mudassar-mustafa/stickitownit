<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <style>

        table {
            border-collapse: collapse;
            width: 100%;
            min-width: fit-content;
            text-align: center;
        }

        table tbody tr:nth-child(even) {
            background-color: #40513b14;
        }

        td,
        th {
            padding: 15px 10px;
            font-size: 14px;
            color: #675d50;
        }

        th {
            cursor: pointer;
        }

        th,
        tbody {
            border-bottom: 3px solid #40513b;
        }
    </style>
</head>
<body>

<p>Dear {{ $user->name }},</p>
<br>
<p>Thankyou! for registering with Stickitownit</p>
<br>
<p>
    We would like to assure you that we are dedicated to providing you with a seamless shopping experience, and we will do our best to fulfill your order as quickly as possible. 
</p>
<br>
<p>
    Visit Stickitownit today and Try our new <a href="https://stickitownit.com/generation">AI Stickers Generator</a> and experience a new dimension of Sticker Designs ready to print.
</p>
<br>
<p>If you have any questions or require further assistance, please feel free to contact our customer support team at
    [+92 312 0416489]. Our representatives will be glad to assist you.</p>
<br>
<p>Kind regards,</p>
<h3>Stickitownit</h3>
<p>Phone: +92 312 0416489 <br>Email: <a href="mailto:info@stickitownit.com">info@stickitownit.com</a><br>https://stickitownit.com/
</p>


</body>
</html>
