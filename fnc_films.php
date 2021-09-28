<?php
	$database = "if21_daniel_oj";	
	
	
	function read_all_films() {
	///loon andmebaasi : 
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["server_username"], $GLOBALS["server_pass"], $GLOBALS["database"]);
	/// valmistan eete sql käsu
	///SELECT * FROM film 
	$stmt = $conn->prepare("SELECT * FROM film");
	echo $conn->error;
	/// seome tulemused muutujatega
	$stmt->bind_result($title_from_db, $year_from_db, $duration_from_db, $genre_from_db, $studio_from_db, $director_from_db);
	///maarame correctse kooditabeli
	$conn->set_charset("utf8");
	///anname käsu täitmiseks
	$film_html=null;
	$stmt->execute();
	///vota andmed
	while($stmt->fetch ()){
	
	///paneme andmed meile soobivasse vormi
	/// <h3>filmipealkiri</h3>
	//<ul>
	//<li>1997</li>
	//<li>67</li>
	///...
	///</ul>
	$film_html .= "\n <h3>" .$title_from_db . "</h3> \n <ul> \n";
	$film_html .="<li> Valmimisaasta: " .$year_from_db . "</li> \n";
	$film_html .="<li> Kestus: " .$duration_from_db . "</li> \n";
	$film_html .="<li> ZANR: " .$genre_from_db . "</li> \n";
	$film_html .="<li> Tootja: " .$studio_from_db . "</li> \n";
	$film_html .="<li> Lavastaja: " .$director_from_db . "</li> \n";
	$film_html .= "</ul \n>";
	}
	///sulgeme käsu
	$stmt->close();
	///sulgeme andmebaasiuhendust
	$conn->close();
	return $film_html;
	}
	function store_film($title_input, $year_input, $duration_input,$genre_input, $studio_input, $director_input) {
			$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["server_username"], $GLOBALS["server_pass"], $GLOBALS["database"]);
			$conn->set_charset("utf8");
			///INSERT INTO FILM (pealkiri,aasta,kestus,zanr,tootja,lavastaja) VALUES("Suvi",1976,80,"Tallinnfilm", "Arvo Kruusement")
			$stmt = $conn->prepare("INSERT INTO film (pealkiri,aasta,kestus,zanr,tootja,lavastaja) VALUES(?,?,?,?,?,?)");
			echo $conn->error;
			///seome sql käsu pärisandmetega
			///andmetüübid: i - integer, d - decimal, s - string
			$stmt->bind_param("siisss", $title_input, $year_input, $duration_input,$genre_input, $studio_input, $director_input ) ;
			$success=null;
			if($stmt->execute()){
				$success="salvestamine õnnestus";
			} else{
				$success = "viga" .$stmt->error;

				$stmt->close();
					$conn->close();
	}
	}
	
	?>