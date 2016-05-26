/*
    Ajax funtion
*/
$(document).ready(function () {
    /*
        When deleting a reservation
    */
    $("#Confirm-button").click(function () {
        //Sending the reservation id the deleteReservations by $_POST method
        $.post("?url=reservationController/deleteReservations", { id: rowID });

        //Hiding the message and the background
        hide(alertMessage);
        hide(background);

        //Deleting the reservation row from the HTML page
        $("#" + rowID).remove();

        //When there is no reservation the table will be hidden and show the empty message
        if (!$.trim($('#reservations-table #r-t-b').html())) {
            hide("#reservations-table");
            show("#empty-reservation-message");
        }
    });

    /*
        When checking on a table, then it will calculate the total chairs and
        print it into chairs number firld
    */
    $(".table-box").change(function () {
        var chairs_count = 0; //Chairs number variable

        //Check only checled tables
        $(".table-box:checked").each(function () {
            var id = $(this).parent().attr('id'); //Getting checked tables' id
            //Converting id's to integer
            chairs_count += parseInt($("#" + id + " #seats").text());
        });

        //Changing the value of chairs number field
        $("#chairs-number-text").val(chairs_count);
    });

    /*
        Showing reservation history
    */
    $("#Historybo").click(function () {
        var value = $("#Historybo").text(); //Taking the button text to control what happens

        if (value == "Show History")
            $("#Historybo").text("Hide History"); //Changing button text
        else
            $("#Historybo").text("Show History"); //Changing button text

        //Sending reservation status to showReservations method
        $.post("?url=reservationController/showReservations", { status: value },
        function (data, status) {
            //Reciecing an array of errors
            data = JSON.parse(data);

            //Clearing table's rows
            document.getElementById("r-t-b").innerHTML = "";

            /*
                If their is no reservation the table will ne hidden and emepty message
                will show instead
            */
            if (data.length == 0) {
                //Changing the empty message content
                if (value == "Show History")
                    document.getElementById("empty-reservation-message").innerHTML = "You don't have history";
                else
                    document.getElementById("empty-reservation-message").innerHTML = "You don't have any reservations";

                //Hiding the table and showing the message
                hide("#reservations-table");
                show("#empty-reservation-message");
            } else {
                //Hiding the message and showing the table
                hide("#empty-reservation-message");
                show("#reservations-table");

                //Printing reservation details in the screen
                for (var i = 0; i < data.length; i++) {
                    var moreOptions = "";

                    //When hiding the history
                    if (value == "Hide History")
                        moreOptions = 'onclick="fillReservationData(this, this.id)" id="r' + data[i].id + '"';

                    //Printing rows
                    document.getElementById("r-t-b").innerHTML += '<tr class="table-row" ' + moreOptions + '>' +
                            '<td>' + data[i].date + '</td>' +
                            '<td>' + data[i].time + '</td>' +
                            '<td>' + data[i].duration + '</td>' +
                            '<td>' + data[i].chairs_number + '</td>' +
                            '<td style="display:none">' + data[i].tables + '</td>' +
                            '</tr>';
                }
            }
        }
        );
    });

    /*
        When creating or updating reservation
    */
    $("#confirm").click(function() {
        //Getting button's text to decide what operation to do
        var value = $("#confirm").text();

        //Clearin fields' value
        var date = $("#day-text").val();
        var hour = $("#hour-text").val();
        var duration = $("#duration-text").val();

        //An array of selected tables
        var table = [];
        var tableID = [];

        //Taking tables number from checked tables
        $('#user-view :checked').each(function () {
            table.push($(this).attr("table-number"));
            tableID.push($(this).attr("id").replace("t", ""));
        });

        //Hiding all error messages
        hide(".error-message");
        hide("#date-error-message");
        hide("#hour-error-message");
        hide("#duration-error-message");

        //When the button text is "Create"
        if (value == "Create") {
            $.post("?url=reservationController/reservationOperation/Create", {
                date: date,
                hour: hour,
                duration: duration,
                checklist: JSON.stringify(table)
            }, function (data, status) {
                //Reciecing an array of errors
                console.log(data);
                data = JSON.parse(data);

                //This funtion checks every input for validaton
                validateReservation(data);

                /*
                    When there is no errors, resrvatain's id will be returned to
                    create a new row in the reservations table
                */
                if (data.id) {
                    //Hiding reservation card and the background
                    hide(reserationCard);
                    hide(background);

                    //Hiding the empty message and showing the table
                    hide("#empty-reservation-message")
                    show("#reservations-table");

                    document.getElementById('r-t-b').innerHTML +=
                    "<tr class='table-row' onclick='fillReservationData(this, this.id)' id='r" + data.id + "'>" +
                        "<td>" + $("#day-text").val() + "</td>" +
                        "<td>" + to12Hour($("#hour-text").val()) + "</td>" +
                        "<td>" + $("#duration-text").val() + "</td>" +
                        "<td>" + $("#chairs-number-text").val() + "</td>" +
                        "<td style='display:none'>" + JSON.stringify(tableID) + "</td>" +
                    "</tr>";

                    console.log(JSON.stringify(tableID));

                    //Showing notifications
                    showNotification();
                }
            }
            );
        }
        //When button's text is "Confirm"
        else {
            $.post("?url=reservationController/reservationOperation/Confirm", {
                date: date,
                hour: hour,
                duration: duration,
                checklist: JSON.stringify(table),
                id: rowID
            },
            function (result, status) {
                //Reciecing an array of errors
                result = JSON.parse(result);

                //This funtion checks every input for validaton
                validateReservation(result);

                //When all inputs data are true
                if (Object.keys(result).length == 0) {
                    //Hiding reservation card and background
                    hide(reserationCard);
                    hide(background);

                    //Hiding confirm button and showing update and delete buttons
                    hide(confirmButton);
                    show(deleteButton);
                    show(updateButton);

                    //Updaing row data from the pop-windws
                    data[0].innerHTML = $("#day-text").val();
                    data[1].innerHTML = to12Hour($("#hour-text").val());
                    data[2].innerHTML = $("#duration-text").val();
                    data[3].innerHTML = $("#chairs-number-text").val();

                    //Changing inputs from edit mode to view mode
                    $("form div").removeClass("edit").addClass("view");

                    //Showing notifications
                    showNotification();
                }
            }
            );
        }
    });
});

