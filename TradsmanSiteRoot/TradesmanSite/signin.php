<?php
require 'db/db_connection.php';
$error = '';
if (isset($_POST['signinbtn'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$stmt = $pdo->prepare("SELECT * FROM tradesmen WHERE username=?");
	$stmt->execute([$username]);
	$user = $stmt->fetch();
	if ($user) {
	    // the username already exists
	    if ($password === $user['password'] && $user['account_status'] === 'active') {
	    	# code...
	    	session_start();
		    $_SESSION["id"] = $user['id'];
		    $_SESSION["username"] = $username;
		    header("Location: dashboard.php");
	    }
	    else{
	    	$error='Password Error';
	    }
	    // the username does not exist
	    $error='User not found';
	}
}
include('includes/guest_header.html');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sign in</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<?php
		if ($error !== ''){
		echo "<div class='full-width' style='width: 100%;'>
			<div class='' style='text-align: center;'>
				".$error."
			</div>
		</div>";
		}
		?>
		<div class="row" style="width: 100%;">
			<div class="signInBar" style="width: 50%;">
				<h1 class="signin-text">
					Sign In
				</h1>
				<form class="form" action="" method="POST">
					<div class="form-div">
						<input class="form-input" type="text" name="username" placeholder="Username" required>
					</div>

					<div  class="form-div">
						<input class="form-input" type="password" name="password" placeholder="Password" required>
					</div>

					<div  class="form-div">
						<input class="form-input" type="submit" name="signinbtn" placeholder="Sign In">
					</div>
				</form>
				<div>
					Are you a new user? <a href="signup.php">Sign up</a>
				</div>

			</div>

			<div class="" style="height: 90vh; width: 50%; background-color: #00A2BF; background-size: cover;"><img src="img/siteImages/vanMan.jpg" alt="Tradesman outside van" style="padding-top: 100px;"></div>

		</div>
	</body>
</html>
<?php
include ('includes/guest_footer.html');
?>
