$(document).ready(function () {
    $(".dateInput").change(function () {
        $.post("?url=generateReportController/createReport", {
            sdate : $("#from-date").val(),
            edate : $("#to-date").val()
        }, function(data) {
            //Converting the array of errors
            data = JSON.parse(data);

            //Validating date input
            if (data['edate']) {
                $("#report-alert").text(data['edate']);
                showNotification();
            }

            //Validating date input
            if (data['sdate']) {
                $("#report-alert").text(data['sdate']);
                showNotification();
            }

            //If all fields are correct
            if (data['status'] == 'true') {
                $("#t-r").text(data['Total_Reservations']);
                $("#m-o").text(data['Popular_Food']);
                $("#t-r-h").text(data['sum_duration']);
                $("#g-n").text(data['No_users']);
                $("#r-t-t").text(data['No_tables']);
                $("#t-f-o").text(data['Orders']);
                $("#f-u").text(data['Distinct_Users']);
                $("#t-i").text(data['Total_Money']);
                $("#o-t").text(data['Ordered_times']);
            }
        });
    });
});
