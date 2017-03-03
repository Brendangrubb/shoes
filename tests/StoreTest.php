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

        // TEST GETTERS AND SETTERS
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

        function test_setName()
        {
            // Arrange
            $name = "Shoe Mill";
            $new_store = new Store($name);
            $new_name = "Shoe Mill East";

            // Act
            $new_store->setName($new_name);
            $result = $new_store->getName();

            // Assert
            $this->assertEquals($new_name, $result);

        }

        function test_getId()
        {
            // Arrange
            $name = "Shoe Mill";
            $id = 1;
            $new_store = new Store($name, $id);

            // Act
            $result = $new_store->getId();

            // Assert
            $this->assertEquals($id, $result);

        }

    // TEST C R U D
        function test_save()
        {
            // Arrange
            $name = "Shoe Mill";
            $new_store = new Store($name);
            $new_store->save();

            // Act
            $result = Store::getAll();

            // Assert
            $this->assertEquals($new_store, $result[0]);
        }





    }

?>
