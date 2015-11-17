<?php
$artikels = array(

						array( 'title' => 'Acht internetreuzen eisen beperkingen NSA-spionage',
								
								'body' => 'Acht belangrijke technologiebedrijven, zoals Google, Apple en Facebook, hebben in een open brief aan de Amerikaanse president Barack Obama veranderingen geëist in de manier waarop de overheid aan spionage doet.',
								'tags' => 'spionage'),

						array( 'title' => 'Wilde weldoener stopt geld in brievenbussen',
							   'body' => 'Bewoners van twee appartements­blokken in Koksijde-Bad hebben al drie dagen op rij geld in hun brievenbus aangetroffen. De politie van de zone Westkust is een onderzoek gestart.',
							   'tags' => 'immobiliën'),

						array('title' => 'Originele stukken Hergé geveild voor honderdduizenden euro’s',
							  'body' => 'Twee originele stukken van Hergé zijn zondag voor honderdduizenden euro’s verkocht op een veiling die simultaan werd georganiseerd in Brussel en Parijs.',
							  'tags' => 'Hergé')
					);

$aantalArtikels = sizeof($artikels); //hoeveel arrays in de array?

if (isset($_GET['artikel'])) //enkel wanneer er een artikel aanwezig is
	{
		$artikel = $artikels[$_GET['artikel']];
	}


	include 'view/header-partial.html';
	if (!isset($_GET['artikel']))
	{
		include 'view/artikels.html';
	}
	else
	{
		include 'view/artikel.html';
	}
	include 'view/footer-partial.html';
?>