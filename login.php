<?php
	require 'vendor/autoload.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body>

<form method="POST">
	<label for="username">Username: </label><input type="text" id="username" name="username" value="" />
	<label for="password">Password: </label><input type="text" id="password" name="password" value="" />
	<input type="submit" value="Login" />
</form>

<?php

	if(isset($_POST['username']) && isset($_POST['password'])){

		$username = $_POST['username'];
		$password = $_POST['password'];

	#	$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING); 
	#	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING); 

                #$username = htmlspecialchars($_GET['username'], ENT_QUOTES);
                #$password = htmlspecialchars($_GET['password'], ENT_QUOTES);
		
		try {
			$client = new MongoDB\Client("mongodb://localhost:27017");
			$collection = $client->db->users;
			$query = array("username"=>$username, "password"=>$password);
			$result = $collection->findOne($query);

			if($result != null) {
				echo $result["username"];
				if($result["type"] == "admin") {
					echo "\nVitaj admin\n";
				}	
			}	
		} catch (Exception $e) {}	
	}

?>	
</body>
</html>
