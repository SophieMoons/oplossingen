<?php

    $baseName = '/' . basename(__FILE__) . '/';

    $root = preg_replace($baseName, '', __FILE__);

    $htaccess = file_get_contents($root .'/.htaccess');
    
    $url = $_SERVER['HTTP_HOST'] . preg_replace('/Deel2.*$/', '', $_SERVER['REQUEST_URI']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>opdracht-mod_rewrite-basis</title>
    <link rel="stylesheet" href="http://web-backend.local/css/global.css">
    <link rel="stylesheet" href="http://web-backend.local/css/facade.css">
    <link rel="stylesheet" href="http://web-backend.local/css/directory.css">
</head>

<body>

	<section class="body">

		<h1>var_dump() van $_GET variabele</h1>

            <p>Surf naar <a href="http://<?php echo $url ?>Deel2/rasmus/">http://<?php echo $url ?>Deel2/rasmus/</a></p>

        <pre><?php print_r($_GET) ?></pre>

	</section>

</body>
</html>