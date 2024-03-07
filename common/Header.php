<!DOCTYPE html>
<html lang="en" style="position: relative; min-height: 100%;">

    <head>
        <title>Online Course Registration</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
            html,
            body {
                height: 100%;
            }

            body {
                display: flex;
                flex-direction: column;
            }

            #wrapper {
                flex: 1;
            }

            #footer {
                margin-top: auto; /* Push the footer to the bottom */
            }
        </style>
    </head>

    <body class="d-flex flex-column">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
            <div class="container">
                <a class="navbar-brand" href="http://www.algonquincollege.com">
                    <img src="Common/img/AC.png" alt="Algonquin College" style="max-width:100%; max-height:100%;" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="Index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="UserInfo.php">User Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Login.php">Log in / Log out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>