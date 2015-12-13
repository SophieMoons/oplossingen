<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Opdracht-File-upload</title>
    <link rel="stylesheet" href="http://web-backend.local/css/global.css">
    <link rel="stylesheet" href="http://web-backend.local/css/facade.css">
    <link rel="stylesheet" href="http://web-backend.local/css/directory.css">
</head>

<body>
	<h1>File-uploading</h1>

	<?php if ($notification): ?>
		<div class="regular <?= $notification['type'] ?>">
			<ul>
				<?php foreach ($notification['text'] as $name => $value): ?>
					<li><?= $name ?>: <?= $value ?></li>
				<?php endforeach ?>
			</ul>
		</div>
	<?php endif ?>

	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
	
		<label for="file">Bestand:</label>
		<input type="file" name="file" id="file"> 

		<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>