<?php

	session_start();

    #Data vorige php
 if (isset($_POST['submit']))
    {
        $_SESSION['account']['adres']['straat'] = $_POST['straat'];
        $_SESSION['account']['adres']['nummer'] = $_POST['nummer'];
        $_SESSION['account']['adres']['gemeente'] = $_POST['gemeente'];
        $_SESSION['account']['adres']['postcode'] = $_POST['postcode'];
    }

    $account = $_SESSION['account'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">

	<style>
		.fail 
		{
			font color: #B22222;
			background-color: #F08080;
			padding: 5px;
			max-width: 500px;
			border-radius: 5px;
		}

		li
		{
			list-style: square;
		}

	</style>

</head>
<body>
    </head>
    <body>
		
		<a href="opdracht-sessions-registratie.php?session=destroy">Vernietig sessie</a>
		
		<h1>Overzichstpagina</h1>
		 <ul>

        <?php foreach($account as $deelKey => $deelArray):  ?>

            <?php foreach( $deelArray as $data => $value ):  ?>
                <li>
                    <?= $data ?>: <?= $value ?> | <a href="opdracht-sessions-<?= $deelKey ?>.php?focus=<?= $data ?>">wijzig</a>
                </li>
            <?php endforeach ?>

        <?php endforeach ?>
        
        </ul>
		
    </body>
</html>