<?php
class Database
{
	private $database;

	public function __construct($database)
	{
		$this->database = $database;
	}

	public function query($query, $tokens = false)
	{
		$statement = $this->database->prepare($query);
			
		if ($tokens)
		{
			foreach ($tokens as $token => $tokenValue)
			{
				$statement->bindValue($token, $tokenValue);
			}
		}

		$statement->execute();

		$fieldNames = array();

		for ($fieldNumber = 0; $fieldNumber < $statement->columnCount(); ++$fieldNumber)
		{
			$fieldNames[] =	$statement->getColumnMeta($fieldNumber)['name'];
		}

		$data = array();

		while($row = $statement->fetch( PDO::FETCH_ASSOC))
		{
			$data[]	=	$row;
		}

			$resultArray['fieldnames'] = $fieldNames;
			$resultArray['data'] = $data;

			return $resultArray;
		}
}
?>