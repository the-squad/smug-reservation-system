<?php
interface Usermanagment {
    public function addReservation(reservation $reservation);

    public function updateReservation(reservation $reservation);

    public function deleteReservation(reservation $reservation);
}
