<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Category</h2>

        <div class="block copyblock">

            <?php
            if (!isset($_GET['catID']) || $_GET['catID'] == null) {
                echo "<script> window.location='catlist.php'; </script>";
            } else {
                $categoryID = $_GET['catID'];
                // var_dump($categoryID);
            }

            ?>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $name = mysqli_real_escape_string($db->link, $name);
                if (empty($name)) {
                    echo "<span class='error'>Category input requred  !</span>";
                } else {
                    $query = "UPDATE tbl_category SET name='$name' WHERE id='$categoryID' ";
                    $updated_row = $db->update($query);
                    if ($updated_row) {
                        echo "<span class='success'>Category Inputed Successfully   !</span>";
                    } else {
                        echo "<span class='error'>Category Inputed Failed !! try again  !</span>";
                    }
                }
            }
            // header("Location: index.php?msg=".urlencode('Data Inserted successfully.'));

            ?>


            <?php
            $query = "SELECT * FROM tbl_category WHERE id='$categoryID'";
            $category = $db->select($query);
            if ($result = $category->fetch_assoc()) {
            ?>
                <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
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
<?php include 'inc/footer.php'; ?>