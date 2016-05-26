<!DCOTYPE html>
<?php $uesrType = 2?>
<html>

<head>
    <title>Welcome to SMUG</title>

    <!-- CSS FILES -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">

    <!-- TAB ICON -->
    <link href="images/logo-icon.png" rel="icon">

    <!-- JavaScript and jQuery files -->
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/smug.js"></script>
    <script src="js/index.js"></script>
</head>


<body id="index-page-body">
    <!-- Overflow black background -->
    <div class="background"></div>

    <!-- Home section -->
    <div class="home-section">
        <!-- Nav bar starts -->
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="images/logo.png" class="logo" id="index-page" /></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#reservations">Reservations</a></li>
                        <li><a href="#food-menu">Food menu</a></li>
                        <li><a href="#contact-us">Contact us</a></li>
                        <li><a id="login-button" class="outline" onclick="showLoginCard();">Login</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <!-- Welcome text starts -->
        <h1 class="col-md-8 col-md-offset-2 text-center" id="welcome-text">WELCOME TO SMUG</h1>
        <p class="col-md-8 col-md-offset-2 text-center" id="welcome-paragraph"> Given the freedom to dream up the best in innovative food, beverage, service, ambiance and architecture, the Enjaz team has found profound success in developing restaurants that our customers and our community have wholeheartedly embraced</p>
        <a class="col-lr-4 col-lr-offset-4 col-md-6 col-md-offset-3 text-center col-xs-8 col-xs-offset-2" id="sign-up-button" onclick="showSignUpCard();">Create account to order food online</a>

        <!-- INCLUDE FORMS -->
        <?php
            require_once'elements/forms/login-form.php';
            require_once'elements/forms/sign-up-form.php';
         ?>
    </div>

    <!--
    <div class="reservation-section">
        <?php //require_once'elements/forms/reservation-form.php' ?>
    </div>-->

    <!-- Food menu section -->
    <div class="food-menu-section" id="food-menu">
        <label class="text-center headline">Check our food menu</label>

        <div class="food-card col-sm-3 col-xs-12 first" id="big-mac-card">
            <div class="image-edit">
                <p class="text-center col-xs-10 col-xs-offset-1">The Beautful peace of meat, The Beautful peace of meat,The Beautful peace of meat,The Beautful peace of meat,The Beautful peace of</p>
                <h1 class="text-center">burger</h1>
            </div>
        </div>
        <div class="food-card col-sm-3 col-xs-12" id="pizza-card">
            <div class="image-edit">
                <p class="text-center col-xs-10 col-xs-offset-1">The Beautful peace of meat, The Beautful peace of meat,The Beautful peace of meat,The Beautful peace of meat,The Beautful peace of</p>
                <h1 class="text-center">Pizza</h1>
            </div>
        </div>
        <div class="food-card col-sm-3 col-xs-12" id="chicken-macdo-card">
            <div class="image-edit">
                <p class="text-center col-xs-10 col-xs-offset-1">The Beautful peace of meat, The Beautful peace of meat,The Beautful peace of meat,The Beautful peace of meat,The Beautful peace of</p>
                <h1 class="text-center">Chicken</h1>
            </div>
        </div>

        <a class="col-md-4 col-md-offset-4 text-center col-xs-8 col-xs-offset-2" id="food-menu-button" href="?url=foodmenu">See our food menu</a>
    </div>

    <!-- Contact us section starts -->
    <div class="contact-us-section" id="contact-us">
        <label class="text-center headline">Contact Us</label>

        <!-- Email starts -->
        <div class="email col-md-5 col-md-offset-1 col-xs-12">
            <form name="contact">
                <div class="input-layout first-input">
                    <input type="text" name="name">
                    <label>Name</label>
                </div>

                <div class="input-layout">
                    <input type="text" name="email">
                    <label>Email</label>
                </div>

                <div class="input-layout" id="message">
                    <textarea type="text" name="message" cols="6"></textarea>
                    <label>Message</label>
                </div>

                <input type="button" class="filled confirm-button col-md-4 col-xs-8 col-md-offset-4 col-xs-offset-2" id="send-email" value="Send">
            </form>
        </div>
        <!-- Email ends -->

        <!-- Maps starts -->
        <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
        <div class="map col-md-5 col-md-offset-6" style='overflow:hidden;'>
            <div id='gmap_canvas' style='height:440px;width:700px;'></div>
            <div><small><a href="http://embedgooglemaps.com">									embed google maps							</a></small></div>
            <div><small><a href="http://freedirectorysubmissionsites.com/">link directories</a></small></div>
            <style>
                #gmap_canvas img {
                    max-width: none!important;
                    background: none!important
                }
            </style>
        </div>
        <script type='text/javascript'>
            function init_map() {
                var myOptions = {
                    zoom: 15,
                    center: new google.maps.LatLng(30.0667048, 31.330634799999984),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                marker = new google.maps.Marker({
                    map: map,
                    position: new google.maps.LatLng(30.0667048, 31.330634799999984)
                });
                infowindow = new google.maps.InfoWindow({
                    content: '<strong>Smug International Restaurant</strong><br>Anwar Al Mofti<br>'
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map, marker);
                });
                infowindow.open(map, marker);
            }
            google.maps.event.addDomListener(window, 'load', init_map);
        </script>
        <!-- Maps ends -->

        <!-- Info starts -->
        <div class="info">
            <label class="text-center col-xs-12">All Copyrights reserved © smug 2015
</label>
            <div class="social-media col-xs-12 text-center">
                <a class="socicon-facebook" id="facebook" target="_blank" href="https://www.facebook.com/SmugInternational/"></a>
                <a class="socicon-twitter" id="twitter" target="_blank" href="https://twitter.com/SmugInternation"></a>
            </div>

        </div>
        <!-- info ends -->
    </div>
</body>

</html>
