<?php
class dbcon 
{
	private $con = NULL;
	public $errors = array();
	
	//Mit DB verbinden
	public function connect() {
	require_once ('config.php');
	$this->con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);		
	}
	
	//verbindung schli?en
	public function close() {
	$this->con->close();	
	}
		
	//Personen Infos abfragen abhengig von login
	public function getUserDet($user) {
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler 
			if($user !=NULL) {
				$userName = $this->con->real_escape_string($user);
				$sql=  "SELECT * FROM person
						WHERE login ='" . $user. "'";
				$result = $this->con->query($sql);
				if($result != NULL) {
					$row = $result->fetch_object();
					$this->close();
					return ($row);
				}				
			}
		} else throw new Exception ('Keine DB_Verbindung!');
		return NULL; 
	}
	
	//Personen Infos abfragen abhengig von id
	public function getUser_id($id) {
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler 
			if($id !=NULL) {
				$sql=  "SELECT * FROM person p
						WHERE p.id ='" . $id. "'";
				$result = $this->con->query($sql);
				if($result !=NULL) {
					$row = $result ->fetch_object();
					$this->close();
					return ($row);
				}				
			}
		} else throw new Exception ('Keine DB_Verbindung!');
		return NULL;			
	}
	
	//Makler oder Kunde abfragen von level
	public function getPersDetails($strg){
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler 
			if($strg !=NULL) {
				$sql="SELECT * FROM person p 
						WHERE p.level = '".$strg."'";
				$result = $this->con->query($sql);
				if($result !=NULL) {
					$this->close();
					return ($result);
				}				
			}
		} else throw new Exception ('Keine DB_Verbindung!');
		return NULL;			
	}
	
	// Alle Personen ausgeben
	public function getAllPersDetails() {
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler 
				$sql=  "SELECT * FROM person p";					
				$result = $this->con->query($sql);
				if($result !=NULL) {
					$this->close();
					return ($result);
				}				
		} else throw new Exception ('Keine DB_Verbindung!');
		return NULL;			
	}
	
	// Alle Personen die noch keine Logindaten angelegt haben
	public function getPersWithoutLogin($email){
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler 
				$sql=  "SELECT * FROM person p
						WHERE p.login/Email ='".$email."' OR p.password =''";
				$result = $this->con->query($sql);
				echo"$result";
				if($result !=NULL) {
					$this->close();
					return ($result);
				}				
		} else throw new Exception ('Keine DB_Verbindung!');
		return NULL;			
	}
		
	// Makler verantwortlich fuer Imobilien
	public function getMaklerImo($id) {
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler 
				$sql=  "SELECT * FROM person p, immobilien i WHERE p.id = p_id AND i.p_id = $id";
				$result = $this->con->query($sql);
				if($result !=NULL) {
					$row = $result->fetch_object();
					$this->close();
					return ($row);
				}				
		} else throw new Exception ('Keine DB_Verbindung!');
		return NULL;			
	}
	
	// Tabelle mit Immobilien
	public function getImmo() {
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler 
				$sql=  "SELECT art, pdf FROM dokumente d , immobilien i WHERE d.immob_id = i.id" ;
				$result = $this->con->query($sql);
					$this->close();
					return ($result);				
		} else throw new Exception ('Keine DB_Verbindung!');		
	}  
	
	// Insert Person ohne LoginDatenin/Registrierung Tabelle
	public function createEntry($vorname,$name,$adresse,$plz,$ort,$jetzt,$email){
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler
				//$jetzt = date('Y-m-d');
				$sql=  "INSERT INTO person (`vorname`, `name`, `adresse`, `plz`, `ort`,`datum`,`login/Email`) VALUES ('$vorname','$name','$adresse','$plz','$ort','$jetzt','$email')" ;
				$result = $this->con->query($sql);				
				if (!$result) {
				   printf("</br>Errormessage: %s\n", $this->con->error);
				}
				$this->close();
				return ($result);				
		} else throw new Exception ('Keine DB_Verbindung!');
	}	
	
	// Insert neue Person in Tabelle
	public function createNew($vorname,$name,$adresse,$plz,$ort,$jetzt,$login,$password,$level){
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler
				//$jetzt = date('Y-m-d');
				$sql=  "INSERT INTO person (`vorname`, `name`, `adresse`, `plz`, `ort`,`datum`, `login`,`password`,`level`) VALUES ('$vorname','$name','$adresse','$plz','$ort','$jetzt', '$login','$password','$level')" ;
				$result = $this->con->query($sql);				
				if (!$result) {
				   printf("</br>Errormessage: %s\n", $this->con->error);
				}
				$this->close();
				return ($result);				
		} else throw new Exception ('Keine DB_Verbindung!');
	}	
	
	// Update Person in Tabelle
	function update($id,
	$login,$password,$level){
		if ($id != NULL){
			$this-> getUser_id($id);
			$this->connect();  //verbinden
			if(!$this->con->connect_errno) {
				$sql= "UPDATE person SET login='$login', password ='$password', level ='$level' 
					   WHERE id='$id'" ;
				$result = $this->con->query($sql);
				if (!$result ) {
				   printf("</br>Errormessage: %s\n", $this->con->error);
				}
				$this->close();
				return ($result);
			}
		} else throw new Exception ('Keine Person ausgewaelt!');
	}
	// Select anzahl Benutzer
	function getAnzPerson($id){
		$this->connect();  //verbinden
			if(!$this->con->connect_errno) {
				$sql="SELECT COUNT(*) as anzahl FROM person WHERE id='$id'";
				echo"<br/>";
				$result = $this->con->query($sql);
				$benutzerExists = $result->fetch_object()->anzahl;
				return ($benutzerExists);
			} else {
				die("failed to connect to db.");
			}
	}
	
	// Update Person in Tabelle
	function updatePers($id,$vorname,$name,$adresse,$plz,$ort,$datum,$login,$password,$level){
		if(!preg_match("/[A{1,}]-[0-9]{4}|[0-9]{4}/",$plz,$nplz)) { 											
			echo "<br/>Ihre Eingabe <b>PLZ</b> ist leer oder ungueltig.<br /> 
			Bitte versuchen Sie es erneut wie zB: A-8010!";							
			echo"<br/><a href='updatePers.php'>Zurueck</a>";
		} else $plz = $nplz[0];		
		$date = date_create($datum);
		$new_date = date_format($date,"Y-m-d ");
			if ($id != NULL){
				$this-> getUser_id($id);
				$benutzerExists = $this->getAnzPerson($id);
				if ($benutzerExists == 0) {
					return $this->createBenEntry($id,$login,$password,$level);
				} else {
					$this->connect();  //verbinden
					$sql1= "UPDATE person SET vorname='$vorname', name ='$name', adresse ='$adresse', plz= '$plz', ort = '$ort',datum= '$new_date'
					   WHERE id='$id'";
					$res = $this->con->query($sql1);					
					if (!$res) {
					   printf("</br>Errormessage: %s\n", $this->con->error);
					}
					return $this->update($id,$login,$password,$level);
				} 
			} else throw new Exception ('Keine Person ausgewaelt!');
			return NULL;
	}
	
	// Delete Benutzer in Tabelle
	function delete($id){
		if ($id != NULL){
			$this->connect();  //verbinden
			if(!$this->con->connect_errno) {
				$sql= "DELETE FROM benutzer WHERE id='$id'" ;
				$result = $this->con->query($sql);				
					if (!$result) {
					   printf("</br>Errormessage: %s\n", $this->con->error);
					}
					$this->close();
					return ($result);
			}
		} else throw new Exception ('Keine Person ausgewaelt!');
	}
	// Delete Person in Tabelle
	function deletePers($id){
		if ($id != NULL){
			$this->connect();  //verbinden
			if(!$this->con->connect_errno) {
				$sql= "DELETE FROM person WHERE id='$id'" ;
				$result = $this->con->query($sql);				
					if (!$result) {
					   printf("</br>Errormessage: %s\n", $this->con->error);
					}
					$this->close();
					return ($result);
			}
		} else throw new Exception ('Keine Person ausgewaelt!');
	}	
}
?>