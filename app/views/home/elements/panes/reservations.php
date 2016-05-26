<!-- Reservations pane -->
<div role="tabpanel" class="tab-pane unactive" id="Reservation">
    <!-- Flaoting button -->
    <?php if ($userType == 0): ?>
            <div class="floating-button" id="make-reservation-button" onclick="makeReservation();"></div>
    <?php endif; ?>

    <!-- When you have no reservations this message will show up -->
    <h1 class="col-xs-12 text-center" id="empty-reservation-message">You don't have any reservations</h1>

    <!-- Gets the file's direction -->
    <?php $VIEW = dirname(__DIR__); ?>

    <!-- INCLUDE RESERVATION FROM -->
    <?php require_once $VIEW . '/forms/reservation-form.php' ?>

    <!-- Reservations table -->
    <table class="table" id="reservations-table">
        <thead>
            <!-- Tables's header -->
            <tr class="table-header">
                <?php
                if ($userType == 1)
                    echo '<th id="name">Name</th>
                      <th id="phone-number">Phone Number</th>
		              <th id="email">Email</th>';
                ?>
                <th id="day">Day</th>
                <th id="hour">Hour</th>
                <th id="duration">Duration</th>
                <th id="chairs-number">No. of Chairs</th>
            </tr>
        </thead>

        <!-- Controlling when to show the table and the empty message -->
        <?php if (empty($data['reservations'])): ?>
            <script>
                $("#empty-reservation-message").css("display", "block");
                $("#reservations-table").css("display", "none");
            </script>
        <?php endif; ?>

        <tbody id="r-t-b">
            <!-- Creating reservation rows -->
            <?php foreach ($data['reservations'] as $value): ?>
                <tr class="table-row" onclick="fillReservationData(this, this.id)" id="r<?= $value['id'] ?>">
                    <?php if($userType == 1): ?>
                        <td><?= $value['first_name'] . " " . $value['last_name'] ?></td>
                        <td><?= $value['phone_number'] ?></td>
                        <td><?= $value['email'] ?></td>
                    <?php endif; ?>
                    <td><?= $value['date'] ?></td>
                    <td><?= $value['time'] ?></td>
                    <td><?= $value['duration'] ?></td>
                    <td><?= $value['chairs_number'] ?></td>
                    <td style="display:none"><?= $value['tables'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php
        //When the user type is user
        if ($userType == 0)
            echo '<button class="filled col-sm-2 col-sm-offset-5" id="Historybo">Show History</button>';
    ?>

    <!-- Alert message starts -->
    <div class="alert alert-success alert-dismissible col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1 text-center" role="alert" id="reservation-alert">
        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Done,</strong> Your reservation has been recorded
    </div>
</div>
