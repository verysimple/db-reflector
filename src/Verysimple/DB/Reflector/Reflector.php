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
	
	private $dsn;
	private $username;
	private $password;
	private $options;
	
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
		$this->dsn = $dsn;
		$this->username = $username;
		$this->password = $password;
		$this->options = $options;
		
		// unless specific error mode is specified, set it to throw exceptions
		if ($this->options == null || empty($this->options[PDO::ATTR_ERRMODE])) {
			$this->options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		}
		
		$this->parseDSN();
		
		$this->initAdapter();
		
	}
	
	/**
	 * Parse $this->dsn into the various components and populate
	 * them into the connections array
	 */
	private function parseDSN()
	{
		list($type,$params) = explode(':', $this->dsn, 2);
	
		$this->connection = array('type'=>$type);
	
		$parts = explode(';', $params);
		foreach ($parts as $part) {
			list($key,$val) = explode('=', $part);
			$this->connection[$key] = $val;
		}
	}
	
	/**
	 * auto-detect the adapter needed to get vendor-specific SQL
	 * @throws \Exception
	 */
	private function initAdapter()
	{
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
	 * Opens the connection if necessary, otherwise does nothing
	 */
	private function openConnection()
	{
		if (!$this->pdo) {
			try {
				$this->pdo = new PDO($this->dsn,$this->username,$this->password,$this->options);
			}
			catch (\PDOException $ex) {
				
				if ($ex->getCode() == '2002') {
					throw new \PDOException('Socket connection failed. See http://tinyurl.com/69gjg93','2002',$ex);
				}
				
				throw $ex;
				
			}
		}
	}
	
	/**
	 * 
	 */
	private function closeConnection()
	{
		$this->pdo = null;
	}
	
	/**
	 * Utility method to execute a prepared statement with error checking
	 * @param string $sql
	 * @param array $params
	 * @return \PDOStatement;
	 */
	public function execute($sql,$params = null)
	{
		$this->openConnection();
		
		$stmt = $this->pdo->prepare($sql);
		
		if (!$stmt->execute($params))
		{
			$err = $stmt->errorInfo();
			throw new \Exception($err[2]);
		}

		return $stmt;
	}
	
	/**
	 * @return DB
	 */
	public function getDB()
	{
		$this->openConnection();
		
		$name = $this->connection['dbname'];
		return new DB($this, $name);
	}
	
}