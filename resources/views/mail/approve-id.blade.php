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
    </style>
</head>


<body>
    <div class="container">
        <div class="header">
            Welcome to the AITS!
        </div>

        <!-- <div class="icon_holder">
      <img src="https://scontent.fmnl3-1.fna.fbcdn.net/v/t1.15752-9/242073874_964597084401819_5700118900656490741_n.jpg?_nc_cat=108&ccb=1-5&_nc_sid=ae9488&_nc_eui2=AeGqLSrgLqquTnKylPRPczZUnGYNEcZcuRWcZg0Rxly5FdjpGMw57s2hHCqS_5hj6hC5COthDy8yRamernP9Gs3z&_nc_ohc=yEX14Zxv42UAX_No80B&tn=Yw_-fhFkNqMU5V5z&_nc_ht=scontent.fmnl3-1.fna&oh=ca51e27cfa92d509edbdae9af57dcc88&oe=6182F3D9">
    </div> -->

        <div class="content">
            <br>
            <span> Hello, {{$email_data['first_name']}}!</span>
            <br><br>
            <p>
                Your request for an Alumni ID has been approved. Please wait for the announcement of printing and handing out of your Alumni ID.
            </p>
        </div>

    </div>
</body>

</html>
