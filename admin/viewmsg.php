<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<?php
if (!isset($_GET['msgid']) || $_GET['msgid'] == null) {
    echo "<script> window.location='inbox.php'; </script>";
} else {
    $msgid = $_GET['msgid'];
    // var_dump($categoryID);
}

?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>View Inbox MEssages</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<script> window.location='inbox.php'; </script>";
        }

        ?>
        <div class="block">

            <?php
            $query = "SELECT * FROM tbl_contact WHERE id='$msgid'";
            $msgdetails = $db->select($query);
            if ($msgdetails) {
                while ($result = $msgdetails->fetch_assoc()) {
            ?>
                    <form action="" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input readonly value="<?php echo $result['firstname'] . ' ' . $result['lastname']; ?>" type="text" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input readonly value="<?php echo $result['email']; ?>" type="text" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Date</label>
                                </td>
                                <td>
                                    <input readonly value="<?php echo $format->validation($result['date']); ?>" type="text" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Mesage</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body">
                                        <?php echo $result['body']; ?>

                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="OK" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php  }
            } ?>
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