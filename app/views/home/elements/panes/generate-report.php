<!-- Generate report pane starts -->
<div role="tabpanel" class="unactive tab-pane" id="report">
	<h1 class="col-xs-12 text-left" id="headline">Report</h1>

	<div class="report-generator">
		<form>
			<label>From</label>
			<input type="date" class="dateInput" id="from-date">
			<label>To</label>
			<input type="date" class="dateInput" id="to-date">
		</form>
	</div>

	<!-- Total reservations -->
	<div class="data-block col-md-3 col-md-offset-1 col-xs-10 col-xs-offset-1 ">
		<label class="head-text">Total Reservations</label>
		<br>
		<label class="secondary-text" id="t-r">-</label>
	</div>

	<!-- Total duartuin -->
	<div class="data-block col-md-3 col-xs-10">
		<label class="head-text">Total Reservations Hours</label>
		<br>
		<label class="secondary-text" id="t-r-h">-</label>
	</div>

	<!-- Total guests -->
	<div class="data-block col-md-3 col-xs-10">
		<label class="head-text">Total Guest</label>
		<br>
		<label class="secondary-text" id="g-n">-</label>
	</div>

	<!-- Number of reservard tables -->
	<div class="data-block col-md-3 col-md-offset-1 col-xs-10 col-xs-offset-1 ">
		<label class="head-text">Total Reserved Tables</label>
		<br>
		<label class="secondary-text" id="r-t-t">-</label>
	</div>

	<!-- Total income -->
	<div class="data-block col-md-3 col-xs-10">
		<label class="head-text">Total Income</label>
		<br>
		<label class="secondary-text" id="t-i">-</label>
	</div>


	<!-- Total users ordered food -->
	<div class="data-block col-md-3 col-xs-10">
		<label class="head-text">Total Users Ordered Food</label>
		<br>
		<label class="secondary-text" id="f-u">-</label>
	</div>

	<!-- Total orders -->
	<div class="data-block col-md-3 col-md-offset-1 col-xs-10 col-xs-offset-1 ">
		<label class="head-text">Total Food Orders</label>
		<br>
		<label class="secondary-text" id="t-f-o">-</label>
	</div>

	<!-- Most ordered food  -->
	<div class="data-block col-md-3 col-xs-10">
		<label class="head-text">Most Ordered Food</label>
		<br>
		<label class="secondary-text" id="m-o">-</label>
	</div>

	<!-- Ho many times it ordered -->
	<div class="data-block col-md-3 col-xs-10">
		<label class="head-text">Most Ordered Number</label>
		<br>
		<label class="secondary-text" id="o-t">-</label>
	</div>

	<!-- Alert message starts -->
	<div class="alert alert-danger alert-dismissible col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1 text-center" role="alert" id="report-alert">
		<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Alert,</strong> Date isn't valid
	</div>
</div>
