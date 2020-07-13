<?php include 'inc/header.php'; ?>



<?php
if (!isset($_GET['category']) || $_GET['category'] == null) {
    header("Location:404.php");
} else {
    $category_id = $_GET['category'];
}
?>


<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <?php
        $query = "select * from tbl_post where cat=$category_id ";
        $post = $db->select($query);
        if ($post) {
            while ($result = $post->fetch_assoc()) {
        ?>
                <div class="samepost clear">
                    <h2><a href="post.php?id=<?php echo $result['id'] ?>"><?php echo $result['title'] ?></a></h2>
                    <h4><?php echo $format->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author'] ?></a></h4>
                    <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image" /></a>
                    <?php echo $format->textShorten($result['body'], 400) ?>
                    <div class="readmore clear">
                        <!-- <a href="post.php">Read More</a> -->
                        <a href="post.php?id=<?php echo $result['id'] ?>">Read More</a>
                    </div>
                </div>

            <?php } ?>
            <!--end while loop-->
        <?php
        } else
           echo "<span style=''> there are no post realted to this category </span>"
        ?>
    </div>
    <?php include 'inc/sidebar.php'; ?>
    <?php include 'inc/footer.php'; ?>