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
    <title>Rio Landing Page</title>
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
            background: #f83600;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #95334c, #1b89c8);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #56ede0, #02598b);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            min-height: 100vh;
            color: white;
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
    </style>
</head>

<body class="rio-bg">

    <div class="d-flex flex-coloumn align-items-center justify-content-center" style="min-height:100%;">
        <div class="hero-section container py-5">
            <div class="row align-items-center ">

                <div class="col-5  text-center">
                    <img src="assets/images/AKSIS.png"
                        alt="Site Logo"
                        class="img-fluid"
                        style="max-width: 75%;">
                </div>

                <div class="col-7 d-flex flex-column justify-content-center text-center align-items-center">
                    <h1 class="display-2 fw-bold mb-2">AKSIS</h1>
                    <p class="lead fs-3 mb-4">
                        Aklan Scholars' Information System
                    </p>
                    <div class="d-flex gap-3">
                        <a href="login.php" class="btn btn-light btn-lg px-4 shadow" >Start</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="vendors/scripts/bootstrap.min.js"></script>
</body>

</html>