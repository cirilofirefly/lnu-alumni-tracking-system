<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/email-style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <style>
        .container {
            margin-top: 2%;
            vertical-align: center;
            background-color: white;
            box-shadow: 0 0 40px -10px rgba(0, 0, 0, 0.10);
            max-width: 90%;
        }

        .header {
            padding-top: 35px;
            padding-bottom: 5px;
            font-size: 25px;
            font-weight: bold;
            text-align: center;
        }

        .content {
            padding-bottom: 20px;
        }

        .content span {
            font-size: 15px;
            font-weight: 600;
            padding-left: 5%;
        }

        p {
            padding: auto;
            padding-left: 5%;
        }

        .btn-holder {
            text-align: center;
            padding-bottom: 30px;
        }

        .btn-holder a {
            padding: 8px;
            width: 300px;
            height: 50px;
            background-color: #1EBBA3;
            box-shadow: 0 5px 0 darkred;
            border-radius: 15px;
            color: white;
            position: relative;
            text-decoration: none;
        }

        .btn-holder a:hover {
            background-color: #1ba892;
        }

        .btn-holder a:active {
            box-shadow: none;
            top: 5px;
        }
    </style>
</head>


<body>
    <div class="container">
        <div class="header">
            Welcome to the AITS!
        </div>
        <div class="content">
            <br>
            <span> Hello, {{$email_data['first_name']}}!</span>
            <br><br>
            <p>
                Thank you for using our Alumni Information Tracking Sytem (AITS)! Your email has now been verified. <br>
                Click the button below to proceed the changing of your password
            </p>
        </div>
        <div class="btn-holder">
            <a href="http://localhost:8080/change-password">Reset Password</a>
        </div>

    </div>
</body>

</html>
