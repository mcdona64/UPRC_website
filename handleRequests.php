<?php

	function Connection(){
		$server="localhost";
		$user="root";
		$pass="4pi1pie42";
		$db="test1";
	   	
		$connection = mysql_connect($server, $user, $pass);

		if (!$connection) {
	    	die('MySQL ERROR: ' . mysql_error());
		}
		
		mysql_select_db($db) or die( 'MySQL ERROR: '. mysql_error() );

		return $connection;
	}


   	$link=Connection();

	$name=$_POST["name"];
	$rfid=$_POST["rfid"];

	$query = "INSERT INTO `scaned` (`name`, `rfid`, 'time') 
		VALUES ('".$name."','".$rfid."', now())"; 
   	
   	mysql_query($query,$link);
	mysql_close($link);

   	header("Location: index.php");
?>
