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
	
	//verbindung schlißen
	public function close() {
	$this->con->close();	
	}
		
	//User Infos abfragen
	public function getUserDet($user) {
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler 
			if($user !=NULL) {
				$userName = $this->con->real_escape_string($user);
				$sql=  "SELECT * FROM benutzer
						WHERE login ='" . $user. "'";
				$result = $this->con->query($sql);
				if($result !=NULL) {
					$row = $result->fetch_object();
					$this->close();
					return ($row);
				}				
			}
		} else throw new Exception ('Keine DB_Verbindung!');
		return NULL; 
	}
	
	//Personen Infos abfragen
	public function getKNDetails($id) {
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
	
	//Makler oder Kunde abfragen
	public function getPersDetails($strg){
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler 
			if($strg !=NULL) {
				$sql=  "SELECT p.vorname, p.name, p.adresse, p.plz, p.ort, p.datum,b.level
						FROM person p, benutzer b
						WHERE p.id = b.id 
						AND b.level = '".$strg."'";
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
				$sql=  "SELECT p.id, p.vorname, p.name, p.adresse, p.plz, p.ort, p.datum
						FROM person p";					
				$result = $this->con->query($sql);
				if($result !=NULL) {
					$this->close();
					return ($result);
				}				
		} else throw new Exception ('Keine DB_Verbindung!');
		return NULL;			
	}
	
	// Alle Personen die noch keine Benutzer angelegt haben
	public function getPersWithoutUser(){
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler 
				$sql=  "SELECT *
				FROM person p
				WHERE p.id not in (SELECT b.id FROM benutzer b)";
				$result = $this->con->query($sql);
				if($result !=NULL) {
					$this->close();
					return ($result);
				}				
		} else throw new Exception ('Keine DB_Verbindung!');
		return NULL;			
	}
	
	// Info Benutzer ausgeben
	public function getBenDetails($id) {
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler 
				$sql=  "SELECT *
						FROM  benutzer b
						WHERE b.id = $id";
				//echo $sql;
				$result = $this->con->query($sql);
				if($result !=NULL) {
					$row = $result->fetch_object();
					$this->close();
					// print_r($row);
					return ($row);
				}				
		} else throw new Exception ('Keine DB_Verbindung!');
		return NULL;			
	}
	
	// Makler verantwortlich für Imobilien
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
	
	// Info mit ausgewaehlte Person_Level
	public function getAllBenutzerDetails_id($id) {
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler 
				$sql=  "SELECT p.id, p.vorname, p.name, p.adresse, p.plz, p.ort, p.datum,b.login, b.password,b.level
						FROM person p
						LEFT JOIN benutzer b
						ON p.id = b.id
						HAVING p.id = $id";		
				$result = $this->con->query($sql);
				if($result !=NULL) {
					$row = $result ->fetch_object();
					$this->close();
					return ($row);
				}
		} else throw new Exception ('Keine DB_Verbindung!');
		return NULL;			
	}
	public function getAllPersonBenutzerDetails() {
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler 
				$sql=  "SELECT p.id, p.vorname, p.name, p.adresse, p.plz, p.ort, p.datum,b.login, b.password,b.level
						FROM person p
						LEFT JOIN benutzer b
						ON p.id = b.id";		
				$result = $this->con->query($sql);
				if($result !=NULL) {					
					$this->close();
					return ($result);
				}
		} else throw new Exception ('Keine DB_Verbindung!');
		return NULL;			
	}
	
	// Alle Benutzer ausgeben
	public function getAllBenutzerDetails(){
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler 
				$sql=  "SELECT p.id, p.vorname, p.name, p.adresse, p.plz, p.ort, p.datum,b.login, b.password,b.level
						FROM person p, benutzer b
						WHERE p.id = b.id";
				$result = $this->con->query($sql);
				if($result !=NULL) {
					$this->close();
					return ($result);
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
	
	// Insert Person in Tabelle
	public function createEntry($vorname,$name,$adresse,$plz,$ort,$jetzt){
		$this->connect();  //verbinden
		if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler
				//$jetzt = date('Y-m-d');
				$sql=  "INSERT INTO person (`vorname`, `name`, `adresse`, `plz`, `ort`,`datum`) VALUES ('$vorname','$name','$adresse','$plz','$ort','$jetzt')" ;
				$result = $this->con->query($sql);				
				if (!$result) {
				   printf("</br>Errormessage: %s\n", $this->con->error);
				}
				$this->close();
				return ($result);				
		} else throw new Exception ('Keine DB_Verbindung!');
	}	
	
	// Insert Benutzer in Tabelle
	public function createBenEntry($id,$login,$password,$level){
		$db = new dbcon();
		$ben = $db->getBenDetails($id);
		if($ben){
			echo" Diese Benutzer ist schon eingelegt!";
			echo"<br/><a href='insertBenForm.php'>Zurueck</a>";							
			exit;
		} else {
			$this->connect();  //verbinden
			if(!$this->con->connect_errno) { //DB Verbindung funktioniert, wenn keine Fehler
					
					$sql=  "INSERT INTO benutzer (`id`,`login`, `password`, `level`) VALUES ('$id','$login','$password','$level')";
					$result = $this->con->query($sql);				
					if (!$result) {
					   printf("</br>Errormessage: %s\n", $this->con->error);
					}
					$this->close();
					return ($result);				
			} else throw new Exception ('Keine DB_Verbindung!');
		}
	}	
	
	// Update User in Tabelle
	function update($id,$login,$password,$level){
		if ($id != NULL){
			$this-> getAllBenutzerDetails_id($id);
			$this->connect();  //verbinden
			if(!$this->con->connect_errno) {
				$sql= "UPDATE benutzer SET login='$login', password ='$password', level ='$level' 
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
	function getAnzBen($id){
		$this->connect();  //verbinden
			if(!$this->con->connect_errno) {
				$sql="SELECT COUNT(*) as anzahl FROM benutzer WHERE id='$id'";
				echo"<br/>";
				$result = $this->con->query($sql);
				$benutzerExists = $result->fetch_object()->anzahl;
				return ($benutzerExists);
			} else {
				die("failed to connect to db.");
			}
	}
	
	// Update Person in Tabelle
	function updatePers($id,$vorname,$name,$adresse,$plz,$ort,$datum,$login, $password,$level){
		if(!preg_match("/[A{1,}]-[0-9]{4}|[0-9]{4}/",$plz,$nplz)) { 											
			echo "<br/>Ihre Eingabe <b>PLZ</b> ist leer oder ungueltig.<br /> 
			Bitte versuchen Sie es erneut wie zB: A-8010!";							
			echo"<br/><a href='updatePers.php'>Zurueck</a>";
		} else $plz = $nplz[0];		
		$date = date_create($datum);
		$new_date = date_format($date,"Y-m-d ");
			if ($id != NULL){
				$this-> getAllBenutzerDetails_id($id);
				$benutzerExists = $this->getAnzBen($id);
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