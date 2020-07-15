<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<?php
if (!isset($_GET['userid']) || $_GET['userid'] == null) {
    // die();
    echo "<script> window.location='userlist.php'; </script>";
} else {
    $userId = $_GET['userid'];
    // var_dump($userId);
    // die();
}

?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>USer Info</h2>

        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<script> window.location='userlist.php'; </script>";
        }


        ?>


        <div class="block">


            <?php
            $query = "SELECT * FROM tbl_user WHERE id='$userId' ";
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
                                <input readonly type="text" name="name" value="<?php echo $result['name'];  ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>User Name</label>
                            </td>
                            <td>
                                <input readonly type="text" name="userName" value="<?php echo $result['username'];  ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input readonly type="email" name="email" value="<?php echo $result['email'];  ?>" class="medium" />
                            </td>
                        </tr>



                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea readonly name="details" rows="10" cols="50">
                                    <?php echo $result['details']; ?>
                                </textarea>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="BACK" />
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