<?php
namespace Verysimple\DB\Reflector;

use \PDO;
use Verysimple\DB\Adapter\IDBAdapter;
use Verysimple\DB\Reflector\DB;
use Verysimple\DB\Adapter\MySQLAdapter;
use Verysimple\DB\Adapter\PostgresAdapter;
use Verysimple\DB\Adapter\SQLiteAdapter;

/**
 * @author JMH
 */
class Reflector {
	
	/** @var \PDO */
	public $pdo;
	
	/** @var IDBAdapter */
	public $adapter;

	/** @var array */
	public $connection;
	
	/**
	 * 
	 * @param string $dsn
	 * @param string $username
	 * @param string $password
	 * @param array $options
	 * @throws \Exception
	 */
	public function __construct($dsn, $username = null, $password = null, $options = null)
	{
		$this->parseDSN($dsn);
		
		$this->pdo = new PDO($dsn,$username,$password,$options);
		
		// auto-detect the adapter needed to get vendor-specific SQL
		if ($this->connection['type'] == 'mysql') {
			$this->adapter = new MySQLAdapter();
		}
		elseif ($this->connection['type'] == 'pgsql') {
			$this->adapter = new PostgresAdapter();
		}
		elseif ($this->connection['type'] == 'sqlite') {
			$this->adapter = new SQLiteAdapter();
		}		
		else {
			throw new \Exception('Unsupported DB Type');
		}
		
	}
	
	/**
	 * Utility method to execute a prepared statement with error checking
	 * @param string $sql
	 * @param array $params
	 * @return \PDOStatement;
	 */
	public function execute($sql,$params = null)
	{
		$stmt = $this->pdo->prepare($sql);
		
		if (!$stmt->execute($params))
		{
			$err = $stmt->errorInfo();
			throw new \Exception($err[2]);
		}

		return $stmt;
	}
	
	/**
	 * Parse the DSN string into the various components and populate
	 * them into the connections array
	 */
	private function parseDSN($dsn)
	{
		list($type,$params) = explode(':', $dsn, 2);
		
		$this->connection = array('type'=>$type);
		
		$parts = explode(';', $params);
		foreach ($parts as $part) {
			list($key,$val) = explode('=', $part);
			$this->connection[$key] = $val;
		}
	}
	
	/**
	 * @return DB
	 */
	public function getDB()
	{
		$name = $this->connection['dbname'];
		return new DB($this, $name);
	}
	
}