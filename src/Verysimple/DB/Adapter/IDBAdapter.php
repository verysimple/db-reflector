<?php
namespace Verysimple\DB\Adapter;

/**
 * @author jason
 */
interface IDBAdapter {
	
	/**
	 * Return a SQL string that retrieves all tables
	 * @return string
	 */
	public function getTablesQuery();
	
	/**
	 * Return a SQL string that retrieves all columns
	 * @return string
	 */
	public function getColumnsQuery();
	
	/**
	 * Return a SQL string that retrieves all foreign key relationships
	 * @return string
	 */
	public function getRelationshipsQuery();
}