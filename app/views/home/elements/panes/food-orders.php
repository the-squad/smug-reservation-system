<!-- Financial pane starts -->
<div role="tabpanel" class="tab-pane unactive" id="food-orders">
	<!-- Flaoting button -->
	<?php if ($userType == 0): ?>
			<div class="floating-button" id="make-delivery-button" onclick="window.location='?url=foodmenu'"></div>
	<?php endif; ?>

	<!-- When you have no invoices this message will show up -->
	<h1 class="col-xs-12 text-center" id="empty-invoice-message">You don't have any invoices</h1>

	<!-- Gets the file's direction -->
    <?php $VIEW = dirname(__DIR__); ?>

    <!-- INCLUDE RESERVATION FROM -->
    <?php require_once $VIEW . '/invoice.php' ?>

	<!-- Table starts -->
	<table class="table" id="financial-table">
		<tr class="table-header">
            <?php if ($userType == 1): ?>
                <th id="name">Name</th>
                <th id="email">Email</th>
            <?php endif; ?>
            <th id="day">Day</th>
            <th id="hour">hour</th>
            <th id="money">Total Money</th>
        </tr>
        <?php foreach ($data['invoice'] as $row): ?>
            <tr class="table-row" id="fd1" onclick="fillInvoiceData(this, this.id);">
                <?php if ($userType == 1): ?>
                    <td><?= $row['first_name'] . " " . $row['last_name'] ?></td>
                    <td><?= $row['email'] ?></td>
                <?php endif; ?>
                <td><?= $row['date'] ?></td>
                <td><?= $row['time'] ?></td>
                <td><?= $row['total_money'] ?></td>
                <td style="display: none"></td>
            </tr>
        <?php endforeach; ?>
	</table>

    <?php if (empty($data['invoice'])): ?>
        <script>
            hide("#financial-table");
            show("#empty-invoice-message");
        </script>
    <?php endif; ?>


</div>
