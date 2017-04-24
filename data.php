
<?php
	session_start();

	if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
		header("Location: index.php");
	}
?>


<CTYPE html>

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
                <CENTER>
                <p><h1>
                        Home
                </h1></p>

                <p><font face="sans-serif">
                        Here are the options:
                </font></p>
		
        	<form action="logout.php" method="post">
			<input type="submit" value="Logout"/>
		</form>
		<form action="test.php" method="post">
			<input type="submit" value="see who is checed in"/>
		</form>
		<form action="newUser.php" method="post">
			<input type="submit" value="Make a new user"/>
		</form>

		<form action="manual.php" method="post">
			<input type="submit" value="Manually enter data"/>
		</form>

		</CENTER>
               
        </body>
</html>


