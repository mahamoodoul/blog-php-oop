<<?php include 'inc/header.php'; ?> <?php include 'inc/sidebar.php'; ?> <div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block">

            <?php

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {


                $facebook = $format->validation($_POST['facebook']);
                $twitter = $format->validation($_POST['twitter']);
                $linkedin = $format->validation($_POST['linkedin']);
                $google = $format->validation($_POST['google']);

                $facebook = mysqli_real_escape_string($db->link, $facebook);
                $twitter = mysqli_real_escape_string($db->link, $twitter);
                $linkedin = mysqli_real_escape_string($db->link, $linkedin);
                $google = mysqli_real_escape_string($db->link, $google);


                if ($facebook == "" || $twitter == "" || $linkedin == "" || $google == "") {

                    echo "<span class='error'>Filed must be fill up. !! try again  !</span>";
                } else {


                    $query = "UPDATE tbl_social
                    SET
                    facebook=' $facebook',
                    twitter=' $twitter',
                    linkedin=' $linkedin',
                    google=' $google'
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
            $query = "SELECT * FROM tbl_social WHERE id=1";
            $icon = $db->select($query);
            if ($icon) {
                while ($result = $icon->fetch_assoc()) {
            ?>

                    <form method="post" action="">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Facebook</label>
                                </td>
                                <td>
                                    <input type="text" name="facebook" value="<?php echo $result['facebook']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Twitter</label>
                                </td>
                                <td>
                                    <input type="text" name="twitter" value="<?php echo $result['twitter']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>LinkedIn</label>
                                </td>
                                <td>
                                    <input type="text" name="linkedin" value="<?php echo $result['linkedin']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Google Plus</label>
                                </td>
                                <td>
                                    <input type="text" name="google" value="<?php echo $result['google']; ?>" class="medium" />
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
            <?php }
            } ?>
        </div>
    </div>
    </div>

    <?php include 'inc/footer.php'; ?>