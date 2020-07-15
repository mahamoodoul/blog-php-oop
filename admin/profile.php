<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$userid = Session::get('userId');
$userRole = Session::get('userRole');
?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Update USer</h2>

        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $name = $format->validation($_POST['name']);
            $userName = $format->validation($_POST['userName']);
            $email = $format->validation($_POST['email']);
            $details = $format->validation($_POST['details']);



            $name = mysqli_real_escape_string($db->link, $name);
            $userName = mysqli_real_escape_string($db->link,  $userName);
            $email = mysqli_real_escape_string($db->link, $email);
            $details = mysqli_real_escape_string($db->link, $details);
            if ($name == "" || $userName == "" || $email == "" || $details == "") {

                echo "<span class='error'>Filed must be fill up. !! try again  !</span>";
            } else {

                // var_dump($name,$userName,$details,$email);
                // die();

                $query = "UPDATE tbl_user
                         SET name=' $name ',
                             username='$userName',
                             email='$email',
                             details=' $details'
                             WHERE id='$userid' ";

                $updated_user = $db->update($query);
                if ($updated_user) {
                    echo "<span class='success'>Data Updated Successfully. </span>";
                } else {
                    echo "<span class='error'>Data Did Not Updated !</span>";
                }
            }
        }


        ?>



        <div class="block">


            <?php
            $query = "SELECT * FROM tbl_user WHERE id='$userid' AND role='$userRole'";
            $user = $db->select($query);
            if ($result = $user->fetch_assoc()) {
            ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name'];  ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>User Name</label>
                            </td>
                            <td>
                                <input type="text" name="userName" value="<?php echo $result['username'];  ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" name="email" value="<?php echo $result['email'];  ?>" class="medium" />
                            </td>
                        </tr>



                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea name="details" rows="10" cols="50">
                                    <?php echo $result['details']; ?>
                                </textarea>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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