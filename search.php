<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body>

<form method="GET">
	<label for="username">Enter a username: </label><input type="text" id="username" name="username" />
	<input type="submit" />
</form>

<?php
	if (array_key_exists ("username", $_GET)) {

		$username = $_GET['username'];
	#	$username = filter_var($_GET['username'], FILTER_SANITIZE_STRING);	
#		$username = htmlspecialchars($_GET['username'], ENT_QUOTES);

	#	echo $username . "\n";

		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

		$filter = [ "username" => $username ] ;
		$options = [];
		$query = new MongoDB\Driver\Query($filter, $options);
		$rows = $manager->executeQuery('db.users', $query);

		$row_count = 0;
		foreach($rows as $user){
			if (array_key_exists ("username", $user)) {
				?>
				<p>
					<?php echo $user->type . " - " . $user->fullname . " - " . $user->password . "<br />\n"; ?>
				</p>
				<?php
			}
			$row_count++;
		}

		if ($row_count == 0) {
			?>
			<p>User not found</p>
			<?php
		}
	}
?>
</body>
</html>
