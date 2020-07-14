<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <div class="block copyblock">


            <?php

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $copyright = $format->validation($_POST['copyright']);
                $copyright = mysqli_real_escape_string($db->link, $copyright);
                if ($copyright == "") {
                    echo "<span class='error'>Filed must be fill up. !! try again  !</span>";
                } else {
                    $query = "UPDATE footer
                            SET
                            note=' $copyright'
                            WHERE id=1 ";
                    $updated_row = $db->update($query);
                    if ($updated_row) {
                        echo "<span class='success'>Data Updated Successfully. </span>";
                    } else {
                        echo "<span class='error'>Data Did Not Updated !</span>";
                    }
                }
            }
            ?>

            <?php
            $query = "SELECT * FROM footer WHERE id=1";
            $copyright = $db->select($query);
            if ($copyright) {
                while ($result = $copyright->fetch_assoc()) {
            ?>

                    <form action="copyright.php" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['note'] ?>" name="copyright" class="large" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php  }
            } ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>