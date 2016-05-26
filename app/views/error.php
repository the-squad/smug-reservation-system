<!DOCTYPE html>

<html>

<head>
    <title>Forget passwrod</title>

    <meta name="viewport" content="width=device-width">

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href="images/logo-icon.png" rel="icon">

    <script src="../js/jquery-1.12.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
</head>

<body><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div>
        <!-- Forget passowrd starts -->
        <div class="floating-card col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1" id="forget-password">
            <h2 class="text-center">Error</h2>

            <div class="input-layout">
                <?=$data['msg']?>
                <br>click <a href="?url=home/index">here</a> to go to home page.
            </div>

        </div>
    </div>
</body>
</html>