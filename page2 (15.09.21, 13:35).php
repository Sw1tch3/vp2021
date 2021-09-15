<?php
	$author_name = "Daniel Ojala" ;

	$full_time_now = date("d.m.Y H:i:s");
	$weekday_now = date ("N");
	$day_category = "lihtsalt paev";
	//echo $weekday_now;
	//	võrdub == suurem/väiksem ... < >    <=  >= pole võrdne (excelis <>) !=
	if($weekday_now <= 5) {
		$day_category = "koolipäev";
	} else {
		$day_category = "puhkepäev"; 
	}
	$weekday_names_et = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev" , "pühapäev"];
	//echo weekday_names_et
	if($full_time_now <7 or $full_time_now > 23){
		$part_of_day = "uneaeg";
	}
	if($full_time_now >=8 and $full_time_now < 18){
		$part_of_day = "work time)";
	}
	else{
		$part_of_day ="dussiaeg (puhkeaeg)";
        }
	
	//juhuslikku photo lisamine
	$photo_dir = "photos/" ;
	//loen kataloogi sisu
	$all_files = scandir($photo_dir);
	$all_real_files = array_slice($all_files, 2);
	
	//sõelume välja päris pilt
	$photo_files = [];
	$allowed_photo_files = ["image/jpeg", "image/png", "image/jfif"];
	foreach($all_real_files as $file_name) {
		$file_info = getimagesize($photo_dir .$file_name);
		if(isset($file_info["mime"])){
			if(in_array($file_info["mime"], $allowed_photo_files)){
				array_push($photo_files, $file_name);
			}// if  in array
		} // if isset lõppeb
	} //foreach lõppes
	
	
	//var_dump($all_real_files);
	//loen massivi elementid kokku
	$file_count = count($photo_files);
	//loosin juhuslikku arvu (min peab olema 0 ja max count - 1)
	$photo_num = mt_rand(0, $file_count - 1);
	//<img src="kataloog/fail" alt="tore pilt">
	$photo_html = '<img src="" ' . $photo_dir . $photo_files[$photo_num] .  '"alt="tore pilt">';
	///kontrolin, kas post jouab kuhugi
	//var_dump($_POST);
	///kontrollime kaas klikiti submit
	$todays_adjective_html = null; ///$todays_adjective_html = "null"
	$todays_adjective_error = null; ///esialgus errorit ei ole
	$todays_adjective = null;
	if (isset($_POST["adjective_submit"])) {
		///echo "klikiti!";
		///<p> Tanane paev on tuuline.</p>
		///kontrollime,kas mingi kirjutati ka
		if (!empty($_POST["todays_adjective_input"])) {

		$todays_adjective_html = "<p> tanane paev on " .$_POST["todays_adjective_input"] . " . </p> ";
		$todays_adjective = $_POST["todays_adjective_input"];
			}
			else { 
				$todays_adjective_error = "palun sisesta tanase kohta sobiv omadussona!";
			}
		}
	$full_time_now = date("d.m.Y H:i:s");
	$weekday_now = date ("N");
	$day_category = "lihtsalt paev";


	///tsukkel
	///naiteks:
	/// <ul>
	/// failinimi
	/// filinimi
	///...
	/// </ul>
	$photo_list_html = "\n <ul> \n " ;
	for ($i=0; $i < $file_count ; $i++) { 
		$photo_list_html = "<li>" . $photo_files[$i] . "</li> \n";
	}
	$photo_list_html =  "</ul> \n" ;

/*	<select name ="photo_select">

	</select> */
	$photo_select_html = "\n" . '<select name ="photo_select">' . "\n " ;
	for ($i=0; $i < $file_count ; $i++) { 
		$photo_select_html = '<option value="' . $i . '">' .$photo_files[$i] ."</option \n >";
	}
	$photo_select_html =  "</ul> \n" ;

	?>

<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title><?php echo $author_name; ?></title>
</head>
<body>
	<h1><?php echo $author_name; ?></h1>
	<p>See leht on loodud õppetöö raames ja ei sisalda tõsisevõetavat sisu!</p>
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt/">TLU digitehnoloogiate instituudis</a></p>
		<hr>
			<form method="POST">
				<input type="text" placeholder="kuidas paev on" name="todays_adjective_input" value="<?php echo $todays_adjective; ?>">
				<input type="submit" name="adjective_submit" value="Saada">
				<span> <?php echo $todays_adjective_error; ?> </span>
			<form>
			<?php echo $todays_adjective_html; ?> 
		<hr>
	<img src="photo1.jpg" alt="TLU Mare hoone" width="600">
	<p>Lehe avamise hetk: <?php echo $weekday_names_et [$weekday_now - 1] .", " . $full_time_now . ", "  . $day_category . "," . $part_of_day; 	?> . </p>
	<hr>
	<form method="POST">
		 <?php echo $photo_select_html; ?>
	</form>
	<hr>
	<?php echo $photo_html; 
	 echo $photo_list_html;?> 
	
	
</body>
 
</html>