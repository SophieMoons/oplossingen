<?php
$getalArr=array();

while($i=0;$i<100;i++)
{
$getalArr[$i]=($i.', ');
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	
	<section class="body">
		<h1>opdracht-looping-statements-while</h1>
		
		<p><?php echo var_dump($getalArr)?></p>

	</section>

</body>
</html>