<?php
	$artikels=array(
		array('title'=>'Black Whoppers Are Causing Green Poop',
			'datum'=> '12/09/2015',
			'inhoud'=>"Burger King is a rainbow of surprises these days. The company recently unveiled a black Whopper for Halloween, a version of the chain's signature sandwich served on a dark bun. But people who eat the A.1. Halloween Whopper say it goes in one color... and comes out another.
			The company told ABC News that the black bun contains less than 1 percent food dye, and writes in its nutrition facts that the flavorings and food colorings in the bun 'are commonly used in the industry and within the safe and Acceptable Daily Intake (ADI) approved by the Food and Drug Administration (FDA).'
			It does not specify which colors are used, but Medical Daily reports that green dyes are often used in black food coloring. Not everyone is put off by the goblin-green Halloween side effect. In fact, several customers seem to be looking forward to it.",
			'video' => 'https://www.youtube.com/embed/lXMskKTw3Bc',
			'afbeelding' => 'article1',  
			'afbeeldingBeschrijving'=>'Black Whopper'),

		array('title'=>'NYC Pizza Rat Is Now A Sexy Halloween Costume',
			'datum'=> '13/09/2015',
			'inhoud'=>"Halloween costumes are like Michael Bolton albums, even if the word 'sexy' is attached, it always ends up being very sad when you put one on.
			The NYC rat who captured our hearts when he captured that giant slice of pizza is now a sexy Halloween costume, because nacsjbaicjsvlkjbvbablfdk.
			Now, you too can walk around your Halloween party for hours meeting your friends' puzzled looks with 'Eh? ... EH?? PIZZA RAT!' you'll finally reveal pretentiously, before your friends fade into the huddled masses to drink the rest of your alcohol.
			Happy Halloween!",
			'afbeelding' => 'article2',  
			'afbeeldingBeschrijving'=>'Sexy Pizza Rat'),

		array('title'=>'Smashing Jell-O With A Tennis Racket Is Just Fantastic',
			'datum'=> '14/09/2015',
			'inhoud'=>"Ace! Almost... Whether you call it Jell-O or Jelly, you can't go wrong obliterating some dessert with a tennis racket.
			In this no frills video, 'Sl0w Mo Guys' Gav and Dan take a swing at catching the smashing moment in slow motion. The gentlemen explain that Redditors passed along a similar Jello-O smash photo, wondering if it would be possible to recreate it on video. Ask, and you shall receive.
			'It's like individual snakes!' says Gav, describing the gelatinous blob as it is crushed to sticky pieces. And, yes, someone did get hit in the face.",
			'video'=>'https://youtube.com/embed/5mZovjRlkWs',
			'afbeelding' => 'article3',  
			'afbeeldingBeschrijving'=>'Jell-O Smash'),
			);

	$individueelArtikel	= false;

	// get-variabele ID geset? (enkel dan kan je een individueel artikel ophalen)
	if (isset ($_GET['id']))
	{
		$id = $_GET['id'];

		if (array_key_exists($id , $artikels))
		{
			$artikels = array( $artikels[$id] );
			$individueelArtikel	= true;
		}
	}
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

		#head-title
		{
			font-size: 3em;
		}

		#head-title-individual
		{
			font-size: 2.5em;
			margin-left:35px;
			font-style: italic;
		}

		.container
		{
			width:	1300px;
			margin:	0 auto;
		}

		img
		{
			max-width: 250px;
		}

		#video
		{
			margin-top: 25px;
			margin-left: 8%;
			margin-right: 92%;
		}

		.multiple
		{
			float:left;
			width:350px;
			margin:20px;
			padding:15px;
			background-color:#EEEEEE;
		}


		.single img
		{
			float:right;
			margin-right:-350px;
			max-width: 320px;
		}

		.single
		{
			max-width: 60%;
			margin-left: 35px;
			padding-bottom: 100px;
		}


	</style>

</head>
<body>
		<div class="container">
<?php if(!$individueelArtikel): ?>
	<h1 id="head-title">De krokante krant</h1>
		<?php else: ?>
			<h1 id="head-title-individual">Individueel artikel</h1>
<?php endif?>
			<?php foreach ($artikels as $id => $artikel): ?>
				<article class="<?php echo ( !$individueelArtikel ) ? 'multiple': 'single' ; ?>">
					<h2><?= $artikel['title'] ?></h2>
					<p><?= $artikel['datum'] ?></p>
					<img src="images/<?php echo $artikel['afbeelding'] ?>.jpg" alt="<?php echo $artikel['afbeeldingBeschrijving'] ?>">
					<p><?= (!$individueelArtikel) ? str_replace ("\r\n", "</p><p>", substr($artikel['inhoud'], 0, 50)) . '...': str_replace ("\r\n", "</p><p>",$artikel['inhoud']) ; ?></p>
					<?php if (!$individueelArtikel): ?>
						<a href="opdracht-get.php?id=<?php echo $id ?>">Read more</a>

						<?php else: ?>
							<?php if(array_key_exists('video', $artikel)): ?>
								<iframe id="video" width="627" height="480" src= <?=$artikel['video']?> frameborder="0" allowfullscreen></iframe>
							<?php endif?>
					<?php endif ?>
				</article>
			<?php endforeach ?>
		</div>
</body>
</html>