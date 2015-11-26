<?php
	session_start();

  	$errorMessage = false;
    $toDoItems = array();	
	$itemStatus = "incomplete";
	$i=0;

	//als er gesubmit is...
 	if (isset($_POST['submit'])) 
    {
        $_SESSION['toDoItem'] = $_POST['toDoItem']; //session wordt gesaved na submitting

        if ($_POST['toDoItem'] == '')//om te zien of er wel iets is ingevuld
        {
  			$errorMessage=true;
        }

        else
        {
			$errorMessage = false;
			$input = $_POST['toDoItem'];

			$toDoItems[$i] = array();				//2D array met... 
			$toDoItems[$i]['item'] = $input; 		//...taak...
       		$toDoItems[$i]['status'] = $itemStatus; //..en status
        }
        
        $i++; //index omhoog array
    }

	//als sessie geset is, gebruik deze (onthoud de toDo-item)
	if(isset($_SESSION['toDoItem']))
	{
		$ToDo = $_SESSION['toDoItem'];
	}

	function incompleteInArray($needle, $haystack, $strict = false) //zit er een incomplete to-do item in de array?
	{
    	foreach ($haystack as $item) 
    	{
        	if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array($needle, $item, $strict))) 
       	 	{
       	    	return false;
        	}
    	}
    
    	return true;
	}

	if(isset($_POST['toggleToDo']))
	{
		$_SESSION['toggleToDo'] = $_POST['toggleToDo'];

		if($itemStatus =='incomplete')
		{
			$itemStatus ='complete';
		}

		else
		{
			$itemStatus='incomplete';
		}
	}

	//als sessie geset is, gebruik deze (onthoud de toDo-item status)
	if(isset($_SESSION['toggleToDo']))
	{
		$ToDoStatus = $_SESSION['toggleToDo'];
	}

										var_dump($toDoItems); //wordt altijd overschreven... moet een methode vinden om een soort push effect te krijgen
    									var_dump($errorMessage);

    	$completedList = incompleteInArray('incomplete', $toDoItems); //bool om te checken of de lijst volledig afgecheckt is
    									var_dump($completedList);

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
	<?php if($errorMessage) :?>
		<div class="error notification">
			<p>Probeert ge da hier kapot te maken ofzo?! Type iets in!</p>
		</div>
	<?php endif ?>
	<h1>To-Do App</h1>

		<form action="opdracht-01-todo.php" method="POST">
			<ul>
				<li>
					<label for="toDoItem">Beschrijving: </label>
					<input type="text" id="description" name="toDoItem">
				</li>
			</ul>
			<input type="submit" name="submit" value="Toevoegen">
		</form>

		<?php if(!$toDoItems): ?> <!-- wanneer er geen taken zijn (arrays zonder values bestaan niet in php) !-->
			<p>WAT!? Geen TAKEN??? ONMOGELIJK!!</p>

			<?php else :?> <!-- indien taken toegevoegd... !-->
				<form action="opdracht-01-todo.php" method="POST">
					<h2>To-Do:</h2>
						<ul>
							<?php foreach($toDoItems as $deelKey => $deelArray):  ?>
              	  					<li>
										<button title="complete" name="toggleToDo" value="0" class="<?= $itemStatus?>"> <?= $toDoItems[$deelKey]['item'] ?> </button>
										<button title="remove" name="removeToDo" value="0"></button>
                					</li>
        					<?php endforeach ?>
						</ul>
				</form>		
		<?php endif ?>

		<?php if(!empty($toDoItems) && $completedList == false) :?> <!-- nog taken onvoltooid? !-->
			<p>"Werken luilakken!" - Bobby</p>
		<?php endif ?>

		<?php if(!empty($toDoItems) && $completedList == true) :?> <!-- alle taken voltooid? !-->
			<p>"Ge moogt spellekens gaan spelen!" - je moeder</p>
		<?php endif ?>
</body>
</html>