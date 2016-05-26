<?php
class feedback {
    //Intializing variables
    private $rate;
    private $review;
    private $dislike;

    //Setter and getter methods
    function getRate() {
        return $this->rate;
    }

    function getReview() {
        return $this->review;
    }

    function getDislike() {
        return $this->dislike;
    }

    function setRate($rate) {
        $this->rate = $rate;
    }

    function setReview($review) {
        $this->review = $review;
    }

    function setDislike($dislike) {
        $this->dislike = $dislike;
    }

}
