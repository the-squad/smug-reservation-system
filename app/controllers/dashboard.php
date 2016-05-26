<?php
class dashboard extends Controller {
    /*
        When a ?url=dashboard, this method will worl and redirect the user to
        the dashboard page and fire two methods which are:
        - Show reservations
        - View Tables
    */
    public function dashboard() {
        if (isset($_SESSION['email'])) {
            $ut = App::getUserType($_SESSION['id']);
            if ($ut == 0) {
                $userR = reservation::showReservations();
                $m = new member();
                $m->setId($_SESSION['id']);
                $invoice = $m->showInvoicesHistory();
            } else {
                $userR = admin::showAllreservations();
                $invoice = order::viewAllinvoices();
            }
            $this->view('home/dashboard', [
                'reservations' => $userR,
                'invoice' => $invoice,
                'feedback' => admin::showFeedback(),
                'tables' => table::showTables(),
                'User_Type' => App::getUserType($_SESSION['id']),
                'tabs' => App::allowedPages($_SESSION['id'])
            ]);
        } else
            $this->view('home/index', ['tables' => table::showTables()]);
    }

    /*
        This is the default method, when the user doesn't write ?url=dashboard this
        method will be fired
    */
    public function index() {
        $this->dashboard();
    }
} ?>
