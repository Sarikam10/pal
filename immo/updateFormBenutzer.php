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
 		<title>Update Benutzer</title> 
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
	<p><h1>Benutzer</h1></p> 
	<form action ="updateBenutzer.php" name ="user" method="post" />
	<?php
	$db = new dbcon(); 
		try{ 
			$res = $db-> getAllBenutzerDetails();			
			if ($res !== NULL){ 
					echo "<table border='1'>"; //Tabellenbeginn 
					echo "<tr><th>Wahl</th><th>Login</th><th>Password</th><th>Level</th></tr>"; //Überschrift 
						while ($dsatz = $res->fetch_object()){ 
							echo "<tr>"; 
							echo "<th>" ."<input type='radio' name='action_radio' id='id' value='$dsatz->id'></th> ";
							echo "<td>" . $dsatz->login . "</td>"; 
							echo "<td>" . $dsatz->password . "</td>"; 
							echo "<td>" . $dsatz->level . "</td>"; 
							echo "</tr>"; 
						} 
					echo "</table>"; //Tabellenende 
	?>
	
		<p><input type = 'submit' name = 'bt_update' value='Bearbeiten' />
			<input type = 'submit' name = 'bt_delete' value='Loeschen' /></p>
		
	</form>		
	<p><a href='adminhome.php'>Zurueck</a></p>
	<?php		
			} else echo "Keine Person!"; 
		} catch (Exception $e){ 
			echo $e->getMessage(); 
		}	
	?>	
	</body> 
	<head> 
	