<?php

function __autoload($Animals)
{
   include "classes/".$Animals.".php";
}

$name1 = 'Shawon';
$name2 = 'Shakeela';
$name3 = 'Shapoopy';
$name4 = "Shaquila";
$name5 = "Tootsypop";
$name6 = "Shumona";
$name7 = "Konan";

$gender1 = 'Wijf';
$gender2 = 'Wijf';
$gender3 = 'GAST';
$gender4 = "Wijf";
$gender5 = "GAST";
$gender6 = "GAST";
$gender7 = "I dunno";

$health1 = 130;
$health2 = 143;
$health3 = 168;
$health4 = 205;
$health5 = 1499;
$health6 = 1000000;
$health7 = 20;

$species1 = "Een leeuw";
$species2 = "Sexy leeuw";
$species3 = "Sexy zebra";
$species4 = "Semi-aantrekkelijke zebra";

$animal1 = new Animal($name1, $gender1, $health1);
$animal2 = new Animal($name2, $gender2, $health2);
$animal3 = new Animal($name3, $gender3, $health3);

$animal2->changeHealth(50);

$lion1 = new Lion($name4, $gender4, $health4, $species1);
$lion2 = new Lion($name5, $gender5, $health5, $species2);

$zebra1 = new Zebra($name6, $gender6, $health6, $species3);
$zebra2 = new Zebra($name7, $gender7, $health7, $species4);


?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://web-backend.local/css/global.css">
    <link rel="stylesheet" href="http://web-backend.local/css/facade.css">
    <link rel="stylesheet" href="http://web-backend.local/css/directory.css">
</head>

<body>
		<h1>Opdracht-classes-extends</h1>
			<h2>Animal klasse:</h2>
<p> <?php echo $animal1->getName()?> is van het geslacht <?php echo $animal1->getGender()?> en heeft momenteel <?php echo $animal1->getHealth()?> levenspunten: <?php echo $animal1->doSpecialMove() ?> </p> 
<p> <?php echo $animal2->getName()?> is van het geslacht <?php echo $animal2->getGender()?> en heeft momenteel <?php echo $animal2->getHealth()?> levenspunten: <?php echo $animal2->doSpecialMove() ?> </p> 
<p> <?php echo $animal3->getName()?> is van het geslacht <?php echo $animal3->getGender()?> en heeft momenteel <?php echo $animal3->getHealth()?> levenspunten: <?php echo $animal3->doSpecialMove() ?> </p> 
			
			<h2>Lion klasse:</h2>
<p> De speciale move van <?php echo $lion1->getName()?> (soort: <?php echo $lion1->getSpecies()?>): <?php echo $lion1->doSpecialMove() ?> </p> 
<p> De speciale move van <?php echo $lion2->getName()?> (soort: <?php echo $lion2->getSpecies()?>): <?php echo $lion2->doSpecialMove() ?> </p> 

			<h2>Zebra klasse:</h2>
<p> De speciale move van <?php echo $zebra1->getName()?> (soort: <?php echo $zebra1->getSpecies()?>): <?php echo $zebra1->doSpecialMove() ?> </p> 
<p> De speciale move van <?php echo $zebra2->getName()?> (soort: <?php echo $zebra2->getSpecies()?>): <?php echo $zebra2->doSpecialMove() ?> </p> 
</body>
</body>
</html>