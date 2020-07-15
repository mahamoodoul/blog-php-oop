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
                $email = $_POST['email'];

                $name = $format->validation($name);
                $password = $format->validation(md5($password));
                $role = $format->validation($role);
                $email = $format->validation($email);

                $name = mysqli_real_escape_string($db->link, $name);
                $password = mysqli_real_escape_string($db->link, $password);
                $role = mysqli_real_escape_string($db->link, $role);
                $email = mysqli_real_escape_string($db->link, $email);


                if (empty($name) || empty($password) || empty($role) || empty($email)) {
                    echo "<span class='error'>Field is requred  !</span>";
                } else {

                    $mailquery = "select * from tbl_user where email='$email' limit 1";
                    $mailCheck = $db->select($mailquery);
                    if ($mailCheck != false) {
                        echo "<span class='error'>Email already exists   !</span>";
                    } else {

                        $query = "INSERT INTO tbl_user(username,password,email,role) VALUES ('$name','$password','$email','$role')";
                        $userCreate = $db->insert($query);
                        if ($userCreate) {
                            echo "<span class='success'>User Added Successfully   !</span>";
                        } else {
                            echo "<span class='error'>Something went wrong !! try again  !</span>";
                        }
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
                            <input type="text" value="<?php if(isset($name)){ echo $name;} ?>" name="name" placeholder="Enter User Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email
                        </td>
                        <td>
                            <input type="email" value="<?php if(isset($email)){ echo $email;} ?>" name="email" placeholder="Enter Email..." class="medium" />
                        </td>
                    </tr>
                    <tr>
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
                            <select id="select" name="role"  ?>">

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