<?php
/**
 * A_SetupTest.php
 */

use Verysimple\DB\Reflector\Reflector;

/**
 * This is named with A_ prefix so it will run first
 * @author jason
 */
class A_SetupTest extends PHPUnit_Framework_TestCase
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

    
}
