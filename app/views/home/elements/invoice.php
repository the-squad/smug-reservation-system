<!-- Invoice Card -->
<div class="floating-card col-md-6 col-xs-12 col-md-offset-3" id="invoice-card">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closePopUpWindow('#invoice-card');">
		<span aria-hidden="true">&times;</span>
	</button>
		<h2 class="text-center">Invoice</h2>

		<div id="items-div">
			<table id="items-table">
				<thead>
					<th id="name">Name</th>
					<th id="amount">Amount</th>
					<th id="total">Total</th>
					<th id=delete-row></th>
				</thead>

				<tbody id="invoice-item-table">

				</tbody>
			</table>
		</div>

		<h2 class="text-center">Details</h2>

		<!-- Address -->
		<div class="input-layout">
			<input type="text" name="address" id="address">
			<label>Address</label>
			<label class="error-message" id="address-error-message">
				Address must be between 7:14 digits
			</label>
		</div>

		<!-- Payment Method -->
		<!-- Credit Card Fields -->
		<div class="input-layout">
            <select id="payment-method-select" onchange="paymentMethodContorl()">
				<?php foreach ($data['methods'] as $value): ?>
					<option><?=$value ?></option>
				<?php endforeach; ?>
            </select>
            <label>Payment Method</label>
        </div>

		<!-- Credit card name field-->
		<div class="input-layout" id="credit-card-number-div" style="display: none;">
			<input type="text" name="credit-card-number" id="credit-card-number-text">
			<label>Credit card number</label>
			<label class="error-message" id="credit-card-number-error-message">
				Enter a valid credit card number
			</label>
		</div>

		<!-- CVC field -->
		<div class="input-layout half-input" id="cvc-div" style="display: none;">
			<input type="text" name="cvc" id="cvc-text">
			<label>CVC</label>
			<label class="error-message" id="cvc-error-message">
				CVC number is only 3 numbers
			</label>
		</div>

		<!-- Expiration date field -->
		<div class="input-layout half-input-up" id="expire-date-div" style="display: none;">
			<input type="text" name="expiration-date" id="expire-date-text">
			<label>Expiration date</label>
			<label class="error-message" id="expire-date-error-message">
				Enter a valid expiration date
			</label>
		</div>

		<!-- Checkout button-->
		<input type="button" class="user-only filled action-button" value="Checkout" id="checkout" onclick="">
	</form>
</div>
