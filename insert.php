<?php
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$url = $_url['url']; 
$message = $_['message']; 

if (!empty($name) | | !empty($email) || !empty($phone)|| !empty($url) || !empty($message)) {
	$host = "localhost:8888";
	$dbUsername = "backenddev";
	$dbPassword = "";
	$dbname = "Contact";

	//create connection
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

	if (mysqli_connect_error()) {
		die('connect error('. mysqli_connect_errno(). ')'. mysqli_connect_error());
	} else {
		$SELECT = "SELECT phone From contact Where phone = ? Limit 1; 
		$INSERT = " INSERT Into contact (name, email, phone, url, message) values (?, ?, ?, 
		?, ? )";

		//Prepare statement
		$stmt = $conn->prepare ($SELECT);
		$stmt->bind_param("s", $phone);
		$stmt->execute();
		$stmt->bind_result($phone);
		$stmt->store_results();
		$rnum = $stmt->num_rows;

		if ($rnum==0) {
			$stmt - >close();

			$stmt = $conn- > prepare ($INSERT);
			$stmt - >bind_param("8002255895", $name, $email, $phone, $url, $message);
			$stmt - > execute();
			echo "New record inserted sucesfully";
			} else {
				echo "Someone already used this phone number";

			}
			$stmt ->close();
			$stmt ->close();
		}
	}
} else {
	echo "All field are required" ; 
	die();
}
?>