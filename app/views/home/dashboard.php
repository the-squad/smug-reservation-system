<html>

<head>
    <title>Dashboard</title>
    <!-- CSS FILES -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/table.css" rel="stylesheet" />

    <!--<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>-->
    <!-- TAB ICON -->
    <link href="images/logo-icon.png" rel="icon">

    <!-- JavaScript and jQuery files -->
     <?php
         /*
             If userType == 0, it means he is a user, he will be able to view
             reservation and delievry panes.

             In reservation pane he won't see phone number and email

             ---------------------------------------------------------------
             If userType == 1, it means he is an admin, he will be able to view
             - reservation pane
             - generate report pane
             - finicial sector pane
             - feedback pane
             - tables control pane

             In reservation pane he won't see:
             - Credit card fields
             - Confirm, update and delete buttons
         */
         $userType = $data['User_Type'];
    ?>
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/smug.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/reservation.js"></script>
    <script src="js/table-control.js"></script>
    <script src="js/user-role.js"></script>
    <script src="js/user-type.js"></script>
    <script src="js/generate-report.js"></script>
    <script src="js/orders.js"></script>
</head>

<body>
	<!-- Overflow black background -->
    <div class="background" onclick="closePopUpWindow(floatingCard);"></div>

    <!-- Header -->
    <div class="header">
        <div class="container col-12-xs col-9-md">
            <!-- Upper part -->
            <div class="upper-part">
                <!-- Logo -->
                <a href="index.php"><img class="logo" src="images/logo.png" /></a>

                <!-- Dropdown menu -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?= $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="?url=profile">Profile</a></li>
                        <?php if($userType == 1): ?>
                            <li><a href="?url=foodmenu">Food menu</a></li>
                        <?php endif; ?>
                        <li><a href="?url=home/logout">Log out</a></li>
                    </ul>
                </li>
            </div>

			<!-- INLCUDE NAV TABS -->
            <ul class="nav nav-tabs" role="tablist">
                <!-- Showing tabs depends on the userType -->
                <?php
                    //TABS
                    foreach ($data['tabs'] as $value) {
                        include'elements/tabs/' . $value;
                    }
                ?>
            </ul>
		</div>
	</div>

    <div class="tab-content">
        <!-- INCLUDE USER TABS -->
        <?php
            //PANES
            foreach ($data['tabs'] as $value) {
                include 'elements/panes/' . $value;
            }
          ?>
    </div>

    <!-- INCLUDE ALERT MESSAGE -->
    <?php require_once  'elements/delete-message.php' ?>
</body>
</html>
