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
		<title>INSERT</title>
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
				
				// Einfügen von Personen 
				if(isset($_POST ["send_bt"])){
					if (empty($_POST["vorname"]) || empty($_POST["name"]) || empty($_POST["adresse"]) 
								|| empty($_POST["plz"]) || empty($_POST["ort"])){
						echo "Bitte alle Felder ausfuehlen!";
					}
					if($_POST["send_bt"] == "Senden"){
						$vorname = $_POST["vorname"];
						$name = $_POST["name"];
						$adresse = $_POST["adresse"];
						$plz = $_POST["plz"];
						// PLZ Pr?fen			
						$nplz = "";
						if(!preg_match("/[A{1,}]-[0-9]{4}/",$plz,$nplz)) { 											
							echo "<br/>Ihre Eingabe <b>PLZ</b> ist leer oder ungueltig.<br /> 
							Bitte versuchen Sie es erneut wie zB: A-8010!";	
							$plz ="";
							echo"<br/><a href='insertForm.php'>Zurueck</a>";
							exit;
						} else $plz = $nplz[0];						
						$ort = $_POST["ort"];
						$datum = $_POST["datum"]; //dieses Fromatieren						 
						$date = date_create($datum);
						$new_date = date_format($date,"Y-m-d "); //fromatiert
						$login = $_POST["login"];
						$password = $_POST["password"];
						$level = $_POST["level"];
						try{ 
							if(!empty($vorname) ||!empty($name) ||!empty($adresse) ||!empty($plz) ||!empty($ort) || !empty($login) || !empty($password) || !empty($level)){
								$res = $db->createNew($vorname,$name,$adresse,$plz,$ort,$new_date,$login,$password,$level); 
								if ($res !== NULL){ 
									echo "<br/>Insert successfully!";
									//header("Location: index.php");
								}else echo "ERROR: Could not execute sqlquery. ";
							}
						} catch (Exception $e){ 
							echo $e->getMessage(); 
						}
					}  
				}
		?>
		<br/><a href="adminhome.php">Zurueck</a> 
		</body>
</html>