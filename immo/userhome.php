<?php
session_start(); if (!isset($_SESSION["user"])){ 
        exit("<p>Sie haben keinen Zugriff</p><p><a href='index.php'>zur Startseite</a></p>"); 
    } 
    include("navBar.php"); 
 ?> 
 <html> 
	 <head> 
		<meta charset="utf-8"> 
		<title>User-Home</title> 
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
		echo "<p><h1>Willkommen bei Immobilien GmbH!</h1></p>"; 
		echo "\n Willkommen ".$_SESSION['name']." !"; //Benutzer begrüßen 
		// echo "<p><a href='meineinhalte.php'>meine Inhalte</a></p>"; 
	 ?> 
	  </body> 
 </html> 