/*
    Checks for inputs validation
 */
function validateReservation(data) {
    //Checking date input if it's empty or not
    if (data.date) {
        show("#date-error-message");
        document.getElementById("date-error-message").innerHTML = data.date;
    }
    //Checking time input if it's empty or not
    if (data.time) {
        show("#hour-error-message");
        document.getElementById("hour-error-message").innerHTML = data.time;
    }
    //Checking duration input if it's empty or not and validate it
    if (data.duration) {
        show("#duration-error-message");
        document.getElementById("duration-error-message").innerHTML = data.duration;
    }
    //Checking if the user selected tables ir not
    if (data.tables) {
        $("#tables-error-message").css("display", "block");
        document.getElementById("tables-error-message").innerHTML = data.tables;
    }
}

/*
    Checking tables it they are reserved or not
*/
function checkTables() {
    //Taking inputs value
    var date = $("#day-text").val();
    var hour = $("#hour-text").val();
    var duration = $("#duration-text").val();

    //Sending values to checkReservations method
    $.post("?url=reservationController/checkReservations", {
        date: date,
        hour: hour,
        duration: duration
    },
    function (data, status) {
        //Reciecing an array of errors
        console.log(data);
        data = JSON.parse(data);

        //Variable just ot hold this text
        var tables = document.getElementsByClassName("table-info");

        //Checking every table
        for (var i = 0; i < tables.length; i++) {
            //Changing tables to it's default status
            $("#" + tables[i].id).removeClass("unaviable-table").addClass("existing-table");
            $("#" + tables[i].getElementsByTagName('input')[0].id).attr("disabled", false);

            //Checks reserved tables
            for (var j = 0; j < data.length; j++) {
                //If the table in the array (check above)
                if (tables[i].getElementsByTagName('input')[0].getAttribute('table-number') == data[j].table_number) {
                    //Making tables disabled
                    $("#" + tables[i].id + " input").attr("checked", false);
                    //tables[i].className = "table-info unaviable-table";
                    $("#" + tables[i].id).removeClass("existing-table").addClass("unaviable-table");
                    $("#" + tables[i].getElementsByTagName('input')[0].id).attr("disabled", true);
                }
            }
        }
    });
}

//Clear all inputs fields
function clearData() {
    $("#name-text").val("");
    $("#email-text").val("");
    $("#phone-number-text").val("");
    $("#day-text").val("");
    $("#hour-text").val("");
    $("#hour-text").attr("placeholder", "HH:MM");
    $("#duration-text").val("");
    $("#chairs-number-text").val("");
}

var rowID; //Saves the selected row's id
var data; //Saves row's data
var tablesNumber; //Takes reservaed talbes' bumber from the table
var tablesCounter;

