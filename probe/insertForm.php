<?php 
	session_start();
	include_once 'config.php';
	include("class_dbcon.php"); 
		if (!isset($_SESSION["user"])){ 
		  exit("<p>Sie haben keinen Zugriff</p><p><a href='index.php'>zur Startseite</a></p>"); 
		}
?>
<html > 
 	<head> 
 		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 	 
 		<title>Insert Person</title> 
		<style ="text/css">
		body {
				background-color:#D8F6CE;
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
		<form  action ="insert.php" name ="user" method="post" />
			<p><label>Vorname:</label>
				<input type="text" name= "vorname"></p>
			<p><label>Name:</label>
				<input type="text" name= "name"></p>
			<p><label>Adresse:</label>
				<input type="text" name= "adresse"></p>
			<p><label>PLZ:</label>
				<input type="text" name= "plz"></p>	
			<p><label>Ort:</label>
				<input type="text" name= "ort"></p>	
			<p><label>Datum:</label>
				<input type="text" name= "datum"></p>	
			<p><label>Login:</label>
				<input type="text" name= "login"></p>
			<p><label>Password:</label>
				<input type="password" name= "password"></p>
			<p><label>Level:</label>
				<select name="level"><option value="kunde">kunde</option><option value="makler">makler</option><option value="admin">admin</option></select></p>
		
			<p><input type="submit" name= "send_bt" value="Senden">				
					<input type = "submit" name = "return" value="Zurueck" /></p> 
		</form>
	<body>
</html>	