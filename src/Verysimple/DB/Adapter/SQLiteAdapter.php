<?php
namespace Verysimple\DB\Adapter;

use Verysimple\DB\Adapter\IDBAdapter;

/**
 * @author jason
 */
class SQLiteAdapter implements IDBAdapter {
	
	public function __construct() {
		throw new \Exception('SQLite Adapter is not yet implemented');	
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Verysimple\DB\Adapter\IDBAdapter::GetTablesQuery()
	 */
	public function getTablesQuery()
	{
		return "";
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Verysimple\DB\Adapter\IDBAdapter::GetTablesQuery()
	 */
	public function getColumnsQuery()
	{
		return "";
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Verysimple\DB\Adapter\IDBAdapter::GetTablesQuery()
	 */
	public function getRelationshipsQuery()
	{
		return "";
	}
	
}