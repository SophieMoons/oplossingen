<?php

session_start();

function __autoload($class)
{
	require_once('classes/' . $class . '.php' );
}

$logout	=	User::logout();

if ( $logout )
{	
	$logoutMessage = new Notification('success', 'U bent uitgelogd, tot de volgende keer');
	header('location: login-form.php');
}

?>