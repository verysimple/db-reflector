<?php
namespace Verysimple\DB\Reflector;

use Verysimple\DB\Reflector\Column;
use Verysimple\DB\Reflector\Relationship;

/**
 * @author JMH
 */
class Table {
	
	/** @var Reflector */
	private $reflector;
	
	/** @var string */
	private $databaseName = '';
	
	/** @var array */
	private $columnsCache;
	
	/** @var array */
	private $relationshipsCache;
	
	public $name = '';
	public $isView = false;
	
	/**
	 * Instantiate the DB Table object
	 * @param Reflector $reflector
	 */
	public function __construct(Reflector $reflector, $dbName, $row = null)
	{
		$this->reflector = $reflector;
		$this->databaseName = $dbName;
		
		if ($row) {
			$this->name = $row['table_name'];
			$this->isView = $row['is_view'] == 1;
		}
	}
	
	/**
	 * Returns the primary key(s) for this table as an array of Column objects
	 * @return array
	 */
	public function getPrimaryKey()
	{
		$pk = array();
		$columns = $this->getColumns();
		foreach ($columns as $column) {
			if ($column->isPrimaryKey) {
				$pk[] = $column;
			}
		}
		return $pk;
	}
	
	/**
	 * Analyzes all columns to determine if the name of each has a common prefix
	 * for example "p_id, p_name, p_category" the prefix is "p_"
	 * @return string
	 */
	public function getColumnPrefix()
	{
		$columns = $this->getColumns();
		$firstColName = count($columns) > 0 ? $columns[0]->name : '';
		$pos = strpos($firstColName, '_');
		
		if ($pos > 0) {
			$prefix = substr($firstColName, 0, $pos + 1);
			
			foreach ($columns as $column) {
				if ($prefix != substr($column->name, 0, $pos + 1)) return '';
			}
		}

		return $prefix;

	}
	
	/**
	 * Returns an array of Column objects for this table
	 * @return array
	 */
	public function getColumns()
	{
		if (!$this->columnsCache) {
			
			$columns = array();
			$params = array(
				':schema' => $this->databaseName,
				':table' => $this->name
			);
			
			$stmt = $this->reflector->execute(
					$this->reflector->adapter->getColumnsQuery(),
					$params);
			
			while ($row = $stmt->fetch()) {
				$column = new Column($row);
				$columns[] = $column;
			}
			
			$stmt->closeCursor();
			$this->columnsCache = $columns;
		}
		
		return $this->columnsCache;
	}
	
	/**
	 * Return an array of Relationship objects for this table
	 * @return array
	 */
	public function getRelationships()
	{
		if (!$this->relationshipsCache) {
		
			$relationships = array();
			$params = array(
					':schema' => $this->databaseName,
					':table' => $this->name
			);
			
			$stmt = $this->reflector->execute(
					$this->reflector->adapter->getRelationshipsQuery(),
					$params);
			
			while ($row = $stmt->fetch()) {
				$relationship = new Relationship($row);
				$relationships[] = $relationship;
			}
			
			$stmt->closeCursor();
			$this->relationshipsCache = $relationships;
		}
		
		return $this->relationshipsCache;
	}
}