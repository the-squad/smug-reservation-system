/*
    Clears inputs' data
*/
function clearAccountData() {
    //Clearing card data
    $("#firstName").val("");
    $("#lastName").val("");
    $("#emailTEXT").val("");
    $("#address").val("");
    $("#phoneNumber").val("");
    $("#account-type-select").val("");
}

var accountData;
var accountRowId;

/*
    Taking account's data form the row and pass it the pop-up card
*/
function fillAccountData(rowData, rowId) {
    //Scrolling to the top of the card
    $("#accounts-type-card").scrollTop(0);

    accountRowId = rowId;

    //Clearing data
    clearAccountData();

    //Taking innerHTML as an array
    accountData = rowData.getElementsByTagName('td');

    //Filling card data
    $("#firstName").val(accountData[0].innerHTML);
    $("#lastName").val(accountData[1].innerHTML);
    $("#emailTEXT").val(accountData[2].innerHTML);
    $("#address").val(accountData[3].innerHTML);
    $("#phoneNumber").val(accountData[4].innerHTML);
    $("#account-type-select").val(accountData[5].innerHTML);

    //Changing card's headline and button text
    $("#accounts-type-card h2").text("Account Details");
    $("#confirmAccount").text("Confirm");

    //Hiding passwords' fields and confirm button
    hide("#password-div");
    hide("#password-confirm-div");
    hide("#confirmAccount");

    show("#updateAccount");
    show("#deleteAccount");

    //Making fields view only mode
    $("#accounts-type-card div").removeClass("edit").addClass("view");

    //Making cancel message works for accounts
    $("#reservation-cancel-message .button").attr("id", "confirmAccountDeleteButton");
    $("#reservation-cancel-message .button").attr("onclick", "deleteConfirmAccount();");

    //Showing the card and background
    show("#accounts-type-card");
    show(background);
}

/*
    Showing the account card to create a new account
*/
function createAccount() {
    //Scrolling to the top of the card
    $("#accounts-type-card").scrollTop(0);

    //Clearing data
    clearAccountData();

    //Changing card's headline and button text
    $("#accounts-type-card h2").text("Create a new account");
    $("#confirmAccount").text("Create");

    //Showing the pop-card and background and hiding update and delete button and showing create button
    show("#accounts-type-card");
    show(background);
    hide("#updateAccount");
    hide("#deleteAccount");
    show("#confirmAccount");

    //Making fields edit mode
    $("#accounts-type-card div").removeClass("view").addClass("edit");
}

/*
    Changing mode to edit and hiding some buttons when the manager updates an account
*/
function updateAccount() {
    //Scrolling to the top of the card
    $("#accounts-type-card").scrollTop(0);

    //Controlling buttonshide("#updateAccount");
    hide("#deleteAccount");
    hide("#updateAccount");
    show("#confirmAccount");

    //Making fields edit mode
    $("#accounts-type-card div").removeClass("view").addClass("edit");
}

/*
    When creating a new account => a new row will be added to the table
    and when updating it it will bu updated
*/
function createUpdateAccount() {
    if ($("#confirmAccount").text() == "Create") {
        document.getElementById("a-t-b").innerHTML +=
        '<tr class="table-row" id="a1" onclick="fillAccountData(this, this.id);">' +
            '<td>' + $("#firstName").val() + '</td>' +
            '<td>' + $("#lastName").val() + '</td>' +
            '<td>' + $("#emailTEXT").val() + '</td>' +
            '<td>' + $("#address").val() + '</td>' +
            '<td>' + $("#phoneNumber").val() + '</td>' +
            '<td>' + $("#account-type-select").val() + '</td>' +
        '</tr>';
    } else {
        //Filling card data
        accountData[0].innerHTML = $("#firstName").val();
        accountData[1].innerHTML = $("#lastName").val();
        accountData[2].innerHTML = $("#emailTEXT").val();
        accountData[3].innerHTML = $("#address").val();
        accountData[4].innerHTML = $("#phoneNumber").val();
        accountData[5].innerHTML = $("#account-type-select").val();
    }

    //Poping a notifications
    showNotification();

    //Closing the windows and background
    hide("#accounts-type-card");
    hide(background);
}

/*
    When deleting an account a pop-up will come our to confirm
*/
function deleteAccount() {
    //Hiding the pop-up card and showing deleting message
    hide("#accounts-type-card");
    show("#reservation-cancel-message");
}

function deleteConfirmAccount() {
    $("#" + accountRowId).remove();
    hide("#reservation-cancel-message");
}
