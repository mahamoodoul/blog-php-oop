<?php include 'inc/header.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$firstname = $format->validation($_POST['firstname']);
	$lastname = $format->validation($_POST['lastname']);
	$email = $format->validation($_POST['email']);
	$body = $format->validation($_POST['body']);

	$firstname = mysqli_real_escape_string($db->link, $firstname);
	$lastname = mysqli_real_escape_string($db->link, $lastname);
	$email = mysqli_real_escape_string($db->link, $email);
	$body = mysqli_real_escape_string($db->link, $body);

	$errorf = "";
	$errol = "";
	$erroe = "";
	$errob = "";
	if (empty($firstname)) {
		$errorf = "Fisrtname must not be empty";
	}
	if (empty($lastname)) {
		$errorl = "Lastname must not be empty";
	}
	if (empty($email)) {
		$errore = "Email must not be empty";
	}
	if (empty($body)) {
		$errorb = "Body must not be empty";
	}
	


	/*
	if (empty($firstname)) {
		$error = "Firstname must not be empty !";
	} elseif (empty($lastname)) {
		$error = "Lastname must not be empty !";
	} elseif (empty($email)) {
		$error = "Email must not be empty !";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error = " Invalid Email Address  !";
	} elseif (empty($body)) {
		$error = "Message field must not be empty !";
		
	} 
	*/

	if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($body)) {
		$query = "INSERT INTO tbl_contact(firstname,lastname,email,body) 
		VALUES('$firstname','$lastname','$email','$body')";
		$insert_contact = $db->insert($query);
		if ($insert_contact) {
			$msg = "Message sent successfully";
		} else {
			$error = "Message not send succesfully";
		}
	}
}


// $query = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";
// $result = $db->select($query);



?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<h2>Contact us</h2>

		<?php
		
			if (isset($error)) {
				echo "<span style='color:red'>$error </span>";
			}
			if (isset($msg)) {
				echo "<span style='color:green'>$msg </span>";
			}
		

			?>
			<form action="" method="post">
				<table>
					<tr>
						<td>Your First Name:</td>
						<td>
							<?php if (isset($errorf)) {
								echo "<span style='color:red;float:left;'> $errorf </span>";
							} ?>
							<input type="text" name="firstname" placeholder="Enter first name" />
						</td>
					</tr>
					<tr>
						<td>Your Last Name:</td>
						<td>
							<?php if (isset($errorl)) {
								echo "<span style='color:red;float:left;'> $errorl </span>";
							} ?>
							<input type="text" name="lastname" placeholder="Enter Last name" />
						</td>
					</tr>

					<tr>
						<td>Your Email Address:</td>
						<td>
							<?php if (isset($errore)) {
								echo "<span style='color:red;float:left;'> $errore </span>";
							} ?>
							<input type="email" name="email" placeholder="Enter Email Address" />
						</td>
					</tr>
					<tr>
						<td>Your Message:</td>
						<td>
							<?php if (isset($errorb)) {
								echo "<span style='color:red;float:left;'> $errorb </span>";
							} ?>
							<textarea name="body"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="Send" />
						</td>
					</tr>
				</table>
				<form>
		</div>

	</div>
	<?php include 'inc/sidebar.php'; ?>
	<?php include 'inc/footer.php'; ?>