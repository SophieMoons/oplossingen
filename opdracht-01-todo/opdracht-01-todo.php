<?php
//AHHAA! gebasseerd op winkelkarretje (voorbeeldoefening) //vss sessies houden de verschillende data bij (sessie CompletedToDo en sessie IncompleteToDo)

	session_start();

	// Sessie verwijderen
	if (isset($_GET['session']))
	{
		if($_GET['session'] === 'destroy')
		{
			session_destroy();
			header('Location: opdracht-01-todo.php'); // staat in voor refresh
		}
	}

  	$errorMessage = false;

	//als er gesubmit is...
 	if (isset($_POST['submit'])) 
    {			
		$input = trim($_POST['toDoItem']); //lege input is ook met spaties, dus trimmen die handel!

        if ($input != '')//om te zien of er wel iets is ingevuld, if wel ingevuld ->
        {
			$_SESSION['incompleteToDo'][] = $_POST['toDoItem'];
        }

        else
        {
			$errorMessage = true;
        }
        
    }

	if (isset($_POST['toggleIncomplete'])) 
	{
		$_SESSION['completedToDo'][] = $_SESSION['incompleteToDo'][$_POST['toggleIncomplete']];
		unset($_SESSION['incompleteToDo'][$_POST['toggleIncomplete']]); //is nu completed
	}

	if (isset($_POST['toggleComplete']))
	{
		$_SESSION['incompleteToDo'][] = $_SESSION['completedToDo'][$_POST['toggleComplete']];
		unset($_SESSION['incompleteToDo'][$_POST['toggleComplete']]);
	}

	/* DELETE */
	if (isset($_POST['removeIncomplete']))
	{
		unset($_SESSION['incompleteToDo'][$_POST['removeIncomplete']]);
	}

	if (isset($_POST['removeComplete']))
	{
		unset($_SESSION['completedToDo'][$_POST['removeComplete']]);
	}

	var_dump($_SESSION);
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

	<h4>Voeg een To-Do toe:</h4>

	<form action="opdracht-01-todo.php" method="POST">
			
		<ul>
			<li>
				<label for="toDoItem">Beschrijving: </label>
				<input type="text" id="toDoItem" name="toDoItem">
			</li>
		</ul>

		<input type="submit" name="submit" value="Toevoegen">

	</form>		

  	<?php if (empty($_SESSION['incompleteToDo']) && empty($_SESSION['completedToDo'])): ?>

		<p>WAT!? Geen TAKEN??? ONMOGELIJK!!</p>

  		<?php else: ?>
		
			<?php if($_SESSION['incompleteToDo'] == null): ?>
			
				<p>"Ge moogt spellekens gaan spelen!" - je moeder</p>

				<?php else: ?>
		
					<p>"Werken luilakken!" - Bobby</p>

			<?php endif?>		
			
		<h3>Still To-Do:</h3>

		<?php if($_SESSION['incompleteToDo'] != null): ?>

			<ul>
				<?php if (isset( $_SESSION['incompleteToDo'] )): ?>
					<?php foreach($_SESSION['incompleteToDo'] as $key => $incompleteItem): ?>
						<li>
							<form action="opdracht-01-todo.php" method="POST">
								<button title="complete" name="toggleIncomplete" value="<?= $key ?>" class="complete"></button>
									<p class="toDoItems"> <?= $incompleteItem ?> </p>  <!-- Geeft dus gewoon inhoud van de array weer -->
								<button title="remove" name="removeIncomplete" value="<?= $key ?>"></button>
							</form>		
						</li>
					<?php endforeach ?>
				<?php endif ?>
			</ul>

		<?php endif ?>

		<h3>Completed Tasks:</h3>
			
		<?php if (isset( $_SESSION['completedToDo'] )): ?>
		
			<?php if($_SESSION['completedToDo'] != null): ?>

				<ul>
					<?php foreach($_SESSION['completedToDo'] as $key => $completedItem): ?>
						<li>
							<form action="opdracht-01-todo.php" method="POST">
								<button title="complete" name="toggleComplete" value="<?= $key ?>" class="complete"></button>
									<p class="toDoItems" id="completedItem"> <?= $completedItem ?> </p>
								<button title="remove" name="removeComplete" value="<?= $key ?>"></button>
							</form>
						</li>
					<?php endforeach ?>		
				</ul>
				
			<?php endif ?>
			
		<?php endif ?>	
		
	<?php endif ?>

	<!-- VERNIETIG SESSIE (VOOR DEBUGGING) -->
		<a href="opdracht-01-todo.php?session=destroy">VERNIETIG SESSIE</a>

    </body>
</html>