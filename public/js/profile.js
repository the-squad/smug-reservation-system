$(document).ready(function () {

    $("#update-profile-button").click(function () {
        var email = $('input[name="email"]').val();
        var address = $('input[name="address"]').val();
        var phoneNumber = $('input[name="phone-number"]').val();
        var password = $('input[name="password"]').val();
        var ConfirmPassword = $('input[name="confirm-password"]').val();

        $.post("?url=Profile/updateProfile", {
            email: email,
            address: address,
            phonenumber: phoneNumber,
            password: password,
            confirmpassword: ConfirmPassword
        }, function (data) {

            console.log(data);
            data = JSON.parse(data);

            $("#profile-alert").text("Account updated successfully");
            $("#profile-alert").removeClass("alert-danger").addClass("alert-success");

            if (data.email) {
                $("#profile-alert").text(data.email);
            } else if (data.address) {
                $("#profile-alert").text(data.address);
            } else if (data.phonenumber) {
                $("#profile-alert").text(data.phonenumber);
            } else if (data.password) {
                $("#profile-alert").text(data.password);
            } else if (data.conpassword) {
                $("#profile-alert").text(data.conpassword);
            }

            if (Object.keys(data).length > 0) {
                $("#profile-alert").removeClass("alert-success").addClass("alert-danger");
            }

            showNotification();
        });
    });

    $("#delete-message #confirm").click(function () {
        var password = $('#delete-message input[name="password"]').val();
        $.post("?url=Profile/deleteProfile", {
            password: password
        }, function (data) {
            if (data == "done") {
                $("#profile-alert").text("Account deleted successfully");
                $("#profile-alert").removeClass("alert-danger").addClass("alert-alert");
                window.location = "?url=home";
            } else {
                $("#profile-alert").text(data);
                $("#profile-alert").removeClass("alert-success").addClass("alert-danger");
            }
            showNotification();
        });
    });
});
