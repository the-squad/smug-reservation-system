<!-- User role pane -->
<div role="tabpanel" class="tab-pane unactive" id="user-role">
    <!-- When there is no account this message will show up -->
    <h1 class="col-xs-12 text-center" id="empty-account-message">There are no accounts</h1>

    <!-- Floating button -->
    <div class="floating-button" id="add-account-button" onclick="createAccount();"></div>

    <!-- INCLUDING ACCOUNT CARD -->
    <?php require_once $VIEW . '/forms/account-form.php'; ?>

    <!-- Accounts table -->
    <table class="table" id="user-role-table">
        <tr class="table-header">
            <th id="name">First Name</th>
            <th id="name">Last Name</th>
            <th id="email">Email</th>
            <th id="address">Address</th>
            <th id="phone-number">Phone Number</th>
            <th id="userType">Account Type</th>
        </tr>

        <tbody id="a-t-b">
            <tr id="a1" class="table-row" id="a1" onclick="fillAccountData(this, this.id);">
                <td>Muhammad</td>
                <td>Tarek</td>
                <td>muhammadtarek96@gmail.com</td>
                <td>Othman Basha Ghlaen</td>
                <td>01004402609</td>
                <td>Manager</td>
            </tr>
        </tbody>
    </table>

	<!-- Alert message starts -->
	<div class="alert alert-success alert-dismissible col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1 text-center" role="alert" id="order-food-alert">
		<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Done,</strong> Account added successfully
	</div>
</div>
