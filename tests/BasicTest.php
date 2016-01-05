<?php
/**
 * BasicTest.php
 */

require __DIR__.'/../vendor/autoload.php';

use Verysimple\DB\Reflector\Reflector;

/**
 * Basic Test
 */
class NumberTest extends PHPUnit_Framework_TestCase
{
    /**
     * 
     */
    public function testEnvironment()
    {

        $this->assertTrue(true,'Assert that true is true');
    }

    /**
     * This is another unit test
     */
    public function testInstantiation()
    {

        $this->assertFalse(true);
    }

}
