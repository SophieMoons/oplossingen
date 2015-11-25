<?php

	function __autoload($portfolioClass)
	{
		include 'classes/' . $portfolioClass . '.php'; 
	}
	
	$portfolio	=	new HTMLBuilder('header-partial.html', 'body-partial.html', 'footer-partial.html');
?>