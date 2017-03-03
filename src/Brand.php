<?php
    class Brand
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

    // GETTERS AND SETTERS
        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getId()
        {
            return $this->id;
        }

    // C R U D
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->name}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = array();

            foreach ($returned_brands as $brand) {
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }

            return $brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

        static function find($id)
        {
            $returned_brands = Brand::getAll();
            $found_brand = null;

            foreach ($returned_brands as $brand) {
                $brand_id = $brand->getId();
                if ( $brand_id == $id) {
                    $found_brand = $brand;
                }
            }
            return $found_brand;
        }

    // MANY TO MANY
        function addStore($store)
        {

        }

        function getStores()
        {

        }

    }
?>
