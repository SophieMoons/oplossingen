<? php

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

	<style>
	</style>

</head>
<body>

<h1>To-Do App</h1>

			<form action="opdracht-01-todo.php" method="post">
				<ul>
					<li>
						<label for="description">Beschrijving: </label>
						<input type="text" id="description" name="description">
					</li>
				</ul>
				<input type="submit" name="addToDo" value="Toevoegen">
			</form>

			<?php 			?> <!-- wanneer er geen taken zijn.. (coming soon) !-->
			<p>WAT!? Geen TAKEN??? ONMOGELIJK!!</p>
			<?php 			?> <!-- indien taken toegevoegd... (coming soon) !-->
			<h2>To-Do:</h2>
			<?php 			?> <!-- de nog voltooien taken... (coming soon)	!-->

</body>
</html>