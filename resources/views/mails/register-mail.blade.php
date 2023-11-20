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
<p>Your account register successfully</p>
<br>
<p>We would like to assure you that we are dedicated to providing you with a seamless shopping experience, and we will
    do our best to fulfill your order as quickly as possible. You can expect regular updates regarding the progress of
    your order.
</p>
<br>
<p>If you have any questions or require further assistance, please feel free to contact our customer support team at
    [+92 312 0416489]. Our representatives will be glad to assist you.</p>

<p>
    Once again, we appreciate your business and look forward to delivering your order to you soon. Thank you for
    choosing Stickitownit
</p>
<br>
<p>Best regards,</p>
<h3>Stickitownit</h3>
<p>Phone: +92 312 0416489 <br>Email: <a href="mailto:stickitownit@gmail.com">stickitownit@gmail.com</a><br>https://stickitownit.com/
</p>

</body>
</html>
