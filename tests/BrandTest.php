<?php

    /**
    * @backupGlobals disabled
    * #backupStaticAttributes disabled
    */

    require_once 'src/Brand.php';

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {


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






    }
?>
