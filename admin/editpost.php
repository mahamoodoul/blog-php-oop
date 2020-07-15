<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update New Post</h2>

        <?php
        if (!isset($_GET['updateid']) || $_GET['updateid'] == null) {
            
            echo "<script> window.location='postlist.php'; </script>";
        } else {
            $postId = $_GET['updateid'];
            //  var_dump($postId);
        }

        ?>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            $title = mysqli_real_escape_string($db->link, $_POST['title']);
            $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);
            $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
            $author = mysqli_real_escape_string($db->link, $_POST['author']);
            $userId = mysqli_real_escape_string($db->link, $_POST['userId']);

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/" . $unique_image;

            if ($title == "" || $cat == "" || $body == "" || $tags == "" || $author == "") {

                echo "<span class='error'>Filed must be fill up. !! try again  !</span>";
            } else {


                if (!empty($file_name)) {           //there is a file  --- !empty 


                    if ($file_size > 1048567) {
                        echo "<span class='error'>Image Size should be less then 1MB! </span>";
                    } elseif (in_array($file_ext, $permited) === false) {
                        echo "<span class='error'>You can upload only:-"
                            . implode(', ', $permited) . "</span>";
                    } else {


                    

                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = "UPDATE tbl_post
                         SET
                         cat='$cat ',
                         title=' $title',
                         body=' $body',
                         image=' $uploaded_image',
                         author=' $author',
                         tags='$tags ',
                         userid='$userId'
                         WHERE id='$postId' ";

                        $updated_row = $db->update($query);
                        if ($updated_row) {
                            echo "<span class='success'>Data Updated Successfully. </span>";
                        } else {
                            echo "<span class='error'>Data Did Not Updated !</span>";
                        }
                    }
                } else {


                    $query = "UPDATE tbl_post
                         SET
                         cat='$cat ',
                         title=' $title',
                         body=' $body',
                         author=' $author',
                         tags='$tags ',
                         userid='$userId'
                         WHERE id='$postId' ";

                    $updated_row = $db->update($query);
                    if ($updated_row) {
                        echo "<span class='success'>Data Updated Successfully. </span>";
                    } else {
                        echo "<span class='error'>Data Did Not Updated !</span>";
                    }
                }
            }
        }


        ?>



        <div class="block">


            <?php
            $query = "SELECT * FROM tbl_post WHERE id='$postId' ORDER BY id DESC";
            $getpost = $db->select($query);
            if ($postResult = $getpost->fetch_assoc()) {
            ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $postResult['title'];  ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
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
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $postResult['image']; ?>" height="80px" width="200px" alt=""> <br />
                                <input type="file" name="image" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    <?php echo $postResult['body']; ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" value="<?php echo $postResult['tags']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo $postResult['author']; ?>" class="medium" />
                                <input type="text"  name="userId" value="<?php echo Session::get('userId'); ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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