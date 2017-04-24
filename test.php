
<html>
        <head>
                <title>Data GUI</title>
                <style style="text/css">
                        body    {
                                background-image: url("images/background.jpeg");
                                background-repeat: no-repeat;
                                background-position: 50% 0%;
                        }
                </style>
        </head>
        <body bgcolor=#000000 text=#000000>
        <basefont face="arial, verdana" size="5" color="#ff0000">
	<form action="logout.php" method="post">
		<input type="submit" value="Logout"/>
	</form>
	<form action="data.php" method="post">
		<input type="submit" value="back"/>
	</form>

	</body>
</html> 


<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?> 


<?php
	session_start();

	if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
		header("Location: index.php");
	}
?>

<?php
$hostname = "localhost";
$username = "root";
$password = "4pi1pie42";
$dbname= "test1";

//echo 'connecting ...<br><br>';

$con = mysqli_connect($hostname,$username,$password,$dbname);
//$con =0;

if ($con) {
  //echo 'conected<br><br><br>';
  
  echo "<h1 align=center>Here are the people currently scanned in </h1> ";

	//now to show the database scanned
	$sql = 'SELECT * FROM scaned';
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval ) {
		die('Could not get data: ' . mysql_error());
	}
	
	while ($row=mysqli_fetch_row($retval)) {
		echo "<CENTER><div style ='font:21px/31px Arial,tahoma,sans-serif;color#010f5b:'> $row[0] ($row[2]) ($row[1])  </div></CENTER>";
		echo '<br>';
    	}
	
  	// Free result set
  	mysqli_free_result($retval);
	

} else {
  echo 'not conected';
}

?>

