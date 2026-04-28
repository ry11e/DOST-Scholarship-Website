<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AKSIS: Aklan Scholars' Information System</title>
    <link rel="icon" type="image/x-icon" href="assets/images/AKSIS Icon.ico">
    <link href="src/styles/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* The "Rio" Gradient */
        .rio-bg {
            background: linear-gradient(-225deg, #32f4e4 , #0783cb, #f54387);
            background-size: 400% 200%;
            /* 2. Attach the animation */
            animation: gradientShift 13s ease infinite;
            
            min-height: 100vh;
            color: white;
         
        }

        /* 3. Define the movement */
        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .navbar-brand img {
            height: 50px;
            /* Adjust logo size here */
        }

        .hero-section {
            padding-top: 100px;
        }

        .btn-outline-light:hover {
            color: #1aafff;
        }

        /* Define the "Floating" animation */
        @keyframes subtleBounce {
            0% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-7px); /* Moves up by 10 pixels */
            }
            100% {
                transform: translateY(0);
            }
        }

        /* Create a class to apply it */
        .floating-logo {
            animation: subtleBounce 5s ease-in-out infinite;
        }

        
    </style>
</head>

<body class="rio-bg">

    <div class="d-flex flex-coloumn align-items-center justify-content-center" style="min-height:100%;">
        <div class="hero-section container py-5">
            <div class="row align-items-center ">

                <div class="col-5  text-center">
                    <img src="assets/images/AKSIS.png"
                        alt="Site Logo"
                        class="img-fluid floating-logo"
                        style="max-width: 75%;">
                </div>

                <div class="col-7 d-flex flex-column justify-content-center text-center align-items-center">
                    <h1 class="display-2 fw-bold mb-2">AKSIS</h1>
                    <p class="lead fs-3 mb-4">
                        Aklan Scholars' Information System
                    </p>
                    <div class="d-flex gap-3">
                        <a href="login.php" class="btn btn-light btn-lg px-4 shadow floating-logo" >Start</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="vendors/scripts/bootstrap.min.js"></script>
</body>

</html>