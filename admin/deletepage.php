<?php
include '../lib/Session.php';
Session::checkSession();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>



<?php
$db = new Database();
?>
<?php
if (!isset($_GET['delpage']) || $_GET['delpage'] == null) {

    echo "<script> window.location='index.php'; </script>";
} else {
    $delID = $_GET['delpage'];
    // var_dump($delID);
    // die();
    $delQuery = "DELETE FROM tbl_page where id= '$delID' ";
    $delData = $db->delete($delQuery);
    if ($delData) {

        echo "<script>alert('Page Deleted Successfully  </script>";
        echo "<script> window.location='index.php'; </script>";
    } else {
        echo "<script>alert('Page Not Deleted Successfully  </script>";
        echo "<script> window.location='deletepage.php'; </script>";
    }
}


?>