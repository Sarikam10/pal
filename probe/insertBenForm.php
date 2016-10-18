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
 		<title>Insert Benutzer</title> 
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
		<form  action ="insertBen.php" name ="user" method="post" />			
			<p><label>ID:</label>
			<?php 
				$db = new dbcon(); 
				try{ 
					$res = $db->getPersWithoutUser(); 
					if ($res !== NULL){ 										
						echo "<select name = pid>";
						while ($dsatz = $res->fetch_object()){ 
							echo "<option value='".$dsatz->id."'>(".$dsatz->id.") ".$dsatz->vorname." ".$dsatz->name . "</option>";
						} 
						echo "</select>";	
					}else echo "Keine Person"; 
				} catch (Exception $e){ 
					echo $e->getMessage(); 
				} 
			?>
			<p><label>Login:</label>
				<input type="text" name= "login"></p>
			<p><label>Password:</label>
				<input type="password" name= "password"></p>
			<p><label>Level:</label><select name="level"><option value="kunde">kunde</option><option value="makler">makler</option><option value="admin">admin</option></select></p>
			<p><input type="submit" name= "send_bt" value="Senden">				
					<input type = "submit" name = "return" value="Zurueck" /></p> 
		</form>
	<body>
</html>	