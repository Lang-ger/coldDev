<?php
	class Connect{
		//Atributos
		private static $host  = "mysql:host=localhost;dbname=colddev";
		private static $user  = "root";
		private static $pass  = "";
		public	static $instance;

		//Métodos
		public function __construct(){

		}

		public  static function getInstance(){
	    if (!isset(self::$instance)) {
	    self::$instance = new PDO(self::$host, self::$user,
	    self::$pass,
	    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

	    self::$instance->setAttribute(PDO::ATTR_ERRMODE,
	      	PDO::ERRMODE_EXCEPTION);
	    }
	    return self::$instance;
		}

}