<?php 

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
	
	$host = "localhost";
    $user = "test";
    $pass = "t3st3r123";
    $db = "test";

	$conn = new mysqli($host, $user, $pass, $db);
	
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT kasutajaID, kasutajanimi FROM 0001kasutajad";
	$result = $conn->query($sql);

	$var = '';
	
	if ($result->num_rows > 0) {
		$var += "<table><tr><th>ID</th><th>Kasutajanimi</th></tr>\n";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$var += "<tr><td>" . $row["kasutajaID"]. "</td><td>" . $row["kasutajanimi"]. "</td></tr>\n";
		}
		    $var += "</table>";
			
	} else {
		$var = "0 results";
	}
	$conn->close();
	
	

	$phV = phpversion();
	$guestIP = $_SERVER['REMOTE_ADDR'];
	
	$html = file_get_contents("template.html");
	
	$html = str_replace("{{sinuip}}",$guestIP,$html);
	$html = str_replace("{{phversioon}}",$phV,$html);
	$html = str_replace("{{dbtulemus}}",$var,$html);
	
	echo $html;



	?>

