<?php
class generateReportController extends controller {
    /*
        Taking dates from the page and validate them then return the report
    */
    function createReport() {
        //Creating array of errors
        $errors = array();

        //Validating the date input
        $startDate = $_POST['sdate'];
        if(!$startDate)
            $errors['sdate'] = "Date is Required";

        //Validating the date input
        $endDate=$_POST['edate'];
        $endDateERR = Validation::checkDate($endDate);
        if($endDateERR != "true" && $endDateERR != "Invalid Date it is old")
            $errors['edate'] = $endDateERR;

        //Validating the date input
        if($startDate > $endDate)
           $errors['sdate']="End date is older than from date";

        //If there is not errors
        if (empty($errors)) {
            $report = new report();
            $admin = new admin();
            $report->setStartDate($startDate);
            $report->setEndDate($endDate);

            //Returning report details
            $reportDetails = $admin->generateReport($report)[0];
            $reportDetails['status'] = 'true';
            echo json_encode($reportDetails);
        } else {
            $errors['status'] = 'false';
            //Returing an array of erros
            echo json_encode($errors);
        }
    }
}
?>
