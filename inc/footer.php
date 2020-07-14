</div>

<div class="footersection templete clear">
	<div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	</div>

	<?php
	$query = "SELECT * FROM footer WHERE id=1";
	$copyright = $db->select($query);
	if ($copyright) {
		while ($result = $copyright->fetch_assoc()) {

	?>
			<p>&copy; <?php echo $result['note']; ?> <?php echo date('Y'); ?></p>
	<?php }
	} ?>
</div>
<div class="fixedicon clear">
	<?php
	$query = "SELECT * FROM tbl_social WHERE id=1";
	$icon = $db->select($query);
	if ($icon) {
		while ($result = $icon->fetch_assoc()) {
	?>
			<a href="<?php echo $result['facebook']; ?>"><img src="images/fb.png" alt="Facebook" /></a>
			<a href="<?php echo $result['twitter']; ?>"><img src="images/tw.png" alt="Twitter" /></a>
			<a href="<?php echo $result['linkedin']; ?>"><img src="images/in.png" alt="LinkedIn" /></a>
			<a href="<?php echo $result['google']; ?>"><img src="images/gl.png" alt="GooglePlus" /></a>
	<?php }
	} ?>
</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>

</html>