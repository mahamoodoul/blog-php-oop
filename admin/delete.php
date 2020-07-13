<?php
include '../lib/Session.php';
Session::checkSession();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/format.php'; ?>


<?php
$db = new Database();
$format = new Format();
?>
<?php
if (!isset($_GET['id']) || $_GET['id'] == null) {

    echo "<script> window.location='postlist.php'; </script>";
} else {
    $postId = $_GET['id'];
    $query = "select * from tbl_post where id='$postId' ";
    $getData = $db->select($query);
    if ($getData) {
        while ($deleteImg = $getData->fetch_assoc()) {
            $dellink = $deleteImg['image'];
            unlink($dellink);
        }
    }

    $delQuery = "DELETE FROM tbl_post where id= '$postId' ";
    $delData = $db->delete($delQuery);
    if ($delData) {

        echo "<script>alert('Data Deleted Successfully  </script>";
        echo "<script> window.location='postlist.php'; </script>";
    } else {
        echo "<script>alert('Data Not Deleted Successfully  </script>";
        echo "<script> window.location='postlist.php'; </script>";
    }
}

?>