<?php 
	include("class_dbcon.php");
?>

<html > 
 	<head> 
 		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 	 
 		<title>Registrieren von Person</title> 
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
	$showFormular = true;

if($showFormular){ ?>
	<h2>Bitte Formular ausfuehlen!</h2>
	<form action= "registr.php"  method="post">
		<input type="hidden" name="id">
		<p>Vorname:</p><input type="text" name= "vorname">
		<p>Name:</p><input type="text" name= "name">
		<p>Adresse:</p><input type="text" name= "adresse">
		<p>PLZ:</p><input type="text" name= "plz">	
		<p>Ort:</p><input type="text" name= "ort">
		<p>login/Email:</p><input type="text" name= "login">
		<br/>
		<br/>
		<input type="submit" name="send_bt" value="Absenden"> <input type = "submit" name = "return" value="Zurueck" /></p> 
	</form>
	<?php
	if(isset($_POST ["return"])){
		if($_POST["return"] == "Zurueck"){
			header("Location: index.php");
		}
	}
	$db = new dbcon();
	$error = false;	
	
	if(isset($_POST ["send_bt"])){
	
		if (empty($_POST["vorname"]) || empty($_POST["name"]) || empty($_POST["adresse"]) 
									|| empty($_POST["plz"]) || empty($_POST["ort"])|| empty($_POST["login"]) ){
			echo "Bitte alle Felder ausfuehlen!";
		} else {
			if($_POST["send_bt"] == "Absenden"){
				$vorname = $_POST["vorname"];
				$name = $_POST["name"];
				$adresse = $_POST["adresse"];
				$ort = $_POST["ort"];	
				$plz = $_POST["plz"];
				$login = $_POST["login"];
				// PLZ Pruefen			
				$nplz = "";
				if(!preg_match("/[A{1,}]-[0-9]{4}/",$plz,$nplz)) { 											
					echo "<br/>Ihre Eingabe <b>PLZ</b> ist leer oder ungueltig.<br /> 
					Bitte versuchen Sie es erneut wie zB: A-8010!";
					$plz ="";				
					echo"<br/><a href='registr.php'>Zurueck</a>";
					exit;
				} else $plz = $nplz[0];
				
				//Check ob Person schon Registriert wurde
				if(!$error) {
					try{ 
						$res = $db->getUserDet($login); 
						if ($res != NULL){ 	
							echo "Sie wurden schon regiestriert! Bitte Login!";
							// echo "<select name = pid>";
							// while ($dsatz = $res->fetch_object()){
								// echo "<option value='".$dsatz->id."'>(".$dsatz->id.") ".$dsatz->vorname." ".$dsatz->name ."</option>";
							// } 
							// echo "</select>";
							$error = true;						
						}else {
								echo "Noch nicht registriert!"; 				
								//Keine Fehler, wir koennen die Person registrieren
								
								$date=date('Y-m-d');
								$res = $db->createEntry($vorname, $name,$adresse,$plz,$ort,$date,$email); 
								if ($res != NULL){ 
									echo "<br/>Insert successfully!";
									$showFormular = false;
										//header("Location: index.php");
								}else echo "<br/>Beim Abspeichern ist leider ein Fehler aufgetreten!<br>"; 
						}
					}catch (Exception $e){ 
						echo $e->getMessage(); 
					}
				}
			} 
		}
	}
}		
?>
<body> 
</html>
 