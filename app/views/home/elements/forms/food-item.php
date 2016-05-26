<!-- Food item Card -->
<div class="floating-card col-md-6 col-xs-12 col-md-offset-3" id="food-item-card">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closePopUpWindow('#food-item-card');">
		<span aria-hidden="true">&times;</span>
	</button>

	<!-- Picture -->
	<div class="food-picture">
		<input type="file" name="file" id="file" class="inputfile" onchange="previewFile()"/>
		<label class="glyphicon glyphicon-camera" aria-hidden="true" id="image-picker" for="file"></label>
	</div>
	<label class="error-message" id="picture-error-message" style="top:-30px; margin-bottom: -50px;">
		Please upload a photo
	</label>

	<!-- Name field -->
	<div class="input-layout first-input view" id="food-name">
		<input type="text" name="name" id="name-text" max="15">
		<label>Name</label>
		<label class="error-message" id="name-error-message">
			Name must contain only characters
		</label>
	</div>

	<!-- Description field -->
	<div class="input-layout view">
		<textarea type="text" name="description" id="description-text">
		</textarea>

		<label>Description</label>
		<label class="error-message" id="description-error-message">
			Description must contain only characters
		</label>
	</div>

	<div id="stars-div">
		<!-- Stars are copied from the card -->
	</div>

	<?php if ($foodMenuUserType == 0): ?>
		<!-- Amount field, shows only to the user-->
		<div class="input-layout" id="amount">
			<input type="number" name="amount" id="amount-text" value="0" min="0" onchange="enableOrderButton();">
			<label>Amount</label>
			<label class="error-message" id="amount-error-message">
				Name must contain only characters
			</label>
		</div>;
	<?php endif; ?>

	<!-- Price field -->
	<div class="input-layout view" id="priceDiv">
		<input type="text" name="price" id="price-text">
		<label>Price</label>
		<span class="currency">L.E</span>
		<label class="error-message" id="price-error-message">
			Not Valid
		</label>
	</div>

	<?php
		if ($foodMenuUserType == 1 || $foodMenuUserType == 2) {
			echo '<script>
					$("#price").css("margin-top", "30px");
					$("#price").css("margin-left", "42.5%");
				</script>';
		}
	?>

	<!-- Order button-->
	<?php
		/*
			If the user type == 0 (Member) order button will be added to the
			screen
		*/
		if ($foodMenuUserType == 0)
			echo '<input type="button" disabled="disabled" class="user-only filled action-button" value="Order" id="order" onclick="addToCart();">';
	?>

	<?php
		/*
			If the user type == 1 (Admin) these buttons will be added to the screen
			1- Update button
			2- Delete button
			3- Confirm button
		*/
		if ($foodMenuUserType == 1): ?>
			<!-- Confirm button-->
			<button type="button" class="filled action-button" id="confirm">Confirm</button>
			<!-- Update button -->
			<button type="button" class="filled action-button" id="update" onclick="updateFoodItem();">Update</button>
			<!-- Delete button -->
			<button type="button" class="filled action-button" id="delete" onclick="deleteFoodItem();">Delete</button>
	<?php endif; ?>
</div>
