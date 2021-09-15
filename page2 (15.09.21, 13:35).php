<?php
	$author_name = "Daniel Ojala" ;
	///kontrolin, kas post jouab kuhugi
	var_dump($_POST);
	$full_time_now = date("d.m.Y H:i:s");
	$weekday_now = date ("N");
	$day_category = "lihtsalt paev";
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
				<input type="text" placeholder="krediitkardi andmed" name="todays_adjective_input">
				<input type="submit" name="adjective_submit" value="Saada">
			<form>
		<hr>
	<img src="photo1.jpg" alt="TLU Mare hoone" width="600">
	
</body>
 
</html>