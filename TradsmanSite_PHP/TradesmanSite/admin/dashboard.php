<?php
require '../db/db_connection.php';
include 'navigation.php';
$stmt = $pdo->prepare("SELECT * FROM tradesmen");
$stmt->execute();
$tradesmen = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM admin");
$stmt->execute();
$admins = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM jobs");
$stmt->execute();
$jobs = $stmt->fetchAll();
include ('admin_header.html');
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
	</head>
	<body>
		<div class="row" style="padding: 10px 30px;">
			<div class="" style="width: 50%;">
				<div>
					<h3> Tradesmen </h3>
				</div>
				<?php
				foreach ($tradesmen as $tradesman) {
					echo "<div style='padding-top:10px;'>".$tradesman['surname']." ".$tradesman['firstname']."</div>";
					echo "<div>".$tradesman['email']."</div>";
					echo "<div><a href='activate_user.php?id=".$tradesman['id']."'>activate</a></div>";
					echo "<div><a href='deactivate_user.php?id=".$tradesman['id']."'>deactivate</a></div>";
					echo "<div><a href='delete_user.php?id=".$tradesman['id']."'>delete</a></div>";
				}
				?>
			</div>
			<div class="" style="width: 50%;">
				<div>
					<h3> Admins </h3>
				</div>
				<?php
				foreach ($admins as $admin) {
					echo "<div style='padding-top:10px;'>".$admin['username']."</div>";
					echo "<div>".$admin['email']."</div>";
					echo "<div><a href='activate_admin.php?id=".$admin['id']."'>activate</a></div>";
					echo "<div><a href='deactivate_admin.php?id=".$admin['id']."'>deactivate</a></div>";
					echo "<div><a href='delete_admin.php?id=".$admin['id']."'>delete</a></div>";
				}
				?>
			</div>
		</div>

	</body>
</html>
<?php
include ('guest_footer.html');
?>
