<?php
/**
 * SetupTest.php
 */

use Verysimple\DB\Reflector\Reflector;

/**
 * @author jason
 */
class SetupTest extends PHPUnit_Framework_TestCase
{

	public function  testConfigurationSettings()
	{
		$this->assertTrue(defined('MYSQL_DSN'),'MYSQL_DSN must be defined in phpunit_connection.php');
		
		$this->assertTrue(defined('PGSQL_DSN'),'PGSQL_DSN must be defined in phpunit_connection.php');
	}
	
	public function testDSNParsing()
	{
		$r = new Reflector(MYSQL_DSN, MYSQL_USERNAME, MYSQL_PASSWORD);
	
		$this->assertEquals('mysql',$r->connection['type'],'Unexpected connection type');
		$this->assertEquals('cargo',$r->connection['dbname'],'Unexpected connection dbname');
		$this->assertEquals('Verysimple\DB\Adapter\MySQLAdapter',get_class($r->adapter),'Unexpected connection adapter');

		$r = new Reflector(PGSQL_DSN, PGSQL_USERNAME, PGSQL_PASSWORD);
	
		$this->assertEquals('pgsql',$r->connection['type'],'Unexpected connection type');
		$this->assertEquals('cargo',$r->connection['dbname'],'Unexpected connection dbname');
		$this->assertEquals('Verysimple\DB\Adapter\PostgresAdapter',get_class($r->adapter),'Unexpected connection adapter');
	}

    public function testMySQLReflection()
    {
    	$r = new Reflector(MYSQL_DSN, MYSQL_USERNAME, MYSQL_PASSWORD);
    	$db = $r->getDB();
    	
    	$tables = $db->getTables();
    	
    	foreach ($tables as $table) {
    		if ($table->name == 'package') {
    			
    			$this->assertFalse($table->isView,'Expected package to be a regular table');
    			
    			$key = $table->getPrimaryKey();
    			$this->assertEquals('p_id',$key[0]->name,'Expected primary key names p_id');
    			
    			$columns = $table->GetColumns();
    			$this->assertTrue(is_array($columns),'Expected an array of columns.');
    			
    			$relationships = $table->getRelationships();
    			$this->assertTrue(is_array($relationships),'Expected an array of relationships.');
    			
    			break;
    		}
    	}
    	
    }
    
    public function testPostgresReflection()
    {
    	$r = new Reflector(PGSQL_DSN, PGSQL_USERNAME, PGSQL_PASSWORD);
    	$db = $r->getDB();
    	 
    	$tables = $db->getTables();
    	 
    	foreach ($tables as $table) {
    		if ($table->name == 'package') {
    			 
    			$this->assertFalse($table->isView,'Expected package to be a regular table');
    			 
    			$key = $table->getPrimaryKey();
    			$this->assertEquals('p_id',$key[0]->name,'Expected primary key names p_id');
    			 
    			$columns = $table->GetColumns();
    			$this->assertTrue(is_array($columns),'Expected an array of columns.');
    			 
    			$relationships = $table->getRelationships();
    			$this->assertTrue(is_array($relationships),'Expected an array of relationships.');
    			 
    			break;
    		}
    	}
    	 
    }
    
}
