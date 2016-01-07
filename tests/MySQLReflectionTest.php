<?php
/**
 * 
 */

use Verysimple\DB\Reflector\Reflector;
use Verysimple\DB\Reflector\Column;

/**
 * @author jason
 */
class MySQLReflectionTest extends PHPUnit_Framework_TestCase
{
	
	private function getReflector()
	{
		return  new Reflector(MYSQL_DSN, MYSQL_USERNAME, MYSQL_PASSWORD);	
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
				
				$this->assertEquals('p_',$table->getColumnPrefix(),'Expected column prefix of "p_"');
				 
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
    			
    			$columnFound = false;
    			
    			foreach ($columns as $column) {
    				if ($column->name == 'p_ship_date') {
    					$columnFound = true;
    					
    					$this->assertEquals(Column::TYPE_DATE,$column->columnType,'Expected p_ship_date column type of TYPE_DATE');
    					
    					break;
    				}
    			}
    				
    			$this->assertTrue($columnFound,'Expected to find a column named "p_ship_date"');

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
