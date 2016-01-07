<?php
namespace Verysimple\DB\Reflector;

/**
 * @author JMH
 */
class Column {
	
	
	const TYPE_INT = 1;
	const TYPE_DECIMAL = 2;
	const TYPE_STRING = 4;
	const TYPE_BINARY = 16;
	const TYPE_ENUM = 32;
	const TYPE_DATE = 64;
	const TYPE_TIME = 128;
	const TYPE_DATETIME = 256;
	const TYPE_OBJECT = 512;
	const TYPE_VIRTUAL = 1024;
	const TYPE_UNKNOWN = 2048;
	
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
	
	public $columnType = self::TYPE_UNKNOWN;
	
	/**
	 * @param array $row if provided, use to load the properties
	 */
	public function __construct($row)
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
			
			$this->setColumnType();
		}

	}
	
	/**
	 * analyzes the column dataType and sets columnType to a generic PHP "TYPE"
	 * that can be used to map PHP code to the column.
	 * 
	 * This is called automatically when $row was provided during construction.
	 */
	public function setColumnType()
	{
		switch ($this->dataType) {
			case 'char':
			case 'varchar':
			case 'text':
				$this->columnType = self::TYPE_STRING;
				break;
			case 'int':
			case 'bigint':
			case 'mediumint':
			case 'smallint':
			case 'tinyint':
			case 'bit':
				$this->columnType = self::TYPE_INT;
				break;
			case 'float':
			case 'decimal':
			case 'double':
				$this->columnType = self::TYPE_DECIMAL;
				break;
			case 'date':
				$this->columnType = self::TYPE_DATE;
				break;
			case 'datetime':
				$this->columnType = self::TYPE_DATETIME;
				break;
			case 'time':
				$this->columnType = self::TYPE_TIME;
				break;
			case 'enum':
			case 'set':
				$this->columnType = self::TYPE_ENUM;
				break;
			case 'json':
				$this->columnType = self::TYPE_OBJECT;
				break;
			default:
				$this->columnType = self::TYPE_UNKNOWN;
				break;
		}
	}
	
	public function isStringType()
	{
		return $this->isColumnType(20);
	}
	
	public function isNumericType()
	{
		return $this->isColumnType(10);
	}
	
	public function isDateType()
	{
		return $this->isColumnType(50);
	}
	
	public function isBinaryType()
	{
		return $this->isColumnType(30);
	}
	
	/**
	 * Returns true if the columnType constant is between the given numeric range
	 * @param int $min
	 * @param int $max (if null then return a 10-digit range, ie 10-19, 20-29, etc)
	 */
	private function isColumnType($min,$max=null)
	{
		if ($max == null) $max = $min + 9;
		return $this->columnType >= $min && $this->columnType <= $max;
	}
	
}

/*
const TYPE_UNKNOWN = 0;
// -- NUMERIC TYPES
const TYPE_INT = 10;
const TYPE_SMALLINT = 10;
const TYPE_TINYINT = 10;
const TYPE_MEDIUMINT = 10;
const TYPE_BIGINT = 10;
const TYPE_DECIMAL = 12;
const TYPE_NUMERIC = 12;
const TYPE_FLOAT = 13;
const TYPE_DOUBLE = 13;
const TYPE_BIT = 10;
// -- STRING TYPES
const TYPE_CHAR = 20;
const TYPE_VARCHAR = 20;
const TYPE_TEXT = 21;
// -- BINARY TYPES
const TYPE_BLOB = 30;
const TYPE_BINARY = 31;
const TYPE_VARBINARY = 31;
// -- MULTI-VALUE TYPES
const TYPE_ENUM = 40;
const TYPE_SET = 41;
// -- DATE TYPES
const TYPE_DATE = 50;
const TYPE_DATETIME = 51;
const TYPE_TIMESTAMP = 52;
const TYPE_TIME = 53;
const TYPE_YEAR = 54;
// -- OBJECTS AND SPECIALIZED TYPES
const TYPE_GEOMETRY = 60;
const TYPE_JSON = 61;
*/