<?php
	session_start();

    #Data vorige php
 	if (isset($_POST['submit']))
    {
        $_SESSION['toDoItem'] = $_POST['toDoItem'];
        	$toDoItems = array_values($_POST); //alle geposte values komen in de array te staan

    }

	#check eerst of deze geset is, dan slaag je gegevens op in sessie
	if(isset($_SESSION['toDoItem']))
	{
		$ToDo = $_SESSION['toDoItem'];
	}

	$toDoItems = array_values($_POST); //alle geposte values komen in de array te staan
	$itemStatus = "incomplete";
	$completedList = incompleteInArray('incomplete', $toDoItems); //bool om te checken of de lijst voltooid is

	function incompleteInArray($needle, $haystack, $strict = false) //zit er een incomplete to-do item in de array?
	{
    	foreach ($haystack as $item) 
    	{
        	if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) 
       	 	{
       	    	return true;
        	}
    	}
    
    	return false;
	}

	var_dump($toDoItems); //raar... toevoegen komt erin te staan...
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To-Do App</title>
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">

	<style>
	</style>

</head>
<body>

	<h1>To-Do App</h1>

		<form action="opdracht-01-todo.php" method="POST">
			<ul>
				<li>
					<label for="description">Beschrijving: </label>
					<input type="text" id="description" name="description">
				</li>
			</ul>
			<input type="submit" name="addToDo" value="Toevoegen">
		</form>

		<?php if(!$toDoItems): ?> <!-- wanneer er geen taken zijn (arrays zonder values bestaan niet in php) !-->
			<p>WAT!? Geen TAKEN??? ONMOGELIJK!!</p>

			<?php else :?> <!-- indien taken toegevoegd... (coming soon) !-->
				<h2>To-Do:</h2>
					<ul>
						<?php foreach($toDoItems as $deelKey => $deelArray):  ?>

            				<?php foreach( $deelArray as $data => $value ):  ?>
              	  				<li>
									<button title="status" name="toggleToDo" value="0" class="incomplete"></button>
									<p><?= $value?></p>
									<button title="remove" name="removeToDo" value="0"></button>
                				</li>
            				<?php endforeach ?>
        				<?php endforeach ?>
					</ul>
		<?php endif ?>

		<?php if(!empty($toDoItems) && $completedList == false) :?> <!-- nog taken onvoltooid? !-->
			<p>"Werken luilakken!" - Bobby</p>
		<?php endif ?>

		<?php if(!empty($toDoItems)) :?> <!-- alle taken voltooid? !-->
			<p>"Ge moogt spellekens gaan spelen!" - je moeder</p>
		<?php endif ?>
			<?php 			?> <!-- de nog voltooien taken... (coming soon)	!-->

</body>
</html>