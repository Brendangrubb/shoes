<?php

    /**
    * @backupGlobals disabled
    * #backupStaticAttributes disabled
    */

    require_once 'src/Brand.php';
    require_once 'src/Store.php';

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
    // TEARDOWN
        protected function teardown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

    // TEST GETTERS AND SETTERS
        function test_getName()
        {
            // Arrange
            $name = "Nike";
            $new_brand = new Brand($name);

            // Act
            $result = $new_brand->getName();

            // Assert
            $this->assertEquals($name, $result);
        }

        function test_setName()
        {
            // Arrange
            $name = "Nike";
            $new_brand = new Brand($name);
            $new_name = "SuperNike";

            // Act
            $new_brand->setName($new_name);
            $result = $new_brand->getName();

            // Assert
            $this->assertEquals($new_name, $result);
        }

        function test_getId()
        {
            // Arrange
            $name = "Nike";
            $id = 1;
            $brand = new Brand($name, $id);

            // Act
            $result = $brand->getId();

            // Assert
            $this->assertEquals($id, $result);
        }

    // TEST C R U D
        function test_save()
        {
            // Arrange
            $name = "Nike";
            $new_brand = new Brand($name);
            $new_brand->save();

            // Act
            $result = Brand::getAll();

            // Assert
            $this->assertEquals($new_brand, $result[0]);
        }

        function test_getAll()
        {
            // Arrange
            $name = "Nike";
            $new_brand = new Brand($name);
            $new_brand->save();

            $name2 = "Puma";
            $new_brand2 = new Brand($name2);
            $new_brand2->save();

            // Act
            $result = Brand::getAll();

            // Assert
            $this->assertEquals([$new_brand, $new_brand2], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $name = "Nike";
            $new_brand = new Brand($name);
            $new_brand->save();

            $name2 = "Puma";
            $new_brand2 = new Brand($name2);
            $new_brand2->save();

            // Act
            Brand::deleteAll();
            $result = Brand::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            // Arrange
            $name = "Nike";
            $new_brand = new Brand($name);
            $new_brand->save();

            $name2 = "Puma";
            $new_brand2 = new Brand($name2);
            $new_brand2->save();

            // Act
            $id = $new_brand2->getId();
            $result = Brand::find($id);

            // Assert
            $this->assertEquals($new_brand2, $result);
        }

    // TEST MANY TO MANY METHODS
        function test_addStore()
        {
            // Arrange
            $name = "Nike";
            $new_brand = new Brand($name);
            $new_brand->save();

            $name = "Shoe Mill";
            $new_store = new Store($name);
            $new_store->save();

            // Act
            $new_brand->addStore($new_store->getId());
            $result = $new_brand->getStores();

            // Assert
            $this->assertEquals([$new_store], $result);
        }

        function test_getStores()
        {
            // Arrange
            $name = "Nike";
            $new_brand = new Brand($name);
            $new_brand->save();

            $name = "Shoe Mill";
            $new_store = new Store($name);
            $new_store->save();

            $name2 = "Foot Traffic";
            $new_store2 = new Store($name2);
            $new_store2->save();

            // Act
            $new_brand->addStore($new_store->getId());
            $new_brand->addStore($new_store2->getId());
            $result = $new_brand->getStores();

            // Assert
            $this->assertEquals([$new_store, $new_store2], $result);
        }
    }
?>
