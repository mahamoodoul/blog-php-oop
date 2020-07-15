<?php
	if (isset($_GET['page'])) {
		$pageId = $_GET['page'];
		$query = "SELECT * FROM tbl_page WHERE id='$pageId' ";
		$page = $db->select($query);
		if ($page) {
			while ($result = $page->fetch_assoc()) {
	?>
				<title><?php echo $result['name'] ?>-<?php echo TITLE ?></title>
			<?php
			}
		}
	} elseif (isset($_GET['id'])) {
		$postId = $_GET['id'];
		$query = "SELECT * FROM tbl_post WHERE id='$postId' ";
		$post = $db->select($query);
		if ($post) {
			while ($result = $post->fetch_assoc()) {
			?>
				<title><?php echo $result['title'] ?>-<?php echo TITLE ?></title>
			<?php
			}
		}
	} elseif (isset($_GET['category'])) {
		$categoryID = $_GET['category'];
		$query = "SELECT * FROM tbl_category WHERE id='$categoryID' ";
		$catId = $db->select($query);
		if ($catId) {
			while ($result = $catId->fetch_assoc()) {
			?>
				<title><?php echo $result['name'] ?>-<?php echo TITLE ?></title>
		<?php
			}
		}
	} else {
		?>
		<title><?php echo $format->title(); ?>-<?php echo TITLE ?></title>
	<?php
	}
	?>

	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<?php
	if (isset($_GET['id'])) {
		$keyword_id = $_GET['id'];
		$query = "select * from tbl_post where id='$keyword_id' ";
		$keywords = $db->select($query);
		if ($keywords) {
			while ($result = $keywords->fetch_assoc()) {
	?>
				<meta name="keywords" content="<?php echo $result['tags']; ?>">
		<?php 			}
		}
	} else { ?>
		<meta name="keywords" content="<?php echo KEYWORDS ?>">
	<?php } ?>



	<meta name="author" content="Shakil">