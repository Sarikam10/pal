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
	<?php 
		try {
			if (isset($_POST ["bt_update"])){
				if (!isset($_POST['action_radio'])){
					echo "Bitte ein Person zum Bearbeiten auswaehlen!";
					echo"<p><a href='updateFormPers.php'>Zurueck</a></p>";
					exit;
				}else				
				if ($_POST['action_radio']){				
					if($_POST["bt_update"] == "Bearbeiten"){
						$val_id = $_POST['action_radio'];
		?>					
						<form action= "updatePers.php" method="POST"> 
						<?php
							$db = new dbcon();
							$res = $db->getUser_id($val_id);							
							if ($res != NULL ){
								$vorname = $res->vorname;
								$name = $res->name;
								$adresse = $res->adresse;
								$plz = $res->plz;													
								$ort = $res->ort;
								$datum = $res->datum;
								$login = $res->login;
								$password = $res->password;
								$level= $res->level;
							}				
					} 
				}
				
			} else if(isset($_POST['updateEX'])){		
				$db = new dbcon();
				$vorname = $_POST['vorname'];
				$name = $_POST['name'];
				$adresse = $_POST['adresse']; 				
				// PLZ Pr?fen
				$plz = $_POST['plz'];
				$nplz = "";
				if(!preg_match("/[A{1,}]-[0-9]{4}|[0-9]{4}/",$plz,$nplz)) { 											
					echo "<br/>Ihre Eingabe <b>PLZ</b> ist leer oder ungueltig.<br /> 
					Bitte versuchen Sie es erneut wie zB: A-8010!";							
					echo"<br/><a href='updatePers.php'>Zurueck</a>";
				} else $plz = $nplz[0];	
				$ort = $_POST['ort'];
				$datum =  $_POST['datum']; //dieses Fromatieren						 
				$date = date_create($datum);
				$new_date = date_format($date,"Y-m-d "); //fromatiert	
				$login=  $_POST['login'];
				$password=  $_POST['password'];
				$level=  $_POST['level'];
				$res = $db->updatePers($_POST['id'],$_POST['vorname'],$_POST['name'],$_POST['adresse'],$_POST['plz'],$_POST['ort'],$new_date,$_POST['login'],$_POST['password'],$_POST['level']);  
				if ($res != NULL){ 
					echo "<br/>Update successfully!";
					header("Location: updateFormPers.php");
				} else echo "ERROR: Could not execute sqlquery. ";
				
			} else if($_POST["bt_delete"] == "Loeschen") {
				$val_id = $_POST['action_radio'];
				$db = new dbcon();
				if($val_id != NULL ) {						
					$res = $db->getUser_id($val_id);
					// print_r($res);
					// check ob nicht der l?tzter admin ist, der darf nicht gel?scht sein!
					$result = $db-> getAnzPerson($val_id);
					// echo"<br/>";
					// print_r($result);
					// echo"<br/>";		
					$mak = $db->getMaklerImo($val_id);
					if($result == 1 && $res->level == 'admin'){
						echo"Loeschen von letztes Admin nicht moeglich!";
						echo"<br/><a href='updateFormPers.php'>Zurueck</a>";
						exit;
					} else if ($res && !$mak){
						$resdben = $db->delete($val_id);
						$res = $db->deletePers($val_id);
					} else if ($mak){
						echo"Der Makler ist fuer ein Immobilien verantwortlich->nicht Loeschbar!";
						echo"<br/><a href='updateFormPers.php'>Zurueck</a>";
						exit;
					} else 
					$res = $db->deletePers($val_id);
					if ($res != NULL){
						echo "<br/>Delete successfully!";
						header("Location: updateFormPers.php");
					} else echo "ERROR: Could not execute sqlquery. ";
				}
			} else if(isset($_POST['return'])) {
				header("Location: updateFormPers.php");
			}
		} catch (Exception $e){ 
			echo $e->getMessage(); 
		}
	?>	
						<input type="hidden" name="id" value="<?php echo $val_id?>">
						<p>Vorname:</p><input type="text" name= "vorname" value="<?php echo $vorname?>" >
						<p>Name:</p><input type="text" name= "name" value="<?php echo $name?>">
						<p>Adresse:</p><input type="text" name= "adresse" value="<?php echo $adresse?>">
						<p>PLZ:</p><input type="text" name= "plz" value="<?php echo $plz?>">	
						<p>Ort:</p><input type="text" name= "ort" value="<?php echo $ort?>">	
						<p>Datum:</p><input type="text" name= "datum" value="<?php echo $datum?>">
						<p>Login:</p><input type="text" name= "login" value="<?php echo $login?>">
						<p>Password:</p><input type="password" name= "password" value="<?php echo $password?>">
						<p>Level:</p><select name="level"><option value="kunde">kunde</option><option value="makler">makler</option>
							<option value="admin">admin</option><option selected="selected"><?php echo $level?></option></select></p>
						<br/><br/>
						<input type="submit" name="updateEX" value="UPDATE"> <input type="submit" name="return" value="Zurueck">
					</form>
					
					
	</body> 
</html>