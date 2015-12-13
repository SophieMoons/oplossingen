<?php
class Notification
{
 	private $type; //moet nergens hierbuiten worden veranderd, private
	private $text;

	public function __construct($type, $text) //constructor
	{
		$this->type	= $type;
		$this->text	= $text;

		$this->addNotification();
	}

	private function addNotification() //intern gebruikte functie
	{
		$_SESSION['notification']['type'] = $this->type;
		$_SESSION['notification']['text'] = $this->text;
	}

	private static function removeNotification()
	{
		unset($_SESSION['notification']);
	}

	public static function getNotification() //wordt hierbuiten gebruikt, public
	{
		$notification = false;

		if (isset($_SESSION['notification']))
		{
			$notification['type'] =	$_SESSION['notification']['type'];
			$notification['text'] =	$_SESSION['notification']['text'];
				
			self::removeNotification();
		}

		return $notification;
	}
}
?>