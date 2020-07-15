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

if (!isset($_GET['sliderid']) || $_GET['sliderid'] == null) {

    echo "<script> window.location='sliderlist.php'; </script>";
} else {
    $sliderid = $_GET['sliderid'];
    // var_dump($sliderid);
    // die();
    $delQuery = "DELETE FROM tbl_slider where id= '$sliderid' ";
    $delData = $db->delete($delQuery);
    if ($delData) {

        echo "<script>alert('Slide Deleted Successfully  </script>";
         echo "<script> window.location='sliderlist.php'; </script>";
    } else {
        echo "<script>alert('Slider Not Deleted Successfully  </script>";
         echo "<script> window.location='sliderlist.php'; </script>";
    }
}


?>