//Shows table form
var editingStatus = "View";

//Variables that hold the table position
var X;
var Y;
var tableID = 0;

/*
 Ajax funtion
 */
$(document).ready(function () {
    /*
        Loading tables from the database
    */
    /*$(window).load(function() {
        $.post("?url=tableController/viewTables", {}
        , function (data, status) {
            console.log(data);
            data = JSON.parse(data);
            for (var tablesCounter = 0; tablesCounter < data.length; tablesCounter++) {
                document.getElementById("admin-view").innerHTML +=
                        '<div id="tb' + data[tablesCounter]['id'] + '" class="table-info existing-table" style="top: ' + data[tablesCounter]['x'] + '%; left: ' + data[tablesCounter]['y'] + '%;">' +
                        '<input type="radio" table-number="' + data[tablesCounter]['table_number'] + '" id="t' + data[tablesCounter]['id'] + '" name="table-icon" class="table-box"/>' +
                        '<label for="t' + data[tablesCounter]['id'] + '"></label>' +
                        '<div class="info" for="t' + data[tablesCounter]['id'] + '">' +
                        '<label for="t' + data[tablesCounter]['id'] + '">' +
                        '<strong><span id="number">Table ' + data[tablesCounter]['table_number'] + '</span></strong>' +
                        '<br />' +
                        '<span id="seats">' + data[tablesCounter]['chairs_number'] + ' Seats</span></label>' +
                        '</div>' +
                        '</div>';
            }
        });
    });*/

    /*
        When a table is selected this funtion will fire and save table's id
    */
    $('.table-box').click(function () {
        //Saving the table's id
        tableID = $(this).attr("id").replace("t", "");

        //Saving table's info
        $("#tableSeats").val(parseInt($("#tb" + tableID + " #seats").text().replace("Seats", "")));
        $("#tableNumber").val(parseInt($("#tb" + tableID + " #number").text().replace("Table", "")));
    });

    /*
        When creating or updating a new table
    */
    $("#save-table-button").click(function () {
        //Taling tables info from the inputs
        var chairsNumbers = $("#tableSeats").val();
        var tableNumber = $("#tableNumber").val();

        /*
            Checking the type of the operation, when editingStatus == true it means
            we creating a new one
        */
        if (editingStatus == "Create") {
            $.post("?url=tableController/addtable", {
                x: Y,
                y: X,
                chairnumbers: chairsNumbers,
                tablNumbers: tableNumber
            },
            function (data, status) {
                //Creating an array
                data = JSON.parse(data);

                //When the operation is success
                if (data.id) {
                    //Making all childern work for the input
                    $('#newTable .table-box').siblings().attr("for", "t" + data.id);
                    $("#newTable .info label").attr("for", "t" + data.id);

                    $('#newTable .table-box').attr("table-number", tableNumber); //Changing table's number attr

                    $('#newTable .table-box').attr("id", "t" + data.id); //Adding tables' id as and id for the radio button
                    $("#newTable #seats").text(chairsNumbers + " Seats"); //Changing the seats value
                    $("#newTable #number").text('Table ' + tableNumber); //Changing the table value

                    $("#newTable").addClass("existing-table");
                    $("#newTable").attr("id", "tb" + data.id); //Setting table's div id
                    saveTable(); //Hides inputs and save button and make the table not movable
                }
            });
        } else {
            $.post("?url=tableController/updateTable", {
                id: tableID,
                x: Y,
                y: X,
                chairnumbers: chairsNumbers,
                tablNumbers: tableNumber
            },
            function (data, status) {
                console.log(data);
                //Changing table attr
                $('#newTable .table-box').attr("table-number", tableNumber);
                $("#newTable #seats").text(chairsNumbers + " Seats");
                $("#newTable #number").text('Table ' + tableNumber);

                $("#newTable").addClass("existing-table");
                $("#newTable").attr("id", "tb" + tableID); //Setting table's div id
                saveTable();
            });
        }
    });
    $("#delete-table-button").click(function(){
        var tableNumber = $("#tableNumber").val();
        //alert(tableNumber + " "  +tableID);
        $.post("?url=tableController/deletetable",{tableNumber: tableNumber},function(data){
            if(data == "done")
                $("#tb"+tableID).remove();
            else {
                showNotification();
            }
        });
    });
});


/*
    Controls what happens when the user creates or updates a talbe
*/
function controlTable(buttonID) {
    //Hiding add, delete and update buttons and showing inputs and save button
    hide("#delete-table-button");
    hide("#add-table-button");
    hide("#update-table-button");
    show("#tables_form");
    show("#save-table-button");

    X=50;
    Y=50;
    //When user in the edit mode, a new table div will be created
    if (buttonID == "add-table-button") {
        editingStatus = "Create";
        document.getElementById("admin-view").innerHTML +=
                '<div id="newTable" class="table-info" style="top: 60%; left: 50%;">' +
                '<input type="radio" table-number="7" name="table-icon" class="table-box"/>' +
                '<label for="t7"></label>' +
                '<div class="info" for="t7">' +
                '<label for="t7">' +
                '<strong><span id="number">Table 7</span></strong>' +
                '<br />' +
                '<span id="seats">4 Seats</span></label>' +
                '</div>' +
                '</div>';
    } else {
        editingStatus = "Update";
        $("#tb" + tableID).attr('id', 'newTable');
        $("#newTable").removeClass("existing-table");
    }

    //Changing cursor
    $(".tables-view").css("cursor", "pointer");
}

//Hides table from
function saveTable() {
    //Showing add, delete and update
    show("#delete-table-button");
    show("#add-table-button");
    show("#update-table-button");
    hide("#tables_form");
    hide("#save-table-button");

    $("#number").removeAttr('id');
    $("#seats").removeAttr('id');
    $(".tables-view").css("cursor", "default");

    editingStatus = "View";
}

/*
 Getting table x,y position
 */
function div_mouse_down(object, event) {
    if (editingStatus == "Create" || editingStatus == "Update") {
        X = (event.pageX - object.offsetLeft) / object.offsetWidth * 100;
        Y = (event.pageY - object.offsetTop) / object.offsetHeight * 100;

        document.getElementById('newTable').style.left = X + "%";
        document.getElementById('newTable').style.top = Y + "%";
    }
}
