<?php

/**
 * The class contains the car's information include color,brand and car_id, Moreover it will
 * be used for storing the database's data.
 *
 * @author Mengke Qiu
 */
    class Car{
        private $car_id;
        private $carBrand;
        private $carColor;

        /**
         * Car constructor.
         * @param $car_id
         * @param $carBrand
         * @param $carColor
         */
        public function __construct($car_id, $carBrand, $carColor)
        {
            $this->car_id = $car_id;
            $this->carBrand = $carBrand;
            $this->carColor = $carColor;
        }


        /**
         * @return mixed
         */
        public function getCarId()
        {
            return $this->car_id;
        }

        /**
         * @param mixed $car_id
         */
        public function setCarId($car_id)
        {
            $this->car_id = $car_id;
        }

        /**
         * @return mixed
         */
        public function getCarBrand()
        {
            return $this->carBrand;
        }

        /**
         * @param mixed $carBrand
         */
        public function setCarBrand($carBrand)
        {
            $this->carBrand = $carBrand;
        }

        /**
         * @return mixed
         */
        public function getCarColor()
        {
            return $this->carColor;
        }

        /**
         * @param mixed $carColor
         */
        public function setCarColor($carColor)
        {
            $this->carColor = $carColor;
        }

        public function _toString(){
            return $this->getCarId();
        }
    }
