<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
if (!Session::get('userRole') == '0') {
    echo "<script> window.location='index.php'; </script>";
}
?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New User</h2>

        <div class="block copyblock">

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $password = $_POST['password'];
                $role = $_POST['role'];

                $name = $format->validation($name);
                $password = $format->validation(md5($password));
                $role = $format->validation($role);

                $name = mysqli_real_escape_string($db->link, $name);
                $password = mysqli_real_escape_string($db->link, $password);
                $role = mysqli_real_escape_string($db->link, $role);


                if (empty($name) || empty($password) || empty($role)) {
                    echo "<span class='error'>Field is requred  !</span>";
                } else {
                    $query = "INSERT INTO tbl_user(username,password,role) VALUES ('$name','$password','$role')";
                    $userCreate = $db->insert($query);
                    if ($userCreate) {
                        echo "<span class='success'>User Added Successfully   !</span>";
                    } else {
                        echo "<span class='error'>Something went wrong !! try again  !</span>";
                    }
                }
            }
            // header("Location: index.php?msg=".urlencode('Data Inserted successfully.'));


            ?>
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            Username
                        </td>
                        <td>
                            <input type="text" name="name" placeholder="Enter User Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Password
                        </td>
                        <td>
                            <input type="password" name="password" placeholder="Enter Password..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <td>
                            USer role
                        </td>
                        <td>
                            <select id="select" name="role">

                                <option value="">Select User Name</option>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>
                            </select>
                        </td>
                    </tr>
                    <tr>

                        <td>

                        </td>
                        <td>
                            <input type="submit" name="submit" Value="Create" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>