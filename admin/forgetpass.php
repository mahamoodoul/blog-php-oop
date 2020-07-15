<?php
include '../lib/Session.php';
Session::checkLogin();
?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/format.php'; ?>


<?php
$db = new Database();
$format = new Format();
?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
    <div class="container">
        <section id="content">

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $format->validation($_POST['email']);
                $email = mysqli_real_escape_string($db->link, $email);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<span style='color:red;font-size:18px;'>Invalid Email </span>";
                } else {
                    $mailquery = "select * from tbl_user where email='$email' limit 1";
                    $mailCheck = $db->select($mailquery);
                    if ($mailCheck != false) {
                        while ($value = mysqli_fetch_array($mailCheck)) {
                            $userId = $value['id'];
                            $userName = $value['username'];
                        }
                        $text = substr($email, 0, 3);
                        $rand = rand(10000, 99999);
                        $newpass = "$text$rand";
                        $password = md5($newpass);
                        $updateQuery = "UPDATE tbl_user
                                        SET
                                        password='$password'
                                        WHERE id='$userId' ";

                        $update_pass = $db->update($updateQuery);
                        $to = $email;
                        $from = "mahamodul.shakil11@gmail";
                        $headers = "From: $from\n";
                        $headers .= 'MIME-Version: 1.0';
                        $headers .= 'Content-type: text/html; charset=iso-8859-1';
                        $subject="Your Password recovery";
                        $message="Your username is".$userName." and password is".$newpass."please visit the website to login";



                        $sendmail = mail($to, $subject, $message, $headers);
                        if($sendmail){
                            echo "<span style='color:green;font-size:18px;'> Please check your email </span>";
                        }else{
                            echo "<span style='color:red;font-size:18px;'>Try again.server problem</span>";
                        }
                    } else {
                        echo "<span style='color:red;font-size:18px;'> Email not exist.. </span>";
                    }
                }
            }
            ?>
            <form action="" method="post">
                <h1>Password Recovery</h1>
                <div>
                    <input type="text" placeholder="Enter your Email" required="" name="email" />
                </div>
                <div>
                    <input type="submit" value="Sent" />
                </div>
            </form><!-- form -->
            <div class="button">
                <a href="index.php">Log in </a>
            </div><!-- button -->
            <div class="button">
                <a href="#">Training with live project</a>
            </div><!-- button -->
        </section><!-- content -->
    </div><!-- container -->
</body>

</html>