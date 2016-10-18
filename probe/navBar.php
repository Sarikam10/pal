<nav class='navbar'> 
    <a href="index.php">Home</a> 
	| 
    <a href="imobilien.php">Immobilien</a> 
	| 
    <a href="makler.php">Makler</a>
	
     <?php 
		if(isset($_SESSION["user"])) { //check if user is logged in ?>  
	|
    <a href="logout.php">Logout</a> 
	<!--<br/><a href="suche.php">Suche</a>-->
  
     <?php } else{ ?>  
                <a href="login.php">Login</a>				
     <?php }
			if ( $_SESSION["level"] == 'admin' ||$_SESSION["level"] == 'makler' ){
	 ?>  
			<br/><a href="personen.php">Alle Personen</a>
			| 
				<a href="kunden.php">Kunden</a> 	
			<br/>
				<a href="insertForm.php">Insert neue Person</a>			
			|
				<a href="updateFormPers.php">Bearbeiten oder Loeschen Person</a>
			<br/>
				<!--<a href="insertBenForm.php">Insert Benutzer</a>
			|
				<a href="updateFormBenutzer.php">Bearbeiten oder Loeschen Benutzer</a> -->				
	<?php } ?>
 </nav> 