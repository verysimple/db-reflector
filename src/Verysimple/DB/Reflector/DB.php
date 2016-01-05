<?php
namespace Verysimple\DB\Reflector;

use Verysimple\DB\Reflector\Reflector;
use Verysimple\DB\Reflector\Table;

/**
 * @author JMH
 */
class DB {
	
	/** @var Reflector */
	private $reflector;
	
	/** @var array */
	private $tablesCache;
	
	/** @var string */
	public $name;
	
	/**
	 * Instantiate the DB object
	 * @param Reflector $reflector
	 * @param string $name
	 */
	public function __construct(Reflector $reflector, $name)
	{
		$this->reflector = $reflector;
		$this->name = $name;
	}
	
	/**
	 * Return an array of Table objects representing all of the tables (and views)
	 * in the selected database
	 */
	public function getTables()
	{
		if (!$this->tablesCache) {
				
			$tables = array();
			$params = array(':schema' => $this->name);
			
			$stmt = $this->reflector->execute(
				$this->reflector->adapter->getTablesQuery(), 
				$params);
			
			while ($row = $stmt->fetch()) {
				$table = new Table($this->reflector,$this->name, $row);
				$tables[] = $table;
			}
			
			$stmt->closeCursor();
			$this->tablesCache = $tables;
		}
		
		return $this->tablesCache;
	}
	
}