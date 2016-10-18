<?php
	session_start();
?>
<html > 
	<head> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  	 
		<title>Startseite</title>
		<style ="text/css">
			body {
				background-color: #F3F781;
				font-family: Verdana;
				font-family: Verdana;
				margin-top: 100px;
				margin-bottom: 100px;
				margin-right: 150px;
				margin-left: 80px;
			}
		</style>		
	</head> 
 	<body>
	<?php
		// Browser aufgeben
		echo "Benuetzte Browser: ".$_SERVER['HTTP_USER_AGENT'];
		
	if(!isset($_SESSION['user'])){  
	?>
		<p><h1 >Bitte melden Sie sich an oder registrieren Sie sich!</h1></p> 
		<br/>
		<form  action ="login.php" name ="user" method="post" />
		<p><label>Benutzer:</label>
			<input type="text" name= "username"></p>
		<p><label>Passwort:</label>
			<input type="password" name= "password"></p>
		<p><input type="submit" name= "send" value="Login"> <input type="submit" name= "reg" value="Registrieren"></p>			
		</form>
		
		
	<?php  
		} else if(isset($_SESSION['user'])&& $_SESSION['level'] == 'admin'){ 
                header("Location: adminhome.php"); 
        } else if (isset($_SESSION['user']))
                header("Location: userhome.php");
	?>	 
	</body> 
</html> 