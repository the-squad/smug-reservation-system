//Elements ids
var reservationButon = "make-reservation-button";
var delievryButton = "make-delivery-button";

var reserationCard = "#reservation-card";
var loginCard = "#login-card";
var signUpCard = "#sign-up-card";
var alertMessage = ".alert-message";
var background = ".background";
var confirmButton = "#confirm";
var deleteButton = "#delete";
var updateButton = "#update";
var floatingCard = ".floating-card";

var reservationStatus = "create";
var errorMessagesCounter = 1; //Used only on login card. To know more see line 50

var X;
var Y;

//Changes an element's id
function changeID(elementID, newID) {
    document.getElementById(elementID).id = newID;
}

//Shows up notifications pop-up and hide it after 3 seconds
function showNotification() {
    $(".alert").fadeIn('fast').delay(3000).fadeOut('slow');
}

//Closes the pop-up card
function closePopUpWindow(elementID) {
    $(".background").fadeOut();
    hide(elementID);
    hide(".error-message");

    //To prevent scrolling in login and sign card in the home page
    if (elementID == loginCard || elementID == signUpCard)
        $("body").css("overflow-y", "scroll");

    if (elementID == signUpCard) {
        //When showing first name message there is a bug in the design
        $("#last-name-div").css("margin-top", "-40px");
        $("#last-name-div").css("margin-bottom", "0px");
    }

    $("#hour-div").css("margin-top", "-40px");
    $("#hour-div").css("margin-bottom", "0px");
    $("#chairs-div").css("margin-top", "-40px");
    $("#chairs-div").css("margin-bottom", "0px");
}

//Show an element
function show(elementID) {
    //Taking the reservation card to the top of it
    $(floatingCard).scrollTop(0);
    $(elementID).fadeIn();

    //When showing cvc error message there is a bug in the design
    if (elementID == "#cvc-error-message") {
        $("#expire-date-div").css("margin-top", "-80px");
        $("#expire-date-div").css("margin-bottom", "20px");
    }

    //When showing first name message there is a bug in the design
    if (elementID == "#first-name-error-message") {
        $("#last-name-div").css("margin-top", "-80px");
        $("#last-name-div").css("margin-bottom", "80px");
    }

    //When showing last name message there is a bug in the design
    if (elementID == "#last-name-error-message") {
        $("#last-name-div").css("margin-bottom", "0px");
    }

    //When showing date message there is a bug in the design
    if (elementID == "#date-error-message") {
        $("#hour-div").css("margin-top", "-80px");
        $("#hour-div").css("margin-bottom", "80px");
    }

    //When showing hour message there is a bug in the design
    if (elementID == "#hour-error-message") {
        $("#duration-div").css("margin-bottom", "0px");
    }

    //When showing duation message there is a bug in the design
    if (elementID == "#duration-error-message") {
        $("#chairs-div").css("margin-top", "-80px");
        $("#chairs-div").css("margin-bottom", "80px");
    }
}

//Hide an element
function hide(elementID) {
    $(elementID).css("display", "none");

    //When showing cvc error message there is a bug in the design
    if (elementID == "#cvc-error-message") {
        $("#expire-date-div").css("margin-top", "-40px");
        $("#expire-date-div").css("margin-bottom", "0px");
    }

    //When showing first name message there is a bug in the design
    if (elementID == "#first-name-error-message") {
        $("#last-name-div").css("margin-top", "-40px");
        $("#last-name-div").css("margin-bottom", "0px");
    }

    //When showing last name message there is a bug in the design
    if (elementID == "#last-name-error-message") {
        $("#last-name-div").css("margin-bottom", "0px");
    }

    //When showing date message there is a bug in the design
    if (elementID == "#date-error-message") {
        $("#hour-div").css("margin-top", "-40px");
        $("#hour-div").css("margin-bottom", "0px");
    }

    //When showing hour message there is a bug in the design
    if (elementID == "#hour-error-message") {
        $("#duration-div").css("margin-bottom", "0px");
    }

    //When showing duation message there is a bug in the design
    if (elementID == "#duration-error-message") {
        $("#chairs-div").css("margin-top", "-40px");
        $("#chairs-div").css("margin-bottom", "0px");
    }
}

//Shows the login form
function showLoginCard() {
    $("body").scrollTop(0);
    show("#login-card");
    show(background);
    $("body").css("overflow-y", "hidden");
}

//Shows the sign up form
function showSignUpCard() {
    $("body").scrollTop(0);
    show("#sign-up-card");
    show(background);
    $("body").css("overflow-y", "hidden");
}

$(document).ready(function () {
    //Activating first tab and pane
    $(".nav-tabs li").first().addClass("active").removeClass("unactive");
    $(".tab-content div").first().addClass("active").removeClass("unactive");
});
