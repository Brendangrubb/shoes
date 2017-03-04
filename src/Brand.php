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

    // MANY TO MANY METHODS
        function addStore($store)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$store}, {$this->getId()});");
        }

        function getStores()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
                JOIN stores_brands ON (stores_brands.brand_id = brands.id)
                JOIN stores ON (stores.id = stores_brands.store_id)
                WHERE brands.id = {$this->getId()};");
            $stores = array();

            foreach ($returned_stores as $store)
            {
                $name = $store['name'];
                $id = $store['id'];
                $store = new Store($name, $id);
                array_push($stores, $store);
            }
            return $stores;
        }
    }
?>
