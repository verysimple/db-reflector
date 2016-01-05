# Verysimple DB Reflector

DB Reflector inspects a database schema and converts it into a simple collection of arrays and objects that can be easily inspected. This includes information about columns, keys and table relationships.

DB Reflector neutralizes vendor-specific information and provides a consistent schema for all supported databases. Some possible uses for this Reflector are for building a generic DB editor or a code generator.

Databases currently supported are MySQL and Postgres.

## Installation

Install DB Reflector class with composer:

	composer require verysimple/db-reflector

For automatic installation, include the project in your composer.json (it is only necessary in require-dev):

	{
		"require-dev": {
			"verysimple/db-reflector": ">=1.0.0"
		}
	}

## Usage

	// the reflector object handles the connection
	$r = new Reflector('dsn', 'username', 'password');
	
	// The DB name is specified in the DSN
	$db = $r->getDB();
    	
    // enumerate through all of the tables
    foreach ($tables as $table) {

		// getPrimaryKey returns an array of 0 or more Column objects
    	$key = $table->getPrimaryKey();
    	
    	// columns is an array of Column objects
    	$columns = $table->GetColumns();
    	
    	// relationships is an array of Relationship objects
    	$relationships = $table->getRelationships();

    }

## Running Unit Tests

First clone repository. For first initial install:

	composer install

To refresh autoloader:

	composer dumpautoload

* Run DB setup scripts in /assets/sql
* create file phpunit_connection.php in root directory
* see phpunit_bootstrap.php for instructions