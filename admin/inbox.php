<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Inbox</h2>

		<?php
		if (isset($_GET['seenID'])) {
			$seenID = $_GET['seenID'];

			$query = "UPDATE tbl_contact
			SET
			status='1 '
			WHERE id='$seenID' ";

			$seen_msg = $db->update($query);
			if ($seen_msg) {
				echo "<span class='success'>Message sent to seen page. </span>";
			} else {
				echo "<span class='error'>Something went wrong!</span>";
			}
		}

		?>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="10%">Serial No.</th>
						<th width="15%">Name</th>
						<th width="15%">Email</th>
						<th width="25%">Message</th>
						<th width="10%">Date</th>
						<th width="25%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT * FROM tbl_contact WHERE status='0' ORDER BY id DESC";
					$details = $db->select($query);
					if ($details) {
						$i = 0;
						while ($result = $details->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['firstname'] . ' ' . $result['lastname']; ?></td>
								<td><?php echo $result['email']; ?></td>
								<td><?php echo $result['body']; ?></td>
								<td><?php echo $format->formatDate($result['email']); ?></td>
								<td>
									<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> ||
									<a href="replaymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a>||
									<a onclick="return confirm('Are you sure to move the message!!')" href="?seenID=<?php echo $result['id']; ?>">Seen</a>
								</td>
							</tr>
					<?php }
					} ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="box round first grid">
		<h2>Seen Message</h2>

		<?php
		if (isset($_GET['delid'])) {
			$delid = $_GET['delid'];

			$query = "DELETE FROM tbl_contact WHERE id='$delid' ";

			$delete_msg = $db->update($query);
			if ($delete_msg) {
				echo "<span class='success'>Message Deletd Succesfully. </span>";
			} else {
				echo "<span class='error'>Something went wrong!</span>";
			}
		}

		?>


		<?php
		if (isset($_GET['unseenId'])) {
			$unseenId = $_GET['unseenId'];

			$query = "UPDATE tbl_contact
			SET
			status='0'
			WHERE id='$unseenId' ";
			$unseen_msg = $db->update($query);
			if ($unseen_msg) {
				echo "<span class='success'>Message sent to aggain read mode. </span>";
				echo "<script> window.location='inbox.php'; </script>";
			} else {
				echo "<span class='error'>Something went wrong!</span>";
			}
		}

		?>

		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="10%">Serial No.</th>
						<th width="15%">Name</th>
						<th width="15%">Email</th>
						<th width="25%">Message</th>
						<th width="10%">Date</th>
						<th width="25%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT * FROM tbl_contact WHERE status='1' ORDER BY id DESC";
					$details = $db->select($query);
					if ($details) {
						$i = 0;
						while ($result = $details->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['firstname'] . ' ' . $result['lastname']; ?></td>
								<td><?php echo $result['email']; ?></td>
								<td><?php echo $result['body']; ?></td>
								<td><?php echo $format->formatDate($result['email']); ?></td>
								<td>
									<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> ||
									<a onclick="return confirm('Are you sure want to unseen the message?')" href="?unseenId=<?php echo $result['id']; ?>">Unseen</a>||
									<a onclick="return confirm('Are you sure want to delete?')" href="?delid=<?php echo $result['id']; ?>">Delete</a>

								</td>
							</tr>
					<?php }
					} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();


	});
</script>
<?php include 'inc/footer.php'; ?>