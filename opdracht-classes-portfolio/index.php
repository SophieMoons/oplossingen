<?php

	function __autoload($portfolioClass)
	{
		include 'classes/' . $portfolioClass . '.php'; 
	}


?>