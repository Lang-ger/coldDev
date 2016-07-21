<?php
class TempUmiReal{

	private $codTemperatura; 
	private $dataLog;
  	private $temperatura;
	private $umidade;
	private $codDef;
	private $tempMin;
	private $tempMax;
	private $umidMin;
	private $umidMax;
	private $definicao;

	public static $instance;

	public function __construct(){
		require_once ('connect.php');
	}

 	public static function getInstance(){
  		if (!isset(self::$instance)){
  			self::$instance = new TempUmiReal();
  		}
  		return self::$instance;
 	 }

	//Estamos gerando aqui os Get's e Set's
    public function __set($var, $val){
        $this->$var = $val;
    }

	public function __get($var){
        return $this->$var;
    }

  public function consultTempUmiReal(){
  	try{
      $sql = "select temperatura, umidade from log_temperatura order by codTemperatura desc limit 1";
  		$con = Connect::getInstance()->prepare($sql);
  		$con->execute();
  		return $con;
  	} catch (Exception $e) {
			echo "Ocorreu um erro ao consultar ". $e->getMessage();
		}
	}

	public function consultMinMax(){
  	try{
      	$sql = "select tempMin, tempMax, umidMin, umidMax from def_table order by codDef desc limit 1";
  		$con = Connect::getInstance()->prepare($sql);
  		$con->bindValue(":p1", $this->definicao);
  		$con->execute();
  		return $con;
  	} catch (Exception $e) {
			echo "Ocorreu um erro ao consultar ". $e->getMessage();
		}
	}

	public function consultarDefinicao(){
		try{
			$sql = "select codDef, definicao, tempMin from def_table";
			$con = Connect::getInstance()->prepare($sql);
			$con->execute();
			return $con;
		} catch (Exception $e) {
			echo "Ocorreu um erro ao consultar ". $e->getMessage();
		}
	}

	public function consultarValoresDef(){
		try{
			$sql = "select codDef, tempMin, tempMax, umidMin, umidMax from def_table";
			$con = Connect::getInstance()->prepare($sql);
			$con->execute();
			return $con;
		} catch (Exception $e) {
			echo "Ocorreu um erro ao consultar ". $e->getMessage();
		}
	}

	public function listDia(){
		try{
			$sql = "select dataLog, codTemperatura, temperatura, umidade from log_temperatura order by dataLog desc limit 1";
			$con = Connect::getInstance()->prepare($sql);
			$con->execute();
			return $con;
		} catch (Exception $e) {
			echo "Ocorreu um erro ao consultar ". $e->getMessage();
		}
	}

	/*

	SET @ultimaData := (SELECT publicacao FROM teste1 ORDER BY publicacao DESC LIMIT 1);

SELECT titulo, publicacao FROM teste1 
WHERE YEAR(publicacao) = YEAR(@ultimaData) 
AND MONTH(publicacao) =  MONTH(@ultimaData);

*/

	public function consultarValoresDefinicao($codDef){
		try{
			$sql = "select tempMin, tempMax, umidMin, umidMax from def_table where codDef=:p1";
			$con = Connect::getInstance()->prepare($sql);
			$con->bindValue(":p1", $codDef);
			$con->execute();
			return $con;
		} catch (Exception $e) {
			echo "Ocorreu um erro ao consultar ". $e->getMessage();
		}
	}

	public function salvarAlterar($codDef){
		try{
			$sql = "insert into BANCO VALUES(definicao, tempMin, tempMax, umidMin, UmidMax";
			$con = Connect::getInstance()->prepare($sql);
			$con->execute();
			return $con;
		} catch (Exception $e) {
			echo "Ocorreu um erro ao consultar ". $e->getMessage();
		}
	}

	public function salvarDefinicao(){
		try{
			$sql = "insert into def_table (definicao, tempMin, tempMax, umidMin, umidMax)
			values(:p1,:p2,:p3,:p4,:p5)";
			$con = Connect::getInstance()->prepare($sql);
			$con->bindValue(":p1", $this->definicao);
			$con->bindValue(":p2", $this->tempMin);
			$con->bindValue(":p3", $this->tempMax);
			$con->bindValue(":p4", $this->umidMin);
			$con->bindValue(":p5", $this->umidMax);
			
			$result = $con->execute();
			return $result;
		} catch (Exception $e) {
			echo "Ocorreu um erro ao salvar" . $e->getMessage();
		}

	}

		public function alterarDefinicao(){
		try{

 			$sql = "update def_table set tempMin=:p1,tempMax=:p2,umidMin=:p3,umidMax=:p4,definicao=:p5 where codDef=:p6";
			$con = Connect::getInstance()->prepare($sql);
			$con->bindValue(":p1", $this->tempMin);
			$con->bindValue(":p2", $this->tempMax);
			$con->bindValue(":p3", $this->umidMin);
			$con->bindValue(":p4", $this->umidMax);
			$con->bindValue(":p5", $this->definicao);
			$con->bindValue(":p6", $this->codDef); 
			$result = $con->execute();
			return $result;
		} catch (Exception $e) { 
		echo "Ocorreu um erro ". $e->getMessage();
		}	
	} 


	public function excluirDefinicao(){
		try{
			$sql = "delete from def_table where codDef=:p1";
			$con = Conexao::getInstance()->prepare($sql);
			$con->bindValue(":p1", $this->codDef); 
			$result = $con->execute();
			return $result;		
		} catch (Exception $e) { 
			echo "Ocorreu um erro ". $e->getMessage();
		}
	}

  public function  procurarDefinicao(){
  	try{
  		$sql = "select * from def_table where codDef=:p1";
  		$con = Conexao::getInstance()->prepare($sql);
  		$con->bindValue(":p1", $this->codDef); 
  		$con->execute();
  		return $con;
  	} catch (Exception $e) { 
			echo "Ocorreu um erro ao consultar ". $e->getMessage();
		}
	}
/*
SELECT column_name FROM table_name
ORDER BY column_name DESC
LIMIT 1;
*/

}