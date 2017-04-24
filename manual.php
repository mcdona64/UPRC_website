
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

	<form action="manual.php" method="post">        
		<CENTER>
                <p><h1>
                        manually enter person:
                </h1></p>
		
		<p><font face="sans-serif">
                Enter Name:
                </font></p>
		<input type="text" name="name" size=25/><br/>
		
		<p><font face="sans-serif">
                Enter RFID:
                </font></p>	
		<input type="text" name="rfid" size=25/><br/>
	
		<p><font face="sans-serif">
                Adding or Removing?:
                </font></p>	
		<input type="radio" name="aod" value="add" checked> ADD<br>
  		<input type="radio" name="aod" value="remove"> REMOVE<br>
		
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


$rfid = 12345;
$name = "bob";

$hostname = "localhost";
$username = "root";
$password = "4pi1pie42";
$dbname= "test1";
$good = false;

//echo 'connecting ...<br><br>';

$con = mysqli_connect($hostname,$username,$password,$dbname);
//$con =0;

if ($con) {
	//now to show the database scanned
	$sql = 'SELECT * FROM scaned';
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval ) {
		die('Could not get data: ' . mysql_error());
	}

	if(isset($_POST['aod']) && $_POST['aod'] == "add"){
			
		
		
		if(isset($_POST['name']) && isset($_POST['rfid'])) {
			$n = $_POST['name'];
			$r = $_POST['rfid'];

			$good = true;
			while ($row=mysqli_fetch_row($retval)) {
				$name = $row[0];	
				if (strcmp($name, $n) == 0){
					$good = false;
				} 			
			}
	    	}
			
		if($good){
			$sql2 = "INSERT INTO scaned(name, rfid, time) VALUES ('$n', '$r', NOW())";
			mysqli_query($con, $sql2);
			echo "<CENTER><div style ='font:41px/51px Arial,tahoma,sans-serif;color:#ff0000'> Added </div></CENTER>";
		}
	
	} else {
		if(isset($_POST['name'])) {
			$n = $_POST['name'];
			while ($row=mysqli_fetch_row($retval)) {
				$name = $row[0];
				if (strcmp($name, $n) == 0){
					$good = true;
				} 			
			}
    		}
	
		if($good){
			$sql2 = "DELETE FROM scaned WHERE name='$n'";
			mysqli_query($con, $sql2);
			echo "<CENTER><div style ='font:41px/51px Arial,tahoma,sans-serif;color:#ff0000'> deleted </div></CENTER>";
		}
	
	}

  	// Free result set
  	mysqli_free_result($retval);
	

} else {
  echo 'not conected';
}
//_______________________________________________________________________________________
	
?>
