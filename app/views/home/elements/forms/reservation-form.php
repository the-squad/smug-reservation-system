<!-- Reservation Card -->
<div class="floating-card col-md-6 col-xs-12 col-md-offset-3" id="reservation-card">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closePopUpWindow(reserationCard);">
		<span aria-hidden="true">&times;</span>
	</button>
		<!-- Hadline text -->
		<h2 class="text-center" id="card-headline">Reserve a table</h2>

		<?php
			if ($userType == 1 || $userType == 2)
				echo '<!-- Name field -->
				<div class="input-layout first-input edit">
					<input type="text" name="name" id="name-text">
					<label>Name</label>
					<label class="error-message" id="name-error-message">
						Name must contain only characters
					</label>
				</div>

				<!-- Phone number field-->
				<div class="input-layout edit" id="phone-number-div">
					<input type="text" name="phone-number" id="phone-number-text">
					<label>Phone Number</label>
					<label class="error-message" id="phone-number-error-message">
						Phone number must be 11 numbers
					</label>
				</div>

				<!-- Email field-->
				<div class="input-layout edit" id="email-div">
					<input type="text" name="email" id="email-text">
					<label>Email</label>
					<label class="error-message" id="email-error-message">
						Email must be valid
					</label>
				</div>';
		?>

		<!-- Day field -->
		<div class="input-layout half-input edit" id="day-div">
                    <input type="date" name="day" id="day-text" onchange="checkTables()">
			<label>Day</label>
			<label class="error-message" id="date-error-message">
				Date is required
			</label>
		</div>

		<!-- Hour field -->
		<div class="input-layout half-input-up edit" id="hour-div">
			<input type="time" name="hour" id="hour-text" placeholder="HH:MM" onchange="checkTables()">
			<label>Hour</label>
			<label class="error-message" id="hour-error-message">
				Format must be HH:MM
			</label>
		</div>

		<?php
			if ($userType == 0)
				echo '<script>
				$("#day-div").addClass("first-input");
				$("#hour-div").addClass("first-input");
				</script>';
		?>

		<!-- Duration field -->
		<div class="input-layout half-input edit">
			<input type="number" name="duration" id="duration-text" onchange="checkTables()">
			<label>Duration</label>
			<label class="error-message" id="duration-error-message">
				Duation is empty
			</label>
		</div>

		<!-- Number of chairs field -->
		<div class="input-layout half-input-up view-static" id="chairs-div">
			<input type="text" name="chairs-number" id="chairs-number-text">
			<label>Number of Chairs</label>
		</div>

		<!-- Chooseing tables window -->
		<div class="tables-view" id="user-view">
			<?php  foreach ($data['tables'] as $table): ?>
			<div id="td<?=$table['id']?>" class="table-info existing-table" style="top: <?=$table['x']?>%; left: <?=$table['y']?>%;">
					<input type="checkbox" table-number="<?=$table['table_number']?>" name="table-icon[]" id="t<?=$table['id']?>" class="table-box"/>
					<label for="t<?=$table['id']?>"></label>
					<div class="info" for="t<?=$table['id']?>">
						<label for="t<?=$table['id']?>">
							<strong><span id="number">Table <?=$table['table_number']?></span></strong>
							<br />
							<span id="seats"><?=$table['chairs_number']?> Seats</span></label>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<label class="error-message" id="tables-error-message" style="width: 80% !important; margin-left: 10%;">
			No tables are selected
		</label>

		<?php if ($userType == 0): ?>
				<!-- Confirm button -->
				<button class="filled action-button" id="confirm">Confirm</button>
				<!-- Update button -->
				<button class="filled action-button" id="update" onclick="updateReservation();">Update</button>
				<!-- Delete button -->
				<button class="filled action-button" id="delete" onclick="deleteReservation();">Delete</button>
		<?php endif; ?>
</div>
