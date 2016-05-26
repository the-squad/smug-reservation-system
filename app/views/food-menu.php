<!DOCTYPE html>

<html>

<head>
    <title>Food Menu</title>

    <!-- CSS FILES -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/food-menu.css" rel="stylesheet">

    <!-- TAB ICON -->
    <link href="images/logo-icon.png" rel="icon">

    <!-- JavaScript FILES -->
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/smug.js"></script>
    <script src="js/foodmenu.js"></script>
    <script src="js/payment.js"></script>
    <?php
        /*
            0 => Memeber
            1=> Admin
            2 => Visitor
        */
        $foodMenuUserType = $data['User_Type'];
    ?>
</head>

<body>
    <!-- Overflow black background -->
    <div class="background" onclick="closePopUpWindow(floatingCard);"></div>

    <!-- Header -->
    <div class="header" id="food-menu-header">
        <div class="container col-12-xs col-9-md">
            <!-- Upper part -->
            <div class="upper-part">
                <!-- Logo -->
                <a href="index.php"><img class="logo" src="images/logo.png" /></a>

                <!-- Search bar -->
                <div class="search col-md-8 col-md-offset-1">
                    <span class="glyphicon glyphicon-search icon" aria-hidden="true"></span>
                    <input type="text" placeholder="Search" onkeyup="searchFood(this.value)">
                </div>

                <?php
                    if ($foodMenuUserType == 0 || $foodMenuUserType == 1)
                        echo '<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'. $_SESSION['first_name'] . " " . $_SESSION['last_name'] .'<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="?url=dashboard">Home</a></li>
                                <li><a href="?url=home/logout">Log out</a></li>
                            </ul>
                        </li>';
                ?>
            </div>

            <!-- Nav Tabs -->
            <div class="main-header">
                <label class="headline" id="header">Food menu</label>

                <div class="down-part">
                    <!-- Loading food tabs from the database -->
                    <ul class="nav nav-tabs" role="tablist">
                        <?php $active = TRUE;foreach ($data['food'] as $key => $value):?>
                            <li role="presentation" class="<?php if($active){echo "active"; $active = FALSE;}else echo "unactive";?> text-center"><a href="#P<?=$value['id']?>" id="T<?=$value['id']?>" role="tab" data-toggle="tab" onclick="currentActiveTab(this.id);"><?=$key?></a></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating button -->
    <div class="floating-button" id="make-order-button" onclick="showInvoice();">
        <?php if ($foodMenuUserType == 0): ?>
            <!-- Items counter shows up to users -->
            <span id="items-number"></span>
        <?php endif; ?>
    </div>

    <?php if ($foodMenuUserType == 1): ?>
        <script>
            //When the userType == admin, floating button's id will change
            $("#make-order-button").attr("id","add-food-item");
            $("#add-food-item").attr("onclick","addFoodItem()");
        </script>
    <?php endif; ?>

    <!-- INCLUDE FOOD ITEM CARD -->

    <?php
    $VIEW = dirname(__DIR__) .'/views/home/';
    //echo $VIEW;
        require_once $VIEW.'elements/forms/food-item.php';

        //Only require the invoice card when the user type == 0 (Member)
        if ($foodMenuUserType == 0)
            require_once $VIEW.'elements/invoice.php';
        elseif ($foodMenuUserType == 1)
            require_once $VIEW.'elements/delete-message.php';
     ?>

    <!-- Food menu -->

    <div class="tab-content">
        <!-- Reading food catagories from the database -->
        <?php $active = TRUE;foreach ($data['food'] as $key => $value):?>
        <div role="tabpanel" class="tab-pane <?php if($active){echo "active"; $active = FALSE;}else echo "unactive";?> in" id="P<?=$value['id']?>">
            <!-- Reading food items inside this category -->
            <?php foreach ($value['food'] as $foodData):?>
                <!-- Food card -->
                <div class="food-card col-lg-4 col-md-5 col-sm-8 col-md-offset-1 col-sm-offset-2 col-xs-12" id="f<?=$foodData['id']?>" onclick="fillFoodItemCard(this, this.id);">
                    <div class="image" style="background-image:url(<?=$foodData['picture']?>)"></div>
                    <div class="shape">
                        <!-- Info -->
                        <h1 class="name"><?=$foodData['name']?></h1>
                        <p class="description"><?=$foodData['description']?></p>

                        <!-- Food Rate-->
                        <div class="stars">
                            <?php for ($i=0; $i < $foodData['rate']; $i++): ?>
                                <span class="glyphicon glyphicon-star star" aria-hidden="true"></span>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="price">
                        <span class="number"><?=$foodData['price']?></span>
                        <span class="currency">L.E</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Alert message starts -->
	<div class="alert alert-success alert-dismissible col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1 text-center" role="alert" id="reservation-alert">
		<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Done,</strong> Food item has been added/updated
	</div>
</body>

</html>
