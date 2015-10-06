<?php

#deel 1
$randGetal = rand(1,7);
$dag = '';

#if($randGetal == 1)
#{
#	$dag = 'maandag';
#}
#zo omslachtig...

switch($randGetal){ #veel beter, stel je voor... allemaal ifs
	case 1:
	$dag='maandag';
	break;

	case 2:
	$dag = 'dinsdag';
	break;

	case 3:
	$dag='woensdag';
	break;

	case 4:
	$dag='donderdag';
	break;

	case 5:
	$dag='vrijdag';
	break;

	case 6:
	$dag='zaterdag';
	break;

	case 7:
	$dag='zondag';
	break;
}

#deel 2
$teVervangenLetter = 'A';

$dagTemp = strtoupper($dag);
$dag2 = str_replace(($teVervangenLetter), (strtolower($teVervangenLetter)),$dagTemp);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<section>

		<h1>opdracht-conditional-statements-if</h1>

		<h2>Deel 1</h2>
		
		<p><?php echo($dag) ?></p> 

		<h2>Deel 2</h2>
		
		<p><?php echo($dag2) ?></p> 

	</section>

</body>
</html>
