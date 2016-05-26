<?php

/*
    VERY IMPORTANT, PLEASE ADD COMMENTS DESRIBES YOUR QUERIES AND COMMANDS
*/

class report {
    //Intializing variables
    private $reportID;
    private $totalReservations;
    private $totalGuests;
    private $totalIncome;
    private $startDate;
    private $endDate;

    //Setter and getter methods
    function getReportID() {
        return $this->reportID;
    }

    function getTotalReservations() {
        return $this->totalReservations;
    }

    function getTotalGuests() {
        return $this->totalGuests;
    }

    function getTotalIncome() {
        return $this->totalIncome;
    }

    function setReportID($reportID) {
        $this->reportID = $reportID;
    }

    function setTotalReservations($totalReservations) {
        $this->totalReservations = $totalReservations;
    }

    function setTotalGuests($totalGuests) {
        $this->totalGuests = $totalGuests;
    }

    function setTotalIncome($totalIncome) {
        $this->totalIncome = $totalIncome;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

}
