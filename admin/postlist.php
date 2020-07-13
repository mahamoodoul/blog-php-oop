<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="5%">No.</th>
						<th width="15%">Post Tilte</th>
						<th width="15%">Description</th>
						<th width="10%">Category</th>
						<th width="16%">Image</th>
						<th width="8%">Author</th>
						<th width="8%">Tags</th>
						<th width="10%">Date</th>
						<th width="13%">Action</th>

					</tr>
				</thead>
				<tbody>

					<?php
					$query = "SELECT tbl_post.*,tbl_category.name FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat =tbl_category.id ORDER BY tbl_post.title DESC";
					$post = $db->select($query);
					if ($post) {
						$i = 0;
						while ($result = $post->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['title']; ?> </td>
								<td><?php echo $format->textShorten($result['body'], 100) ?></td>
								<td><?php echo $result['name']; ?></td>
								<td><img src="<?php echo $result['image']; ?>" style="border-radius: 50%; " height="50px" width="" alt=""></td>
								<td><?php echo $result['author']; ?></td>
								<td><?php echo $result['tags']; ?></td>
								<td><?php echo $format->formatDate($result['date']); ?></td>

								<td>
									<a href="editpost.php?updateid=<?php echo $result['id']; ?>">Edit</a> ||
									<a onclick="return confirm('Are you sure to delete !!')" href="delete.php?id=<?php echo $result['id']; ?>">Delete</a></td>
							</tr>
					<?php 	}
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