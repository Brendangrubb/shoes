<?php

    /**
    * @backupGlobals disabled
    * #backupStaticAttributes disabled
    */

    require_once 'src/Store.php';
    require_once 'src/Brand.php';

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
    // TEARDOWN
        protected function teardown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

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

        function test_getAll()
        {
            // Arrange
            $name = "Shoe Mill";
            $new_store = new Store($name);
            $new_store->save();

            $name2 = "Foot Traffic";
            $new_store2 = new Store($name2);
            $new_store2->save();

            // Act
            $result = Store::getAll();

            // Assert
            $this->assertEquals([$new_store, $new_store2], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $name = "Shoe Mill";
            $new_store = new Store($name);
            $new_store->save();

            $name2 = "Foot Traffic";
            $new_store2 = new Store($name2);
            $new_store2->save();

            // Act
            Store::deleteAll();
            $result = Store::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            // Arrange
            $name = "Shoe Mill";
            $new_store = new Store($name);
            $new_store->save();

            $name2 = "Foot Traffic";
            $new_store2 = new Store($name2);
            $new_store2->save();

            // Act
            $id = $new_store2->getId();
            $result = Store::find($id);

            // Assert
            $this->assertEquals($new_store2, $result);
        }

        function test_delete()
        {
            // Arrange
            $name = "Shoe Mill";
            $new_store = new Store($name);
            $new_store->save();

            $name2 = "Foot Traffic";
            $new_store2 = new Store($name2);
            $new_store2->save();

            $name = "Nike";
            $new_brand = new Brand($name);
            $new_brand->save();

            // Act
            $new_store->addBrand($new_brand);
            $new_store->delete();
            $result = $new_brand->getStores();

            // Assert
            $this->assertEquals([], $result);
        }

        function test_update()
        {
            // Arrange
            $name = "Shoe Mill";
            $new_store = new Store($name);
            $new_store->save();

            $name2 = "Foot Traffic";
            $new_store2 = new Store($name2);
            $new_store2->save();

            // Act
            $new_name = "Shoe Mill East";
            $new_store->update($new_name);
            $result = $new_store->getName();

            // Assert
            $this->assertEquals($new_name, $result);
        }

    // TEST MANY TO MANY METHODS
        function test_addBrand()
        {
            // Arrange
            $name = "Shoe Mill";
            $new_store = new Store($name);
            $new_store->save();

            $name = "Nike";
            $new_brand = new Brand($name);
            $new_brand->save();

            // Act
            $new_store->addBrand($new_brand);
            $result = $new_store->getBrands();

            // Assert
            $this->assertEquals([$new_brand] , $result);
        }

        function test_getBrands()
        {
            // Arrange
            $name = "Shoe Mill";
            $new_store = new Store($name);
            $new_store->save();

            $name = "Nike";
            $new_brand = new Brand($name);
            $new_brand->save();

            $name2 = "Puma";
            $new_brand2 = new Brand($name2);
            $new_brand2->save();

            // Act
            $new_store->addBrand($new_brand);
            $new_store->addBrand($new_brand2);
            $result = $new_store->getBrands();

            // Assert
            $this->assertEquals([$new_brand, $new_brand2] , $result);
        }
    }
?>
