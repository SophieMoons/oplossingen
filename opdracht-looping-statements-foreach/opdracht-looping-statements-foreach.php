<?php
#Deel 1
$tekst = file_get_contents('text-file.txt');

$tekstChars=str_split($tekst);

sort($tekstChars);
array_reverse($tekstChars); #omgekeerd alfabetisch geordend
array_flip($tekstChars); #indexvolgorde wordt verwisseld

$uniqueTemp=array_unique($tekstChars);
$uniqueChars=count($uniqueTemp);

$occurances = array_count_values($tekstChars);


$amountOfDiffChars = count($occurances);

#Deel 2

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">
</head>

<body>
	
	<section class="body">
		<h1>opdracht-looping-statements-foreach</h1>
		<h2>Deel 1</h2>
		<p>Er zijn <?= $amountOfDiffChars ?> verschillende characters</p>
		<br>
			<?php foreach($occurances as $item => $value): ?>
				<p> Er waren <?= $value ?> instanties van: <?= $item?> </p>
			<?php endforeach ?>
		<br>
		<h2>Deel 2</h2>


	</section>

</body>
</html>