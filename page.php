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
	$photo_html = '<img src=" ' . $photo_dir . $photo_files [$photo_num] .  '"alt="tore pilt">';
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
	<img src="photo1.jpg" alt="TLU Mare hoone" width="600">
	<p>Lehe avamise hetk: <?php echo $weekday_names_et [$weekday_now - 1] .", " . $full_time_now . ", "  . $day_category . "," . $part_of_day; 	?> . </p>
	<?php echo $photo_html; ?>
	
</body>
 
</html>