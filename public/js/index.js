$(document).ready(function () {
    $("#loginButton").click(function () {
        var email = $("#emailText").val();
        var password = $("#passwordText").val();

        //ِAdjusting login card height
        $("#login-card").css("height", "400px");
        $("#login-card").css("top", "50px");

        $.post("?url=home/login", {
            email: email,
            password: password
        },
        function (data, status) {
            //If email and password are both correct
            if (data == "true")
                window.location = "?url=dashboard";
            //If email is wrong, empty or not valid
            else if (data.search("Email") != -1) {
                show("#email-error-message");
                document.getElementById("email-error-message").innerHTML = data;

                //ِAdjusting login card height
                $("#login-card").css("height", "450px");
                $("#login-card").css("top", "30px");

                hide("#password-error-message");
            }
            //If email is wrong, empty or not valid
            else if (data.search("Password") != -1) {
                show("#password-error-message");
                document.getElementById("password-error-message").innerHTML = data;

                //ِAdjusting login card height
                $("#login-card").css("height", "450px");
                $("#login-card").css("top", "30px");

                hide("#email-error-message");
            }
        });
    });

    /*
     When the user sign up
     */
    $("#signUpButton").click(function () {
        var firstname = $("#firstName").val();
        var lastName = $("#lastName").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var passwordconfirm = $("#passwordConfirm").val();
        var address = $("#address").val();
        var phoneNumber = $("#phoneNumber").val();

        hide(".error-message");
        hide("#first-name-error-message");
        hide("#first-name-error-message");
        /*check hide */

        $.post("?url=home/register", {
            firstname: firstname,
            lastname: lastName,
            email: email,
            password: password,
            confirmpassword: passwordconfirm,
            address: address,
            phonenumber: phoneNumber
        },
        function (data, status) {
            var errors = JSON.parse(data);
            if (Object.keys(errors).length > 0) {
                if (errors['fname']) {
                    show("#first-name-error-message");
                    //document.getElementById("email-error-message").innerHTML = data;
                    $("#first-name-error-message").html(errors['fname']);
                }
                if (errors['lname']) {
                    show("#last-name-error-message");
                    $("#last-name-error-message").html(errors['lname']);
                }
                if (errors['email']) {
                    show("#email-error-message-1");
                    $("#email-error-message-1").html(errors['email']);
                }
                if (errors['password']) {
                    show("#password-error-message-1");
                    $("#password-error-message-1").html(errors['password']);
                }
                if (errors['conpassword']) {
                    show("#password-confirm-error-message");
                    $("#password-confirm-error-message").html(errors['conpassword']);
                }
                if (errors['address']) {
                    show("#address-error-message");
                    $("#address-error-message").html(errors['address']);
                }
                if (errors['phonenumber']) {
                    show("#phone-number-error-message");
                    $("#phone-number-error-message").html(errors['phonenumber']);
                }
            } else {
                window.location = "?url=dashboard";
            }
        });
    });
});
