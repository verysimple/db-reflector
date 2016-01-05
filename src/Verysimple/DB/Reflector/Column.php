<?php
namespace Verysimple\DB\Reflector;

/**
 * @author JMH
 */
class Column {
	
	public $name;
	public $comment;
	public $ordinalPosition;
	public $columnDefault;
	public $dataType;
	public $isSigned;
	public $maxLength;
	public $numericPrecision;
	public $numericScale;
	public $datetimePrecision;
	public $isPrimaryKey;
	public $isAutoIncrement;
	public $isNullable;
	
	/**
	 * @param array $row if provided, use to load the properties
	 */
	public function __construct($row = null)
	{
		if ($row) {
			$this->name = $row['column_name'];
			$this->comment = $row['column_comment'];
			$this->ordinalPosition = $row['ordinal_position'];
			$this->columnDefault = $row['column_default'];
			$this->dataType = $row['data_type'];
			$this->isSigned = $row['is_signed'];
			$this->maxLength = $row['max_length'];
			$this->numericPrecision = $row['numeric_precision'];
			$this->numericScale = $row['numeric_scale'];
			$this->datetimePrecision = $row['datetime_precision'];
			$this->isPrimaryKey = $row['is_primary_key'];
			$this->isAutoIncrement = $row['is_auto_increment'];
			$this->isNullable = $row['is_nullable'];
		}
	}
	
}