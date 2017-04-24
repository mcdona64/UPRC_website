<!DOCTYPE html>

<?php
	
	session_start();
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		header("Location: data.php");		
	}

//_______________________________________________________________________________________


	$user = "test";
	$pass = "test";


$hostname = "localhost";
$username = "root";
$password = "4pi1pie42";
$dbname= "test1";

//echo 'connecting ...<br><br>';

$con = mysqli_connect($hostname,$username,$password,$dbname);
//$con =0;

if ($con) {
	//now to show the database scanned
	$sql = 'SELECT * FROM users';
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval ) {
		die('Could not get data: ' . mysql_error());
	}
	
	while ($row=mysqli_fetch_row($retval)) {
		$user = $row[0];
		$pass = $row[1];
		if(isset($_POST['username']) && isset($_POST['password'])) {
			if($_POST['username'] == $user && $_POST['password'] == $pass) {
				$_SESSION['logged_in'] = true;
				header("Location: data.php");
			}	
		}
    	}
	
  	// Free result set
  	mysqli_free_result($retval);
	

} else {
  echo 'not conected';
}
//_______________________________________________________________________________________
	

?>

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
        <form action="index.php" method="post">        
		<CENTER>
                <p><h1>
                        Data Visualization Login
                </h1></p>

                <p><font face="sans-serif">
                        Welcome to the data visualization page!<br> Please log in
                </font></p></CENTER>

		<p><font face="sans-serif">
                        Enter Username:
                </font></p>
		<input type="text" name="username" size=25/><br/>
		
		<p><font face="sans-serif">
                Enter Password:
                </font></p>	
		<input type="password" name="password" size=25/><br/>
		
		<input type="submit" value="login"/>
	</form>	
        </body>
</html>
