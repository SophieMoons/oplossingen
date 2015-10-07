<?php

#Deel 1
$rijen=10;
$kolommen=10;

#Deel 2
$uitkomstVermenig=0;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
		<h1>opdracht-looping-statements-for</h1>
		<h2>Deel 1</h2>

		<table>
			<?php for ( $aantalRijen = 0; $aantalRijen < $rijen; $aantalRijen++): ?>
				<tr>
					<?php for ( $aantalKolommen = 0; $aantalKolommen < $kolommen; $aantalKolommen++): ?>
						<td>kolom</td>
					<?php endfor ?>
				</tr>
			<?php endfor ?>
		</table>
		<br>
		<table>
			<?php for ( $aantalRijen = 0; $aantalRijen < $rijen+1; $aantalRijen++): ?>
				<tr>
					<?php for ( $aantalKolommen = 0; $aantalKolommen < $kolommen+1; $aantalKolommen++): ?>
						<?php $uitkomstVermenig=($aantalKolommen)*($aantalRijen);?>
						<td><?= $uitkomstVermenig ?></td>
					<?php endfor ?>
				</tr>
			<?php endfor ?>
		</table>

    </body>
</html>