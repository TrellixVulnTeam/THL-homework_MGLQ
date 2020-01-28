<?php
/**
 * Class DBConnector
 *In this class, the database connection information include $host,$user and $password were encapsulated in this class
 * aims to simplify the process of connection . The tester should set the information manually if it is the first
 * to use this software.The process about how to set information will be showed as follow.
 *
 * @author Mengke Qiu
 */
    Class DBConnector{
        /**
         * @para:$host: your locolhost's url;
         * @para:$user:your mysql database's id;
         * @para:$password your mysql database's password:
         */
        public static $host="localhost";
        public static $user='root';
        public static $password='';

        /**
         * DBConnector constructor.
         */
        public function __construct()
        {
        }

        /**
         * @return false|mysqli
         * return a connection result, a boolean type data, to the user.
         */
        public  static function getConnection(){
            return  mysqli_connect(self::$host,self::$user,self::$password);
        }

        /**
         * @return string
         */
        public static function getHost()
        {
            return self::$host;
        }

        /**
         * @param string $host
         */
        public static function setHost($host)
        {
            self::$host = $host;
        }

        /**
         * @return string
         */
        public static function getUser()
        {
            return self::$user;
        }

        /**
         * @param string $user
         */
        public static function setUser($user)
        {
            self::$user = $user;
        }

        /**
         * @return string
         */
        public static function getPassword()
        {
            return self::$password;
        }

        /**
         * @param string $password
         */
        public static function setPassword($password)
        {
            self::$password = $password;
        }


    }
