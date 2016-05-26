<!-- Food item Card -->
<div class="floating-card col-md-6 col-xs-12 col-md-offset-3" id="accounts-type-card">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closePopUpWindow('#accounts-type-card');">
		<span aria-hidden="true">&times;</span>
	</button>
		<h2 class="text-center">Create a new account</h2>

		<div class="input-layout first-input half-input edit">
			<input type="text" name="first-name" id="firstName">
			<label>First name</label>
			<label class="error-message" id="first-name-error-message">
				Name isn't valid
			</label>
		</div>

		<div class="input-layout half-input-up edit" id="last-name-div">
			<input type="text" name="last-name" id="lastName">
			<label>Last name</label>
			<label class="error-message" id="last-name-error-message">
				Name isn't valid
			</label>
		</div>

		<div class="input-layout edit" id="email-div">
			<input type="text" name="email" id="emailTEXT">
			<label>Email</label>
			<label class="error-message" id="email-error-message">
				Email must be valid
			</label>
		</div>

		<div class="input-layout edit" id="password-div">
			<input type="password" name="password" id="password">
			<label>Password</label>
			<label class="error-message" id="password-error-message-1">
				Password must be between 8:18 digits
			</label>
		</div>

		<div class="input-layout edit" id="password-confirm-div">
			<input type="password" name="confirm-password" id="passwordConfirm">
			<label>Confirm Password</label>
			<label class="error-message" id="password-confirm-error-message">
				Password didn't match
			</label>
		</div>

		<div class="input-layout edit">
			<input type="text" name="address" id="address">
			<label>Address</label>
			<label class="error-message" id="address-error-message">
				Address must be between 7:14 digits
			</label>
		</div>

		<div class="input-layout edit">
			<input type="text" name="phone-number" id="phoneNumber">
			<label>Phone Number</label>
			<label class="error-message" id="phone-number-error-message">
				Phone number must be 11 numbers
			</label>
		</div>

		<div class="input-layout edit">
            <select id="account-type-select">
                <option disabled="" selected="" style="display: none;"></option>
                <option>Manager</option>
            </select>
            <label>Account Type</label>
        </div>

        <!-- Confirm button-->
        <button type="button" class="filled action-button" id="confirmAccount" onclick="createUpdateAccount();">Confirm</button>
        <!-- Update button -->
        <button type="button" class="filled action-button" id="updateAccount" onclick="updateAccount();">Update</button>
        <!-- Delete button -->
        <button type="button" class="filled action-button" id="deleteAccount" onclick="deleteAccount();">Delete</button>
</div>
