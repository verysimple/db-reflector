<?php
/**
 * This bootstrap file will setup the enviroment so that
 * the application can be tested from the command line.
 *
 * The phpunit.xml file in this directory instructs PHPUnit
 * to include this file prior to running any tests.
 * 
 * YOU MUST CREATE A FILE NAMED 'phpunit_connection.php' with
 * the following variables defined:
 * 	define('MYSQL_DSN','');
 * 	define('MYSQL_USERNAME','');
 * 	define('MYSQL_PASSWORD','');
 * 	define('PGSQL_DSN','');
 * 	define('PGSQL_USERNAME','');
 * 	define('PGSQL_PASSWORD','');
 * 
 */

if (file_exists('phpunit_connection.php')) {
	include 'phpunit_connection.php';
}

