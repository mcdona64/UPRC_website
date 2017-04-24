
<CTYPE html>

<html>
        <head>
                <title>New User</title>
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


	<form action="newUser.php" method="post">        
		<CENTER>
                <p><h1>
                        Make a new user
                </h1></p>
		
		<p><font face="sans-serif">
                Enter Username:
                </font></p>
		<input type="text" name="username" size=25/><br/>
		
		<p><font face="sans-serif">
                Enter Password:
                </font></p>	
		<input type="password" name="password1" size=25/><br/>


		<p><font face="sans-serif">
                RE-Enter Password:
                </font></p>	
		<input type="password" name="password2" size=25/><br/>
		
		<input type="submit" value="Make"/>

                
		</CENTER>
        </form>       
        </body>
</html>



<?php
	session_start();

	if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
		header("Location: index.php");
	}


//_______________________________________________________________________________________


$user = "test";
$pass = "test";

$hostname = "localhost";
$username = "root";
$password = "4pi1pie42";
$dbname= "test1";
$good = true;

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
	
	if(isset($_POST['username']) && isset($_POST['password1']) && isset($_POST['password2'])) {
		if ($_POST['password1'] == $_POST['password2']) {
			while ($row=mysqli_fetch_row($retval)) {
				$user = $row[0];
				$pass = $row[1];
				if($_POST['username'] == $user && $_POST['password1'] == $pass) {
					$good = false;
					
					echo "<CENTER><div style ='font:41px/51px Arial,tahoma,sans-serif;color:#ff0000'> Username and password are already used </div></CENTER>";
				}	
			}
		} else {
			echo "<CENTER><div style ='font:41px/51px Arial,tahoma,sans-serif;color:#ff0000'> Passwords dont match </div></CENTER>";
			$good = false;
		}
    	} else {
		$good = false;
	}
	
	if($good){
		$u = $_POST['username'];
		$p = $_POST['password1'];
		$sql2 = "INSERT INTO users(username, password, ID) VALUES ('$u', '$p', 0)";
		mysqli_query($con, $sql2);
		header("Location: data.php");
	}
	
  	// Free result set
  	mysqli_free_result($retval);
	

} else {
  echo 'not conected';
}
//_______________________________________________________________________________________
	
?>
