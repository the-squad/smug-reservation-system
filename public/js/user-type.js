/*
    When a user selects a row it's background-color changes
*/

var uesrTypeRowID;
var selectOptions = "";
var editingStatus = "view";

function selectRow(rowId) {
    //Saving current rowID
    uesrTypeRowID = rowId;

    //Clearing any selected tab
    $(".table-row").css("background-color", "transparent");
    $(".table-row input").css("color", "black");
    $(".table-row select").css("color", "black");

    if (editingStatus == "view") {
        //Highlight selected tab
        $("#" + uesrTypeRowID).css("background-color", "#FF0053");
        $("#" + uesrTypeRowID + " input").css("color", "white");
        $("#" + uesrTypeRowID + " select").css("color", "white");
    }
}

//When creating a new user type
function createNewUserType() {
    //Clearing any selected tab
    $(".table-row").css("background-color", "transparent");
    $(".table-row input").css("color", "black");
    $(".table-row select").css("color", "black");

    //Changing to edit mode
    $("#" + uesrTypeRowID).removeClass("view").addClass("edit");

    //Creating a new row
    document.getElementById("u-t").innerHTML +=
    '<tr class="table-row view" onclick="selectRow(this.id);">' +
        '<td>' +
            '<input class="userTypeText" type="text" value="Manager" />' +
        '</td>' + selectOptions +
    '</tr>';

    //Hiding and showing buttons
    hide("#add-user-type-button");
    hide("#update-user-type-button");
    hide("#delete-user-type-button");
    show("#save-user-type-button");

    editingStatus = "create";
}

//Creating select options
function generateSelectOptions() {
    for (var counter = 1; counter <= 9; counter++) {
        selectOptions +=
        '<td>' +
            '<select class="userTypeSelector" tabID="' + counter + '">' +
                '<option selected="">No Access</option>' +
                '<option>View</option>' +
                '<option>Edit</option>' +
            '</select>' +
        '</td>';
    }
}

//Generating select options
generateSelectOptions();

//When updating user type
function updateUserType() {
    //Clearing any selected tab
    $(".table-row").css("background-color", "transparent");
    $(".table-row input").css("color", "black");
    $(".table-row select").css("color", "black");

    //Changing to edit mode
    $("#" + uesrTypeRowID).removeClass("view").addClass("edit");

    //Hiding and showing buttons
    hide("#add-user-type-button");
    hide("#update-user-type-button");
    hide("#delete-user-type-button");
    show("#save-user-type-button");

    editingStatus = "update";
}

function deleteUserType() {
    $("#" + uesrTypeRowID).remove();
}

function confirmUserType() {
    //Clearing any selected tab
    $(".table-row").css("background-color", "transparent");
    $(".table-row input").css("color", "black");
    $(".table-row select").css("color", "black");

    //Changing to edit mode
    $("#" + uesrTypeRowID).removeClass("edit").addClass("view");

    //Hiding and showing buttons
    show("#add-user-type-button");
    show("#update-user-type-button");
    show("#delete-user-type-button");
    hide("#save-user-type-button");

    editingStatus = "view";
}
