<?php
class syslog {

	private $codTemperatura; 
	private $dataLog;
  	private $temperatura;
	private $umidade;

	public static $instancia;

	public function __construct(){
		require_once ('connect.php');
	}

	public static function pegarInstancia(){
		if (!isset(self::$instancia)){
			self::$instancia = new syslog();
		}
		return self::$instancia;
	}

	//Gerando Gets e Sets

	public function __set($variavel, $valor){
		$this->$variavel = $valor;
	}

	public function __get($variavel){
		return $this->$variavel;
	}

	public function listarDia(){
		try{
			$sql = "SELECT * FROM log_temperatura WHERE dataLog BETWEEN TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 day)) AND NOW()";
			$con = Connect::getInstance()->prepare($sql);
			$con->execute();
			return $con;
		} catch (Exception $e) {
			echo "Ocorreu um erro ao consultar".$e->getMessage();
		}
	}

	public function listarSemana(){
		try{
			$sql = "SELECT * FROM log_temperatura WHERE dataLog BETWEEN TIMESTAMP(DATE_SUB(NOW(), INTERVAL 7 day)) AND NOW()";
			$con = Connect::getInstance()->prepare($sql);
			$con->execute();
			return $con;
		} catch (Exception $e) {
			echo "Ocorreu um erro ao consultar".$e->getMessage();
		}
	}

	public function listarMes(){
		try{
			$sql = "SELECT * FROM log_temperatura WHERE dataLog BETWEEN TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 month)) AND NOW()";
			$con = Connect::getInstance()->prepare($sql);
			$con->execute();
			return $con;
		} catch (Exception $e) {
			echo "Ocorreu um erro ao consultar".$e->getMessage();
		}
	}

	public function listarBimes(){
		try{
			$sql = "SELECT * FROM log_temperatura WHERE dataLog BETWEEN TIMESTAMP(DATE_SUB(NOW(), INTERVAL 2 month)) AND NOW()";
			$con = Connect::getInstance()->prepare($sql);
			$con->execute();
			return $con;
		} catch (Exception $e) {
			echo "Ocorreu um erro ao consultar".$e->getMessage();
		}
	}

	public function listarSemestre(){
		try{
			$sql = "SELECT * FROM log_temperatura WHERE dataLog BETWEEN TIMESTAMP(DATE_SUB(NOW(), INTERVAL 6 month)) AND NOW()";
			$con = Connect::getInstance()->prepare($sql);
			$con->execute();
			return $con;
		} catch (Exception $e) {
			echo "Ocorreu um erro ao consultar".$e->getMessage();
		}
	}

	public function listarAnual(){
		try{
			$sql = "SELECT * FROM log_temperatura WHERE dataLog BETWEEN TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 year)) AND NOW()";
			$con = Connect::getInstance()->prepare($sql);
			$con->execute();
			return $con;
		} catch (Exception $e) {
			echo "Ocorreu um erro ao consultar".$e->getMessage();
		}
	}

	public function listarTudo(){
		try{
			$sql = "SELECT * FROM log_temperatura";
			$con = Connect::getInstance()->prepare($sql);
			$con->execute();
			return $con;
		} catch (Exception $e) {
			echo "Ocorreu um erro ao consultar".$e->getMessage();
		}
	}
}

?>
