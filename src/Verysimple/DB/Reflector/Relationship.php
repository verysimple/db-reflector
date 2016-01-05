<?php
namespace Verysimple\DB\Reflector;

/**
 * @author JMH
 */
class Relationship {
	
	public $constraintName;
	public $tableName;
	public $columnName;
	public $referencedTableName;
	public $referencedColumnName;
	
	/**
	 * @param array $row if provided, use to load the properties
	 */
	public function __construct($row = null)
	{
		if ($row) {
			$this->constraintName = $row['constraint_name'];
			$this->tableName = $row['table_name'];
			$this->columnName = $row['column_name'];
			$this->referencedTableName = $row['referenced_table_name'];
			$this->referencedColumnName = $row['referenced_column_name'];
		}
	}
	
}