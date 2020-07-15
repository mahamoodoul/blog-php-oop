<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Slider Details</h2>

        <?php
        if (!isset($_GET['sliderid']) || $_GET['sliderid'] == null) {
            
            echo "<script> window.location='sliderlist.php'; </script>";
        } else {
            $sliderid = $_GET['sliderid'];
            //  var_dump($postId);
        }

        ?>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            $title = mysqli_real_escape_string($db->link, $_POST['title']);
           

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/slider" . $unique_image;


            if ($title == "") {

                echo "<span class='error'>Filed must be fill up. !! try again  !</span>";
            } else {


                if (!empty($file_name)) {           //there is a file from input filed --- !empty 


                    if ($file_size > 1048567) {
                        echo "<span class='error'>Image Size should be less then 1MB! </span>";
                    } elseif (in_array($file_ext, $permited) === false) {
                        echo "<span class='error'>You can upload only:-"
                            . implode(', ', $permited) . "</span>";
                    } else {
                       

                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = "UPDATE tbl_slider
                         SET
                         title=' $title',
                         image=' $uploaded_image'
                         WHERE id='$sliderid' ";

                        $updated_row = $db->update($query);
                        if ($updated_row) {
                            echo "<span class='success'>Slider Details Updated Successfully. </span>";
                        } else {
                            echo "<span class='error'>Slider Details Did Not Updated !</span>";
                        }
                    }
                } else {
                   

                    $query = "UPDATE tbl_slider
                         SET
                         title=' $title'
                         WHERE id='$sliderid' ";

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
            $query = "SELECT * FROM tbl_slider WHERE id='$sliderid' ORDER BY id DESC";
            $getslider = $db->select($query);
            if ($result = $getslider->fetch_assoc()) {
            ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $result['title'];  ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $result['image']; ?>" height="150px" width="300px" alt=""> <br />
                                <input type="file" name="image" />
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