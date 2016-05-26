<!-- Generate report pane starts -->
<div role="tabpanel" class="tab-pane unactive" id="user-type">
    <!-- Table starts -->
	<table class="table" id="users-type-table">
		<tr class="table-header">
			<th>Name</th>
			<th>Reservations</th>
			<th>Tables Control</th>
			<th>Generate Report</th>
			<th>Finicial Sector</th>
			<th>Feedback</th>
			<th>Accounts Managment</th>
			<th>Control User Types</th>
			<th>Food Menu</th>
			<th>Food Category</th>
		</tr>

		<tbody id="u-t">
			<tr class="table-row view" id="u1" onclick="selectRow(this.id);">
				<td>
					<input class="userTypeText" type="text" value="Manager" />
				</td>
				<td>
					<select class="userTypeSelector" tabID="1">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
				<td>
					<select class="userTypeSelector" tabID="2">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
				<td>
					<select class="userTypeSelector" tabID="3">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
				<td>
					<select class="userTypeSelector" tabID="4">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
				<td>
					<select class="userTypeSelector" tabID="5">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
				<td>
					<select class="userTypeSelector" tabID="6">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
				<td>
					<select class="userTypeSelector" tabID="7">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
				<td>
					<select class="userTypeSelector" tabID="8">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
				<td>
					<select class="userTypeSelector" tabID="9">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
			</tr>

			<tr class="table-row view" id="u2" onclick="selectRow(this.id);">
				<td>
					<input class="userTypeText" type="text" value="Manager" />
				</td>
				<td>
					<select class="userTypeSelector" tabID="1">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
				<td>
					<select class="userTypeSelector" tabID="2">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
				<td>
					<select class="userTypeSelector" tabID="3">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
				<td>
					<select class="userTypeSelector" tabID="4">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
				<td>
					<select class="userTypeSelector" tabID="5">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
				<td>
					<select class="userTypeSelector" tabID="6">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
				<td>
					<select class="userTypeSelector" tabID="7">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
				<td>
					<select class="userTypeSelector" tabID="8">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
				<td>
					<select class="userTypeSelector" tabID="9">
						<option selected="">No Access</option>
						<option>View</option>
						<option>Edit</option>
					</select>
				</td>
			</tr>
		</tbody>

		<!-- Floating buttons starts -->
	    <button class="filled tables-buttons" id="add-user-type-button" onclick="createNewUserType();">Add Type</button>
	    <button class="filled tables-buttons" id="update-user-type-button" onclick="updateUserType();">Update Type</button>
	    <button class="filled tables-buttons" id="save-user-type-button" onclick="confirmUserType();">Save Type</button>
	    <button class="filled tables-buttons" id="delete-user-type-button" onclick="deleteUserType();">Delete Type</button>
	</table>
</div>
