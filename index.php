
<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>



<div class="contentsection contemplete clear">
	<div class="maincontent clear">

		<!-- pagiantion  -->

		<?php

		$per_page = 4;
		if (isset($_GET["page"])) {
			$page = $_GET["page"];
		} else {
			$page = 1;
		}
		$start_from = ($page - 1) * $per_page;

		?>

		<!-- pagiantion -->


		<?php
		$query = "select * from tbl_post limit $start_from,$per_page";
		$post = $db->select($query);
		if ($post) {
			while ($result = $post->fetch_assoc()) {



		?>
				<div class="samepost clear">
					<h2><a href="post.php?id=<?php echo $result['id'] ?>"><?php echo $result['title'] ?></a></h2>
					<h4><?php echo $format->formatDate($result['date']); ?>, By  <a href="#"><?php echo $result['author'] ?></a></h4>
					<a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image" /></a>
					<?php echo $format->textShorten($result['body'], 400) ?>
					<div class="readmore clear">
						<!-- <a href="post.php">Read More</a> -->
						<a href="post.php?id=<?php echo $result['id'] ?>">Read More</a>
					</div>
				</div>

			<?php } ?>
			<!--end while loop-->

			<!-- start pagination -->

			<?php

			$query = "select * from tbl_post";
			$result = $db->select($query);
			$total_rows = mysqli_num_rows($result);
			$total_pages = ceil($total_rows / $per_page);
			?>
			<span class="pagination">
				<?php
				echo "<a href='index.php?page=1'>" . 'first page' . "</a>";
				for ($i = 1; $i <= $total_pages; $i++) {
					echo "<a href='index.php?page=" . $i . "'>" . $i . "</a>";
				}

				echo "<a href='index.php?page=$total_pages'>" . 'last page' . "</a>"; ?>

			</span>

			<!-- end pagination -->
		<?php
		} else
			header("Location:404.php")

		?>

	</div>
	<?php include 'inc/sidebar.php'; ?>
	<?php include 'inc/footer.php'; ?>