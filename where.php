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
		<input type="submit" value="Guess" />
	</form>

<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	if (array_key_exists ("username", $_GET)) {

		$username = $_GET['username'];

		$client = new MongoDB\Client("mongodb://localhost:27017");
		$collection = $client->db->users;
	#	$query = 'function() {return this.username=="robo" || db.users.drop()}';	
		$query = 'function() {return this.username=='.$username.'}';
		echo $query;
		$result = $collection->find(array('$where' => $query));
		$res = $result->toArray();
		if($res != null){
			var_dump($res);
			#echo $result["password"];
		}
	}
	?>
</body>
</html>
