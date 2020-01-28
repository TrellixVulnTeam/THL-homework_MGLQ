<?php
/**
 * The class contains the owner's information include id,name and telephone number, Moreover it will
 * be used for storing the data from database.
 *
 * @author Mengke Qiu
 */
    class Owner{
       private $owner_id;
       private  $owner_name;
       private $owner_tele;
       private $car;

        /**
         * Owner constructor.
         * @param $owner_id
         * @param $owner_name
         * @param $owner_tele
         * @param $car
         */
        public function __construct($owner_id, $owner_name, $owner_tele)
        {
            $this->owner_id = $owner_id;
            $this->owner_name = $owner_name;
            $this->owner_tele = $owner_tele;
        }


        /**
         * @return mixed
         */
        public function getOwnerId()
        {
            return $this->owner_id;
        }

        /**
         * @param mixed $owner_id
         */
        public function setOwnerId($owner_id)
        {
            $this->owner_id = $owner_id;
        }

        /**
         * @return mixed
         */
        public function getOwnerName()
        {
            return $this->owner_name;
        }

        /**
         * @param mixed $owner_name
         */
        public function setOwnerName($owner_name)
        {
            $this->owner_name = $owner_name;
        }

        /**
         * @return mixed
         */
        public function getOwnerTele()
        {
            return $this->owner_tele;
        }

        /**
         * @param mixed $owner_tele
         */
        public function setOwnerTele($owner_tele)
        {
            $this->owner_tele = $owner_tele;
        }

        /**
         * @return array
         */
        public function getCar()
        {
            return $this->car;
        }

        /**
         * @param array $car
         */
        public function setCar($car)
        {
            $this->car = $car;
        }


    }
