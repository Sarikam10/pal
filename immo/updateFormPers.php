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
 		<title>Update Person</title> 
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
	<p><h1>Person</h1></p> 
	<form action ="updatePers.php" name ="user" method="post" />
	<?php
	$db = new dbcon(); 
		try{ 
			$res = $db->getAllPersonBenutzerDetails();
			//$res =  $db->getAllBenutzerDetails();
			//print_r($res);
			if ($res !== NULL){ 
					echo "<table border='1'>"; //Tabellenbeginn 
					echo "<tr><th>Wahl</th><th>ID</th><th>Vorname</th><th>Name</th><th>Adresse</th><th>PLZ</th><th>Ort</th><th>Datum</th><th>Login</th><th>Password</th><th>Level</th></tr>"; //Überschrift 
						while ($dsatz = $res->fetch_object()){ 
							echo "<tr>"; 
							echo "<th>" ."<input type='radio' name='action_radio' id='id' value='$dsatz->id'></th> ";
							echo "<td>" . $dsatz->id . "</td>"; 
							echo "<td>" . $dsatz->vorname . "</td>"; 
							echo "<td>" . $dsatz->name . "</td>"; 
							echo "<td>" . $dsatz->adresse . "</td>"; 
							echo "<td>" . $dsatz->plz . "</td>";
							echo "<td>" . $dsatz->ort . "</td>"; 
							echo "<td>" . $dsatz->datum . "</td>";
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