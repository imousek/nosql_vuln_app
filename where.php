<?php
	require 'vendor/autoload.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body>

	<form method="GET">
		<label for="username">Enter a username: </label><input type="text" id="username" name="username" value="" />
		<input type="submit" />
	</form>

<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	if (array_key_exists ("username", $_GET)) {

		$username = $_GET['username'];
		#$username = filter_var($_GET['username'], FILTER_SANITIZE_STRING);   
		#$username = htmlspecialchars($_GET['username'], ENT_QUOTES); 

		$client = new MongoDB\Client("mongodb://localhost:27017");
		$collection = $client->db->users;
		$query = array('$where' => 'this.username === \''.$username.'\'');	
		var_dump($query);
		$res = $collection->find($query);
		foreach ($res as $doc) {
    			var_dump($doc);
		}
	}
	?>
</body>
</html>
