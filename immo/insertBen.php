<?php
	session_start();
	include_once 'config.php';
	include("class_dbcon.php"); 
		// if (!isset($_SESSION["user"])){ 
		  // exit("<p>Sie haben keinen Zugriff</p><p><a href='index.php'>zur Startseite</a></p>"); 
		// }
?>		
<html>
	<head> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>INSERT_Benutzer</title>
		<style>
		body {
				background-color:#F5D0A9;
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
				if(isset($_POST ["return"])){
					if($_POST["return"] == "Zurueck"){
						header("Location: index.php");
					}
				}
				$db = new dbcon();
				
				// Einfügen von Benutzer
				if(isset($_POST ["send_bt"])){
					if (empty($_POST["login"]) || empty($_POST["password"]) || empty($_POST["level"])) {
						echo "Bitte alle Felder ausfuehlen!";
						echo"<br/><a href='insertBenForm.php'>Zurueck</a>";							
						exit;
					}
					if($_POST["send_bt"] == "Senden"){
						// print_r($_POST);
						$id = $_POST["pid"];
						$login = $_POST["login"];
						$password = $_POST["password"];
						$level = $_POST["level"];
						try{ 
							$res = $db->createBenEntry($id,$login,$password,$level); 
								if ($res !== NULL){ 
									echo "<br/>Insert successfully!";
									//header("Location: index.php");
								}else echo "ERROR: Could not execute sqlquery. ";
						} catch (Exception $e){ 
							echo $e->getMessage(); 
						}
					}  
				}
		?>	
		<br/><a href="adminhome.php">Zurueck</a> 
		</body>
</html>