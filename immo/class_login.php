<?php
class login
{
	public $errors = array();
	
	//Konstruktor 
	public function __construct() {
		require_once('class_dbcon.php');
	}
	
	//einloggen
	public function dologin() {
	// sind die Felder ausgefühlt?
		if (empty($_POST['username'])) { 
				$this->errors[] = "Usernamen angeben"; 
		}  
		if (empty($_POST['password'])) { 
			$this->errors[] = "Passwort angeben"; 
		} 
		// wenn ja vergleich mit DB
		if (count($this->errors) == 0){ 
		$db = new dbcon();
			try{
				$userdet = $db ->getUserDet($_POST['username']);
				if ($userdet != NULL){ // 
					if ($_POST['password'] == $userdet->password){ 
						 //Passwort sollte natürlich eigentlich verschlüsselt gespeichert sein und mit hash verglichen werden 
						$_SESSION['user'] = $userdet->login; //username in php session schreiben 
						$_SESSION['level'] = $userdet->level; 
						if ($_SESSION['level'] == 'kunde'){ 
							$knDetails = $db->getKNDetails($userdet->id); 
							$_SESSION['idkn'] = $knDetails->id; 
							$_SESSION['name'] = $knDetails->vorname." ".$knDetails->name; 
						} 
						else if ($_SESSION['level'] == 'makler'){ 
							$mkDetails = $db->getKNDetails($userdet->id); 
							$_SESSION['idmk'] = $mkDetails->id; 
							$_SESSION['name'] = $mkDetails->vorname." ".$mkDetails->name; 
						}
						else if ($_SESSION['level'] == 'admin'){ 
							$admDetails = $db->getKNDetails($userdet->id); 
							$_SESSION['idadm'] = $admDetails->id; 
							$_SESSION['name'] = $admDetails->vorname." ".$admDetails->name; 
						}	
					} else { 
						 $this->errors[] = "Username oder Passwort falsch.";  //Passwort falsch 
					} 
				} else { 
					 $this->errors[] = "Username oder Passwort falsch.";  //user existiert nicht 
				}  
			}catch (Exception $e) {
				$this->errors[] = $e->getMessage();
			}
	}
	return $this->errors;
	}
	//ausloggen
	public function dologout() {
		$_SESSION = array(); //Zur Sicherheit Session-Array löschen 
        session_destroy(); //Session löschen 	
	}
}
?>