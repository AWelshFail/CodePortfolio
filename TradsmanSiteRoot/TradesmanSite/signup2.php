<?php
require 'db/db_connection.php';

if (isset($_POST['signupbtn'])){
	if (isset($_POST['surname'])){
		$vals = array(
		   ':surname'    => $_POST['surname'],
		   ':firstname' => $_POST['firstname'],
		   ':username'    => $_POST['username'],
		   ':password'    => $_POST['password']
		);
		$sql = "INSERT INTO tradesmen (surname, firstname, username, password) VALUES (:surname,:firstname,:username, :password)";
		$q = $pdo->prepare($sql);
		$q->execute($vals);
	}
	header("Location: signin.php");
}
include('includes/guest_header.html');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sign Up</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<div class="row" style="width: 100%;">
			<div class="signUpCol" style="width: 50%;">
				<h1 class="">
					Sign Up
				</h1>
				<form class="form" action="" method="POST">
					<div class="form-div">
						<input class="form-input" type="text" name="surname" placeholder="Surname">
					</div>

					<div  class="form-div">
						<input class="form-input" type="text" name="firstname" placeholder="Firstname">
					</div>

					<div  class="form-div">
						<input class="form-input" type="text" name="username" placeholder="Username">
					</div>

					<div  class="form-div">
						<input class="form-input" type="text" name="phonenumber" placeholder="Phone Number">
					</div>

					<div  class="form-div">
						<input class="form-input" type="email" name="email" placeholder="Email Address">
					</div>

					<div  class="form-div">
						<input class="form-input" type="password" name="password" placeholder="Password">
					</div>

					<!--<div  class="form-div">
						<input class="form-input" type="password" name="confirmpassword" placeholder="Confirm Password">
					</div>-->

					<div  class="form-div">
						<input class="form-input" type="submit" name="signupbtn" placeholder="Sign Up">
					</div>
				</form>
				<div>
					Already have an account? <a href="signin.php">Sign in</a>
				</div>
			</div>

			<div class="" style="height: 100vh; width: 50%; background-color: #00A2BF; background-size: cover;"></div>

		</div>
	</body>
</html>
<?php
include ('includes/guest_footer.html');
?>
