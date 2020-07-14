<?php include 'inc/header.php'; ?>

<?php
if (!isset($_GET['page']) || $_GET['page'] == null) {
	header("Location:404.php");
} else {
	$pageid = $_GET['page'];
}

?>
<?php
$query = "SELECT * FROM tbl_page WHERE id='$pageid' ";
$page = $db->select($query);
if ($page) {
	while ($result = $page->fetch_assoc()) {
?>
		<div class="contentsection contemplete clear">
			<div class="maincontent clear">
				<div class="about">

					<h2><?php echo $result['name']; ?> </h2>
						<?php echo $result['body']; ?>
				
				</div>

			</div>

	<?php }
} else {
	header("Location:404.php");
} ?>
	<?php include 'inc/sidebar.php'; ?>
	<?php include 'inc/footer.php'; ?>