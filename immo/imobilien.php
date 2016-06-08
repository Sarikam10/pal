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
	 <title>Alle Immobilien</title>
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
	 <p><h1>Alle Immobilien</h1></p> 	 
	 <?php 
		$db = new dbcon(); 
		try{ 
			$res = $db->getImmo(); 
			if ($res !== NULL){ 
					echo "<table border='1'>"; //Tabellenbeginn 
					echo "<tr><th>Art</th> <th>PDF</th></tr>"; //Überschrift 
						while ($dsatz = $res->fetch_object()){ 
							echo "<tr>"; 
							echo "<td>" . $dsatz->art . "</td>"; 
							echo "<td><a href='".$dsatz->pdf."'target='_blank'>PDF herunterladen</a></td>"; 
							echo "</tr>"; 
						} 
					echo "</table>"; //Tabellenende  
			}else echo "Keine Immobilien"; 
		} catch (Exception $e){ 
			echo $e->getMessage(); 
		} 
	?> 	 
	</body> 
 </html> 
