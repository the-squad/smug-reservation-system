<!DOCTYPE html>

<html>

<head>
    <title>Profile Settings</title>

    <!-- CSS FILES -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">

    <!--<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>-->
    <!-- TAB ICON -->
    <link href="images/logo-icon.png" rel="icon">

    <!-- JavaScirpt FILES -->
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/smug.js"></script>
    <script src="js/profile.js"></script>
</head>

<body>
    <div class="background"></div>
    <!-- Header -->
    <div class="header" id="profile-header">
        <div class="container col-12-xs col-9-md">
            <!-- Upper part -->
            <div class="upper-part">
                <a href="index.html"><img class="logo" src="images/logo.png" /></a>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $data['profile']['name'] ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="?url=dashboard">Home</a></li>
                        <li><a href="?url=home/logout">Log out</a></li>
                    </ul>
                </li>
            </div>

            <!-- Nav tabs -->
            <label class="headline" id="header">Profile Settings</label>

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active text-center"><a href="#general" role="tab" data-toggle="tab">General</a></li>
                <li role="presentation" class="unactive text-center"><a href="#security" role="tab" data-toggle="tab">Security</a></li>
            </ul>

        </div>
    </div>

    <!-- Profile info starts -->
    <div class="profile-info">
        <label class="headline text-center">Welcome, <?= $data['profile']['name'] ?></label>

        <!-- Floating buttons starts -->
        <div class="hover-div first-button" id="update">
            <span class="text">Update</span>
            <div class="floating-button" id="update-profile-button"></div>
        </div>

        <div class="hover-div second-button" id="delete">
            <span class="text">Delete</span>
            <div class="floating-button" id="delete-profile-button"></div>
        </div>

        <div class="tab-content">
            <!-- General pane starts -->
            <div role="tabpanel" class="tab-pane active in" id="general">
                <form>
                    <div class="data-holder col-md-6 col-md-offset-3 col-xs-12">
                        <div class="input-layout">
                            <input type="text" name="email" value="<?= $data['profile']['email'] ?>">
                            <label>Email</label>
                        </div>

                        <div class="input-layout">
                            <input type="text" name="address" value="<?= $data['profile']['address'] ?>">
                            <label>Address</label>
                        </div>

                        <div class="input-layout">
                            <input type="text" name="phone-number" value="<?= $data['profile']['phone'] ?>">
                            <label>Phone Number</label>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Security pane starts -->
            <div role="tabpanel" class="tab-pane" id="security">
                <form>
                    <div class="data-holder  col-md-6 col-md-offset-3 col-xs-12">
                        <div class="input-layout">
                            <input type="password" name="password">
                            <label>Password</label>
                        </div>

                        <div class="input-layout">
                            <input type="password" name="confirm-password">
                            <label>Confirm Password</label>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <!-- Alert message starts -->
        <div class="alert alert-success alert-dismissible col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1 text-center" role="alert" id="profile-alert">
            <button type="button" class="close" id="profile-close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Done,</strong> Your account has been successfully updated
        </div>
        <!-- Alert message ends -->

    </div>
    <!-- Profile info ends -->

    <!-- Delete account confirmation starts -->
    <div class="floating-card alert-message col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1" id="delete-message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="delete-confirm-card-close">&times;</span></button>

        <h2 class="text-center">Are you sure that you want to delete your account?</h2>

        <div class="input-layout">
            <input type="password" name="password">
            <label>Password</label>
        </div>

        <button class="discard col-md-2 col-xs-2 col-md-offset-2 col-xs-offset-3">Cancel</button>

        <button class="filled button col-md-2 col-xs-2 col-md-offset-1 col-xs-offset-7" id="confirm">Delete</button>
    </div>
    <!-- Delete account confirmation ends -->

    <script>
        // Functions that hides the floating buttons and background
        $(".close, .alert-message .discard, .background").click(function() {
            hide(".alert");
            hide(".alert-message");
            hide(".background");
        })

        $(".floating-button").hover(function() {
            $(".hover-div .text").css("opacity","1");
            $("#delete-profile-button").css("opacity", "1")
        }, function() {
             $(".hover-div .text").css("opacity","0");
            $("#delete-profile-button").css("opacity", "0")
        })

        $("#delete-profile-button").click(function() {
            show("#delete-message");
            show(".background");
        })
    </script>

    <script></script>
</body>

</html>
