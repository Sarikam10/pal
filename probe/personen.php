<?php 
    session_start(); 
	include("class_dbcon.php"); 
    if (!isset($_SESSION["user"])){ 
        exit("<p>Sie haben keinen Zugriff</p><p><a href='index.php'>zur Startseite</a></p>"); 
    } 
    include("navBar.php"); 
 ?> 
<html> 
	<head> 
	 <meta charset="utf-8"> 
	 <title>Alle Personen</title>
	<style ="text/css">
		body {
				background-color: #D0F5A9;
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
	 <p><h1>Alle Personen</h1></p> 	 
	 <?php 
		$db = new dbcon(); 
		try{ 
			$res = $db->getAllPersDetails(); 
			if ($res !== NULL){ 
					echo "<table border='1'>"; //Tabellenbeginn 
					echo "<tr><th>Vorname</th><th>Name</th><th>Adresse</th><th>PLZ</th><th>Ort</th><th>Datum</th></tr>"; //?berschrift 
						while ($dsatz = $res->fetch_object()){ 
							echo "<tr>"; 
							echo "<td>" . $dsatz->vorname . "</td>"; 
							echo "<td>" . $dsatz->name . "</td>"; 
							echo "<td>" . $dsatz->adresse . "</td>"; 
							echo "<td>" . $dsatz->plz . "</td>";
							echo "<td>" . $dsatz->ort . "</td>"; 
							echo "<td>" . $dsatz->datum . "</td>";
							// echo "<td>" . $dsatz->level . "</td>"; 
							echo "</tr>"; 
						} 
					echo "</table>"; //Tabellenende  
			}else echo "Keine Person"; 
		} catch (Exception $e){ 
			echo $e->getMessage(); 
		} 
	?> 	 
	</body> 
 </html> 