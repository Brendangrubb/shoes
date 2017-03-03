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



    }
?>
