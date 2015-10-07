<?php

/*Sophie Moons
moonssophie@gmail.com*/ 
	
	$naam	="Sophie";
	$achternaam="Moons";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">
	<title>Opdracht Comments()</title>
</head>
<body>

	<section>

		<h1>opdracht-comments</h1>
		
		<p><?= $naam . '&nbsp'. $achternaam ?></p> 
		<!--&nbsp = beter als spatie omdat de html soms ' ' gewoon negeert-->

	</section>

</body>
</html>
