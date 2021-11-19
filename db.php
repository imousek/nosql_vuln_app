<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
	Press reset to reset DB to default state
	<form method="post" action="db.php">
		<input type="submit" name="submit" value="Reset" />
        </form>

<?php
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);


		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

		try {
			print "Droping db->users<br />\n";
			$command =  new \MongoDB\Driver\Command(["drop" => "users"]);
			$result = $manager->executeCommand('db', $command);
			print "Dropped sucessfully<br />\n";
		} catch (MongoDB\Driver\Exception\RuntimeException $e) {
			print "Creating new<br />\n";
		}

		print "Adding users<br />\n";

		$tst = new MongoDB\Driver\BulkWrite;
		$tst->insert([ "username" => "naxa", "fullname" => "Naxa Kurti", "type" => "user", "password" => "kurty"  ]);
		$tst->insert([ "username" => "robo", "fullname" => "Robo Najkrajsi", "type" => "admin", "password" => "robo"  ]);
		$tst->insert([ "username" => "eidam", "fullname" => "Eidam Slapmaster", "type" => "user", "password" => "agtest"  ]);
		$tst->insert([ "username" => "matusko", "fullname" => "Matusko Trashmaster", "type" => "user", "password" => "havanka"  ]);
		$result = $manager->executeBulkWrite("db.users", $tst);
		printf("Inserted %d users\n", $result->getInsertedCount());


	}
	?>
	</body>
</html>
