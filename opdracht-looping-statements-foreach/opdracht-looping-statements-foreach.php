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

foreach($occurances as $item => $value)
{	
$occuranceTemp[]="<p>Er waren ".$value." instanties van: ".$item;
}

$occuranceList=implode("</p>", $occuranceTemp);
$amountOfDiffChars = count($occuranceTemp);

#Deel 2

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
	
	<section class="body">
		<h1>opdracht-looping-statements-foreach</h1>
		<h2>Deel 1</h2>
		<p>Er zijn <?php echo($amountOfDiffChars)?> verschillende characters</p>
		<br>
		<p><?php echo($occuranceList)?></p>
		<br>
		<h2>Deel 2</h2>


	</section>

</body>
</html>