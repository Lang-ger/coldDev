<?php
class adm{

	private $idadm;
	private $nome;
	private $login;
	private $senha;

	public static $instance;

	public function __construct(){
		require_once ('connect.php');
	}

 	public static function getInstance(){
  		if (!isset(self::$instance)){
  			self::$instance = new adm();
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

	//Método salvar
	public function salvar(){
		try{

		    $sql = "insert into adm (nome, login, senha)
 			values(:p1,:p2,:p3)";
			$con = connect::getInstance()->prepare($sql);
			$con->bindValue(":p1", $this->nome);
			$con->bindValue(":p2", $this->login);
			$con->bindValue(":p3", $this->senha);

			$result = $con->execute();
			return $result;
		} catch (Exception $e) {
		echo "Ocorreu um erro ". $e->getMessage();
		}
	}

//Método alterar
	public function alterar(){
		try{

 			$sql = "update adm set nome=:p1,login=:p2,senha=:p3, where idadm=:p4";
			$con = connect::getInstance()->prepare($sql);
			$con->bindValue(":p1", $this->nome);
			$con->bindValue(":p2", $this->login);
			$con->bindValue(":p3", $this->senha);
			$con->bindValue(":p4", $this->idadm);
			$result = $con->execute();
			return $result;
		} catch (Exception $e) {
		echo "Ocorreu um erro ". $e->getMessage();
		}
	}


	public function excluir(){
		try{
			$sql = "delete from adm where idadm=:p1";
			$con = connect::getInstance()->prepare($sql);
			$con->bindValue(":p1", $this->idadm);
			$result = $con->execute();
			return $result;
		} catch (Exception $e) {
			echo "Ocorreu um erro ". $e->getMessage();
		}
	}

  public function  procurar(){
  	try{
  		$sql = "select * from adm where idadm=:p1";
  		$con = connect::getInstance()->prepare($sql);
  		$con->bindValue(":p1", $this->idadm);
  		$con->execute();
  		return $con;
  	} catch (Exception $e) {
			echo "Ocorreu um erro ao consultar ". $e->getMessage();
		}
	}

	public function  validar(){
  	try{
  		$sql = "select * from adm where login=:p1 and senha=:p2";
  		$con = connect::getInstance()->prepare($sql);
  		$con->bindValue(":p1", $this->login);
  		$con->bindValue(":p2", $this->senha);
  		$con->execute();
  		return $con->rowCount();//Se for maior que 0 achou e é válido
  	} catch (Exception $e) {
			echo "Ocorreu um erro ao validar ". $e->getMessage();
		}
	}

  public function  consultar(){
  	try{
  		$sql = "select * from adm where idadm=:p1";
  		$con = connect::getInstance()->prepare($sql);
		$con->bindValue(":p1", $idadm);
  		$con->execute();
  		return $con;
  	} catch (Exception $e) {
			echo "Ocorreu um erro ao consultar ". $e->getMessage();
		}
	}

}

?>
