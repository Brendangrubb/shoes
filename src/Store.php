<?php
    class Store
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
            $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->name}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();

            foreach ($returned_stores as $store) {
                $name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

        static function find($id)
        {
            $returned_stores = Store::getAll();
            $found_store = null;

            foreach ($returned_stores as $store) {
                $store_id = $store->getId();
                if ( $store_id == $id) {
                    $found_store = $store;
                }
            }
            return $found_store;
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE store_id = {$this->getId()};");
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

    // MANY TO MANY METHODS
        function addBrand($brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->getId()}, {$brand->getId()});");
        }

        function getBrands()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores
                JOIN stores_brands ON (stores_brands.store_id = stores.id)
                JOIN brands ON (brands.id = stores_brands.brand_id)
                WHERE stores.id = {$this->getId()};");
            $brands = array();

            foreach ($returned_brands as $brand)
            {
                $name = $brand['name'];
                $id = $brand['id'];
                $brand = new Brand($name, $id);
                array_push($brands, $brand);
            }
            return $brands;
        }
    }
?>
