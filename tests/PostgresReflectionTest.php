<?php
/**
 * 
 */

use Verysimple\DB\Reflector\Reflector;

/**
 * @author jason
 */
class PostgresReflectionTest extends PHPUnit_Framework_TestCase
{
	
	private function getReflector()
	{
		return  new Reflector(PGSQL_DSN, PGSQL_USERNAME, PGSQL_PASSWORD);	
	}

	public function testTableReflection()
	{
		$r = $this->getReflector();
		$db = $r->getDB();
		
		$foundTable = false;
		
		$tables = $db->getTables();
		 
		foreach ($tables as $table) {
			if ($table->name == 'package') {
				$foundTable = true;
				
				$this->assertFalse($table->isView,'Expected package to be a regular table');
				 
				$key = $table->getPrimaryKey();
				$this->assertEquals('p_id',$key[0]->name,'Expected primary key names p_id');
				
				break;
			}
		}
		
		$this->assertTrue($foundTable,'Expected to find a table named "package"');
		 
	}
	
    public function testColumnReflection()
    {
    	$r = $this->getReflector();
    	$db = $r->getDB();
    	
    	$tables = $db->getTables();
    	
    	foreach ($tables as $table) {
    		if ($table->name == 'package') {

    			$columns = $table->GetColumns();
    			$this->assertTrue(is_array($columns),'Expected an array of columns.');

    			break;
    		}
    	}
    	
    }
    
    public function testRelationshipReflection()
    {
    	$r = $this->getReflector();
    	$db = $r->getDB();
    	 
    	$tables = $db->getTables();
    	 
    	foreach ($tables as $table) {
    		if ($table->name == 'package') {
    			 
    			$relationships = $table->getRelationships();
    			$this->assertTrue(is_array($relationships),'Expected an array of relationships.');
    			 
    			break;
    		}
    	}
    	 
    }
    
    
}
