<?php

namespace Codemy\DB;

class Sql
{
    
	const HOSTNAME = "bellabags_db_1";
	const PORT = "DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle'])3308";
    const USERNAME = "root";
    const PASSWORD = "test";
    const DBNAME = "db_ecommerce";

    private $conn;

    public function __construct()
    {
		$this->conn = new \PDO(
			"mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME.";port=".Sql::PORT, 
			Sql::USERNAME,
			Sql::PASSWORD
		);
    }

    private function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		} 

	}

	private function bindParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

	}

	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}





}
