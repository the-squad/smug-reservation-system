<!-- Feedback pane -->
<div role="tabpanel" class="tab-pane unactive" id="feedback">
	<!-- Table starts -->
	<table class="table" id="feedback-table">
		<tr class="table-header">
			<th id="name">Name</th>
			<th id="email">Email</th>
			<th id="rate">Rate</th>
			<th id="opinion">Opinion</th>
			<th id="cons">Bad stuff</th>
		</tr>

                <?php foreach ($data['feedback'] as $row): ?>
                    <tr class="table-row">
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td>
                            <?php for ($i = 0; $i < $row['rate']; $i++): ?>
                                <span class="glyphicon glyphicon-star star" aria-hidden="true"></span>
                            <?php endfor; ?>
                        </td>
                        <td><?= $row['review'] ?></td>
                        <td><?= $row['dislike'] ?></td>
                    </tr>
                <?php endforeach; ?>
        </table>
	<!-- Table ends -->
</div>