//Fill reservation card fields with row data
function fillReservationData(rowData, rowId) {
    //Heading to the top of the card
    $("#reservation-card").scrollTop(0);

    //Getting all data in the table row in an array
    data = rowData.getElementsByTagName('td');
    rowID = rowId;

    //Changing inputs classes
    $("#reservation-card div").removeClass("edit").addClass("view");

    try {
        $("#name-text").val(data[0].innerHTML);
        $("#phone-number-text").val(data[1].innerHTML);
        $("#email-text").val(data[2].innerHTML);
        $("#day-text").val(data[3].innerHTML);
        $("#hour-text").val(to24Hour(data[4].innerHTML));
        $("#duration-text").val(data[5].innerHTML);
        $("#chairs-number-text").val(data[6].innerHTML);
    } catch (err) {
        $("#day-text").val(data[0].innerHTML);
        $("#hour-text").val(to24Hour(data[1].innerHTML));
        $("#duration-text").val(data[2].innerHTML);
        $("#chairs-number-text").val(data[3].innerHTML);
    }

    //Showing the background and reservation card
    $(".background").fadeIn();
    $("#reservation-card").fadeIn();

    //Making cancel message works for accounts
    $("#reservation-cancel-message .button").attr("id", "confirm-button");
    $("#reservation-cancel-message .button").removeAttr("onlclick");

    //Changing headline text
    document.getElementById("card-headline").textContent = "Reservation Details";

    //Hiding confirm and tables view
    hide(confirmButton);

    //Getting tables' id from the table
    try {
        tablesNumber = JSON.parse(data[4].innerHTML);
    } catch (err) {
        tablesNumber = JSON.parse(data[7].innerHTML);
    }

    $(".table-info input").attr("disabled", true);
    $(".table-info input").attr("checked", false);
    for (tablesCounter = 0; tablesCounter < tablesNumber.length; tablesCounter++)
        $("#t" + tablesNumber[tablesCounter]).attr("checked", true);

    console.log(tablesNumber);
    //Showing delete and update buttons
    show(deleteButton);
    show(updateButton);

    //Making all tables selecable and clear the checkboxes
    $(".table-info").removeClass("unaviable-table").addClass("existing-table");
}

/*
	- Reservation card will pop-up
	- Inputs will be editable
	- Confirm button only will shows up
	- Headline text will change
*/
function makeReservation() {
    //Heading to the top of the card
    $("#reservation-card").scrollTop(0);

    //Clear inputs data
    clearData();

    //Hiding delete and update buttons
    hide(deleteButton);
    hide(updateButton);

    //Shows the reservation card, background, confirm button and tables view
    show(reserationCard);
    show(background);
    show(confirmButton);

    //Changing headline text and button's text
    document.getElementById("card-headline").textContent = "Make a Reservation";
    $("#confirm").text('Create');

    //Changing inputs classes
    $("#reservation-card div").removeClass("view").addClass("edit");

    //Making all tables selecable and clear the checkboxes
    $(".table-info").removeClass("unaviable-table").addClass("existing-table");
    $(".table-info input").attr("disabled", false);
    $(".table-info input").attr("checked", false);
}

//Shows the alert message
function deleteReservation() {
    //Showing the alert message and hiding the reservation card
    show("#reservation-cancel-message");
    hide(reserationCard);
    $(".alert-message").css("height", "200px");
}

//Closing the alert message
function discard() {
    //Hiding the alert message and showing back the reservation card or food card
    hide(alertMessage);
    show(reserationCard);
    show("#food-item-card");
    show("#accounts-type-card");
}

//Controls what update button will do
function updateReservation() {
    //Heading to the top of the card
    $("#reservation-card").scrollTop(0);

    //Changing headline text
    document.getElementById("card-headline").textContent = "Update Reservation Details";
    $("#confirm").text('Confirm');

    //Changing inputs classes
    $("#reservation-card div").removeClass("view").addClass("edit");

    //Hiding delete and update buttons
    hide(deleteButton);
    hide(updateButton);

    //Show the confirm button and tables view
    show(confirmButton);

    //Getting tables' id from the table
    try {
        tablesNumber = JSON.parse(data[4].innerHTML);
    } catch (err) {
        tablesNumber = JSON.parse(data[7].innerHTML);
    }

    $(".table-info input").attr("disabled", false);
    $(".table-info input").attr("checked", false);
    for (tablesCounter = 0; tablesCounter < tablesNumber.length; tablesCounter++)
        $("#t" + tablesNumber[tablesCounter]).attr("checked", true);
}

//Add zero in the left
function addZero(number) {
   return (number < 10 ? '0' : '') + number;
}

//Convert from 24 format to 12
function to12Hour(time) {
   var arr = time.split(":");
   var h = parseInt(arr[0]);
   var PM = h > 12;
   return addZero((h%12)) + ":" + arr[1] + " " + (PM ? "PM" : "AM");
}

//Convert from 12 format to 24
function to24Hour(time) {
   var h = parseInt(time.split(":")[0]);
   var m = parseInt(time.split(":")[1]);
   var PM = time.split(" ")[1] == "PM";
   return addZero((PM ? 12+h : h)) + ":" + addZero(m);
}
