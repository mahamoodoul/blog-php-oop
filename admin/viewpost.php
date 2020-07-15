<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update New Post</h2>

        <?php
        if (!isset($_GET['viewid']) || $_GET['viewid'] == null) {
            
            echo "<script> window.location='postlist.php'; </script>";
        } else {
            $viewid = $_GET['viewid'];
            //  var_dump($postId);
        }

        ?>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<script> window.location='postlist.php'; </script>";
        
        }


        ?>



        <div class="block">


            <?php
            $query = "SELECT * FROM tbl_post WHERE id='$viewid' ORDER BY id DESC";
            $getView = $db->select($query);
            if ($postResult = $getView->fetch_assoc()) {
            ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input readonly type="text" name="title" value="<?php echo $postResult['title'];  ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select readonly id="select" name="cat">
                                    <option value="1">Select Category</option>
                                    <?php
                                    $query = "select * from tbl_category";
                                    $category = $db->select($query);
                                    if ($category) {
                                        while ($result = $category->fetch_assoc()) {
                                    ?>
                                            <option <?php if ($postResult['cat'] == $result['id']) { ?> selected="selected" <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                    <?php     }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea readonly class="tinymce" name="body">
                                    <?php echo $postResult['body']; ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input readonly type="text" name="tags" value="<?php echo $postResult['tags']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input readonly type="text" name="author" value="<?php echo $postResult['author']; ?>" class="medium" />
                                <input type="hidden"  name="userId" value="<?php echo Session::get('userId'); ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Back" />
                            </td>
                        </tr>
                    </table>
                </form>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        setSidebarHeight();
    });
</script>
<!-- /TinyMCE -->



<?php include 'inc/footer.php'; ?>