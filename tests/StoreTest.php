<?php

    /**
    * @backupGlobals disabled
    * #backupStaticAttributes disabled
    */

    require_once 'src/Store.php';

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        function test_getName()
        {
            // Arrange
            $name = "Shoe Mill";
            $new_store = new Store($name);

            // Act
            $result = $new_store->getName();

            // Assert
            $this->assertEquals($name, $result);

        }
    }

?>
