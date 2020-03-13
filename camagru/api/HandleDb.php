<?php


class HandleDb {
	
	private $pdo;


	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function insertData($table, $fields, $values)
	{
		$fieldsStr = "(" . trim(implode(" , ", $fields)) . ")";
		$valuesStr = "(";	
		foreach($values as $key => $value)
			$valuesStr .=  "'" . $value . "'" . ",";
		$valuesStr = rtrim($valuesStr, ",") . ")";

		$sql = "INSERT INTO " . $table . $fieldsStr . " VALUES"  . $valuesStr;
		$stmt = $this->pdo->prepare($sql);
		$result = $stmt->execute();
		if($result)
			return (1);
		else
			return ($stmt->errorInfo());
	}


	public function selectData($sql)
	{
		try {
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if($result)
				return($result);
			else
				return(false);
		} catch (Exception $e) {
			echo 'Exception -> ' . $e->getMessage();
		}
	}

	public function updateData($sql)
	{
		try {
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			$count = $stmt->rowCount();
			if($count > 0)
				return(1);
			else
				return(0);
		} catch (Exception $e) {
			return ($e->getMessage());
		}
	}

	public function deleteData($sql)
	{
		try {
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			$count = $stmt->rowCount();
			if($count > 0)
				return(1);
			else
				return(0);
		} catch (Exception $e) {
			return ($e->getMessage());
		}
	}


}

?>