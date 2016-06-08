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
	<?php 
		try {
			if (isset($_POST ["bt_update"])){
				if (!isset($_POST['action_radio'])){
					echo "Bitte ein Person zum Bearbeiten auswaehlen!";
					echo"<p><a href='updateFormBenutzer.php'>Zurueck</a></p>";
					exit;
				}else				
				if ($_POST['action_radio']){				
					if($_POST["bt_update"] == "Bearbeiten"){
						$val_id = $_POST['action_radio']; ?>						
						<form action= "updateBenutzer.php" method="POST"> 
						<?php
						$db = new dbcon();
						$res = $db-> getBenDetails($val_id);						
						if ($res != NULL){
							$login = $res->login;
							$password = $res->password;
							$level = $res->level;
						} else echo "ERROR: Could not execute sqlquery. ";
					}
								
				}
			} else if(isset($_POST['updateEX'])){
				$db = new dbcon();
	
					$login =  $_POST['login']; 						 
					$password = $_POST['password'];
					$level = $_POST['level'];	
					if($level =='admin' || $level =='kunde' || $level =='makler' ){
						$id = $_POST['id'];	
						$res = $db->update($id, $login,$password,$level); 
						if ($res !== NULL){ 
							echo "<br/>Update successfully!";
							header("Location: updateFormBenutzer.php");
						} else echo "ERROR: Could not execute sqlquery. ";	
					}  else {
						echo "Moegliche Levels: admin, kunde oder makler!";
						echo"<p><a href='updateFormBenutzer.php'>Zurueck</a></p>";
						exit;
					}
			} else if(isset($_POST["bt_delete"] )) {
						$val_id = $_POST['action_radio'];
						$db = new dbcon();
						$resben = $db->getBenDetails($val_id); // Info ueben Benutzer
						$result = $db->getAnzBen($val_id);		// viewiele Benutzer sind
						$mak = $db->getMaklerImo($val_id); // gibt makler zurück die für Immob verantwortlich ist
						if($result == 1 && $resben->level == 'admin'){
							echo"Loeschen von letztes Admin nicht moeglich!";
							echo"<br/><a href='updateFormBenutzer.php'>Zurueck</a>";
							exit;
						} else if ($mak){
							echo"Der Makler ist fuer ein Immobilien verantwortlich->nicht Loeschbar!";
							echo"<br/><a href='updateFormPers.php'>Zurueck</a>";
							exit;
						} else
							$res = $db->delete($val_id);
							//print_r($res);	
							if ($res != NULL){
								echo "<br/>Delete successfully!";
								header("Location: updateFormBenutzer.php");
							} else echo "ERROR: Could not execute sqlquery. ";
			} else if(isset($_POST['return'])) header("Location: updateFormBenutzer.php");
			
		} catch (Exception $e){ 
			echo $e->getMessage(); 
		}
	?>	
		<input type="hidden" name="id" value="<?php echo $val_id?>">
		<p>Login:</p><input type="text" name= "login" value="<?php echo $login?>" >
		<p>Password:</p><input type="password" name= "password" value="<?php echo $password?>">
		<p>Level:</p><input type="text" name= "level" value="<?php echo $level?>">
		<br/>
		<br/>
		<input type="submit" name="updateEX" value="UPDATE"> <input type="submit" name="return" value="Zurueck">
	</form>
				
	</body> 
</html>