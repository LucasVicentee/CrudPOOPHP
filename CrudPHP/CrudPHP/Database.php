<?php
class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $DBConn;

    public function __construct($servidor, $nomeBanco, $usuario, $senha) {
        $this->host = $servidor;
        $this->db_name = $nomeBanco;
        $this->username = $usuario;
        $this->password = $senha;
        $this->DBConn = $this->getConnection();
    }

    public function getConnection() {
        try{
            $conexao = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
        }
        catch(PDOException $e){
            echo "Error. Erro com conexão ao banco de dados." . $e->getMessage();
            exit();
        }

        return $conexao;
    }
}

class DBClientes {
    private $conexao;
    private $tableName = 'clientes';

    public function __construct($conexaoBD) {
        $this->conexao = $conexaoBD;
    }

    public function create($id, $nome, $cpf, $email) {
        $query = "INSERT INTO " . $this->tableName .  " (id, nome, cpf, email) VALUES(:id, :nome, :cpf, :email)";

        try{

            $result = $this->conexao->prepare($query);

            $result->bindParam(':id', $id);
            $result->bindParam(':nome', $nome);
            $result->bindParam(':cpf', $cpf);
            $result->bindParam(':email', $email);

            if($result->execute()){
                return true;
            }
            else{
                return false;
            };
        }
        catch(PDOException $e){
            echo "Erro PDO." . $e->getMessage();
        }
    }

    public function recovery() {
        $query = "SELECT * FROM " . $this->tableName;

        try{
            $result = $this->conexao->prepare($query);
            $result->execute();

            $dados = $result->fetchALL(PDO::FETCH_ASSOC);
        }
        catch(PDOExceptiom $e){
            echo "Erro ao recuperar clientes: " . $e->getMessage();
        }

        return $dados;
    }

    public function recoveryById($idBusca) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE id = :id";

        try{

            $result = $this->conexao->prepare($query);

             // Vincula o parâmetro :id ao valor de $idBusca
            $result->bindParam(":id", $idBusca, PDO::PARAM_INT);

            $result->execute();

            $cliente = $result->fetch(PDO::FETCH_ASSOC);

            // Verifica se o cliente foi encontrado
            if ($cliente) {
                return $cliente;
            } else {
                echo "Cliente não encontrado.";
                return null;
            }
        }
        catch(PDOException $e){
            echo "Erro ao recuperar cliente pelo ID. " . $e->getMessage();
        }
    }

    public function recoveryByName($nomeBusca) {
        $query = " SELECT * FROM " . $this->tableName . " WHERE nome = :nome";

        try{
            $result = $this->conexao->prepare($query);

            $result->bindParam(":nome", $nomeBusca);
            
            $result->execute();

            $cliente = $result->fetch(PDO::FETCH_ASSOC);

            if ($cliente) {
                return $cliente;
            } else {
                echo "Cliente não encontrado.";
                return null;
            }
        }
        catch(PDOException $e){
            echo "Erro ao recuperar cliente pelo nome. " . $e->getMessage();
        }

        return $cliente;
    }

    public function update($id, $nome, $cpf, $email) {
        $query = " UPDATE " . $this->tableName . " SET nome = :nome, cpf = :cpf, email = :email WHERE id = :id ";

        try{
            $result = $this->conexao->prepare($query);

            $result->bindParam(":id", $id);
            $result->bindParam(":nome", $nome);
            $result->bindParam(":cpf", $cpf);
            $result->bindParam(":email", $email);

            $result->execute();

             // Verificar o número de linhas afetadas para determinar se a atualização foi bem-sucedida
             if ($result->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
        catch (PDOException $e) {
            echo "Erro ao atualizar cliente: " . $e->getMessage();
        }
    }

    public function delete($id) {
        $query = " DELETE FROM " . $this->tableName . " WHERE id = :id ";

        try{
            $result = $this->conexao->prepare($query);
            
            $result->bindParam(":id", $id);

            $result->execute();

            if($result->rowCount() > 0){
                return true;
            }
            else{
                return false;
            }
        }
        catch(PDOExcepition $e){
            echo "Erro ao apagar dados do cliente. " . $e->getMessage();
        }
    }
}







