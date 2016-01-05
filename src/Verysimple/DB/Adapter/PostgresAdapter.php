<?php
namespace Verysimple\DB\Adapter;

use Verysimple\DB\Adapter\IDBAdapter;

/**
 * @author jason
 */
class PostgresAdapter implements IDBAdapter {
	
	/**
	 * {@inheritDoc}
	 * @see \Verysimple\DB\Adapter\IDBAdapter::GetTablesQuery()
	 */
	public function getTablesQuery()
	{
		return "SELECT
			table_catalog as db_name,
			table_name as table_name,
			CASE WHEN table_type = 'VIEW' THEN 1 ELSE 0 END as is_view
			FROM INFORMATION_SCHEMA.TABLES
			WHERE table_catalog = :schema
			AND table_schema = 'public'";
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Verysimple\DB\Adapter\IDBAdapter::GetTablesQuery()
	 */
	public function getColumnsQuery()
	{
		return "SELECT
			INFORMATION_SCHEMA.COLUMNS.table_catalog AS db_name,
			INFORMATION_SCHEMA.COLUMNS.table_name AS table_name,
			INFORMATION_SCHEMA.COLUMNS.column_name AS column_name,
			'' AS column_comment,
			ORDINAL_POSITION AS ordinal_position,
			CASE WHEN column_default LIKE 'NULL%' THEN 'NULL' WHEN column_default LIKE '%nextval%' THEN '' ELSE column_default END as column_default,
			CASE WHEN udt_name = 'varchar' THEN 'varchar' WHEN data_type LIKE '%timestamp%' THEN 'datetime' ELSE data_type END as data_type,
			0 AS is_signed,
			character_maximum_length AS max_length,
			numeric_precision AS numeric_precision,
			numeric_scale AS numeric_scale,
			datetime_precision AS datetime_precision,
			CASE WHEN INNER_TBL.constraint_type = 'PRIMARY KEY' THEN 1 ELSE 0 END as is_primary_key,
			CASE WHEN column_default LIKE '%nextval%' THEN 1 ELSE 0 END as is_auto_increment,
			CASE WHEN is_nullable = 'YES' THEN 1 ELSE 0 END as is_nullable
			FROM INFORMATION_SCHEMA.COLUMNS
				LEFT JOIN (
				SELECT INFORMATION_SCHEMA.KEY_COLUMN_USAGE.table_name,
					INFORMATION_SCHEMA.KEY_COLUMN_USAGE.column_name,
					INFORMATION_SCHEMA.KEY_COLUMN_USAGE.constraint_schema,
					INFORMATION_SCHEMA.TABLE_CONSTRAINTS.constraint_type 
				FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
				INNER JOIN INFORMATION_SCHEMA.TABLE_CONSTRAINTS 
					ON INFORMATION_SCHEMA.KEY_COLUMN_USAGE.constraint_name = INFORMATION_SCHEMA.TABLE_CONSTRAINTS.constraint_name
					AND INFORMATION_SCHEMA.KEY_COLUMN_USAGE.constraint_catalog = INFORMATION_SCHEMA.TABLE_CONSTRAINTS.constraint_catalog
					AND INFORMATION_SCHEMA.KEY_COLUMN_USAGE.table_name = INFORMATION_SCHEMA.TABLE_CONSTRAINTS.table_name
					AND INFORMATION_SCHEMA.TABLE_CONSTRAINTS.constraint_type = 'PRIMARY KEY'
				) AS INNER_TBL
				ON INFORMATION_SCHEMA.COLUMNS.column_name = INNER_TBL.column_name
				AND INFORMATION_SCHEMA.COLUMNS.table_name = INNER_TBL.table_name
				AND INFORMATION_SCHEMA.COLUMNS.table_schema = INNER_TBL.constraint_schema
			WHERE INFORMATION_SCHEMA.COLUMNS.table_catalog = :schema
			AND INFORMATION_SCHEMA.COLUMNS.table_name = :table";
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Verysimple\DB\Adapter\IDBAdapter::GetTablesQuery()
	 */
	public function getRelationshipsQuery()
	{
		return "SELECT
			INFORMATION_SCHEMA.TABLE_CONSTRAINTS.constraint_catalog as db_name,
			INFORMATION_SCHEMA.TABLE_CONSTRAINTS.table_name,
			INFORMATION_SCHEMA.KEY_COLUMN_USAGE.column_name as column_name,
			INFORMATION_SCHEMA.TABLE_CONSTRAINTS.constraint_name,
			INFORMATION_SCHEMA.CONSTRAINT_COLUMN_USAGE.table_name as referenced_table_name,
			INFORMATION_SCHEMA.CONSTRAINT_COLUMN_USAGE.column_name as referenced_column_name
			FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS 
			INNER JOIN INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
				ON INFORMATION_SCHEMA.TABLE_CONSTRAINTS.constraint_name = INFORMATION_SCHEMA.KEY_COLUMN_USAGE.constraint_name
				AND INFORMATION_SCHEMA.KEY_COLUMN_USAGE.constraint_catalog = INFORMATION_SCHEMA.KEY_COLUMN_USAGE.constraint_catalog
			INNER JOIN INFORMATION_SCHEMA.CONSTRAINT_COLUMN_USAGE 
				ON INFORMATION_SCHEMA.CONSTRAINT_COLUMN_USAGE.constraint_name = INFORMATION_SCHEMA.KEY_COLUMN_USAGE.constraint_name
				AND INFORMATION_SCHEMA.CONSTRAINT_COLUMN_USAGE.constraint_catalog = INFORMATION_SCHEMA.KEY_COLUMN_USAGE.constraint_catalog
			WHERE INFORMATION_SCHEMA.TABLE_CONSTRAINTS.constraint_catalog = :schema
			AND INFORMATION_SCHEMA.TABLE_CONSTRAINTS.table_name = :table
			AND INFORMATION_SCHEMA.TABLE_CONSTRAINTS.constraint_type = 'FOREIGN KEY';";
	}
	
}