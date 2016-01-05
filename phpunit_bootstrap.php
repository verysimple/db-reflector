<?php
/**
 * This bootstrap file will setup the enviroment so that
 * the application can be tested from the command line.
 *
 * The phpunit.xml file in this directory instructs PHPUnit
 * to include this file prior to running any tests.
 * 
 * YOU MUST RUN THE SQL SETUP FILES IN /assets/sql
 * 
 * YOU MUST CREATE A FILE NAMED 'phpunit_connection.php' with
 * the following variables defined:
 * 
 * 	define('MYSQL_DSN','');
 * 	define('MYSQL_USERNAME','');
 * 	define('MYSQL_PASSWORD','');
 * 	define('PGSQL_DSN','');
 * 	define('PGSQL_USERNAME','');
 * 	define('PGSQL_PASSWORD','');
 * 
 */

require __DIR__.'/vendor/autoload.php';

// See above about the file phpunit_connection.php that must be created. This information is not
// in version control because it contains machine-specific configuration settings.
if (file_exists('phpunit_connection.php')) {
	include 'phpunit_connection.php';
}
else {
	throw new Exception(
		"\n\n************************************************************************************\n" .
		"PLEASE SEE PHPUNIT_BOOTSTRAP.PHP REGARDING CREATION OF A DB FIXTURE CONNECTION FILE.\n".
		"************************************************************************************\n\n");
}

// INITIALIZE MYSQL DATABASE FIXTURE

// INITIALIZE POSTGRES DATABASE FIXTURE

