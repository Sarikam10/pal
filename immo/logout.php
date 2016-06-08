<?php 
 session_start(); 
?>  
<html > 
 <head> 
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
 	<title>Logout</title>
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
 		<?php 
 			require_once("class_login.php"); 
 			$login = new login(); 
 			$res = $login->dologout(); 
			if (!isset($_SESSION["user"])) 
 				echo "Sie wurden ausgeloggt!"; 
 				echo "<p><a href='index.php'>Startseite</a></p>";   
 		?> 
 	</body> 
 </html>  
