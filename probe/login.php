<?php 
    session_start(); 
 ?> 
 <html> 
 <head> 
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
 	<title>User Login</title> 
	<style ="text/css">
		body {
				background-color: #BDBDBD;
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
	if (isset($_POST["send"])){ 	
		require_once("class_login.php"); // login Klasse laden 
  
		$login = new login(); //login Objekt erzeugen 
		$error = $login->dologin(); //Methode f?r login aufrufen 
  
		if (!isset($_SESSION["user"])) {    //irgendwas ist schiefgelaufen 
			echo "Fehler:"; 
			foreach ($error as $err){ 
				 echo "<p>$err </p>"; 
			} 
			exit("<p><a href='index.php'>Startseite</a></p>"); 
		} else if ($_SESSION['level'] == 'admin' ) {
			header("Location: adminhome.php"); 
		}else  
			header("Location: userhome.php");			
	}
	if (isset($_POST["reg"])) {
		header("Location: registr.php"); 
	}
	?>
  </body> 
 </html> 