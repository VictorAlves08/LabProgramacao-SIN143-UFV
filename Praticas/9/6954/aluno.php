<?php
class Aluno
{
    private $db;
    private $servername = "localhost";
    private $dbname = "escola";
    private $username = "root";
    private $password = "";

    public function __construct()
    {
        $this->db = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
    }

    public function criarAluno($nome, $telefone, $email, $cidade, $bairro, $rua, $numero)
    {
        $query_endereco = "INSERT INTO endereco (Cidade, Bairro, Rua, Numero) VALUES (:cidade, :bairro, :rua, :numero)";
        $stmt_endereco = $this->db->prepare($query_endereco);
        $stmt_endereco->bindParam(":cidade", $cidade);
        $stmt_endereco->bindParam(":bairro", $bairro);
        $stmt_endereco->bindParam(":rua", $rua);
        $stmt_endereco->bindParam(":numero", $numero);
        $stmt_endereco->execute();

        $fk_ID_Endereco = $this->db->lastInsertId();
        $query_aluno = "INSERT INTO aluno (nome, email, telefone, fk_ID_Endereco) VALUES (:nome, :email, :telefone, :fk_ID_Endereco)";
        $stmt_aluno = $this->db->prepare($query_aluno);
        $stmt_aluno->bindParam(":nome", $nome);
        $stmt_aluno->bindParam(":email", $email);
        $stmt_aluno->bindParam(":telefone", $telefone);
        $stmt_aluno->bindParam(":fk_ID_Endereco", $fk_ID_Endereco);
        $stmt_aluno->execute();
    }

    public function buscarAluno($ID_Aluno)
    {
        $query = "SELECT * FROM aluno 
             JOIN endereco 
             ON aluno.fk_ID_Endereco = endereco.ID_Endereco
             WHERE aluno.ID_Aluno = $ID_Aluno";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarAluno($id, $nome, $telefone, $email, $cidade, $bairro, $rua, $numero)
    {
        $query_endereco_id = "SELECT fk_ID_Endereco FROM aluno WHERE ID_Aluno = $id";
        $stmt_endereco_id = $this->db->prepare($query_endereco_id);
        $stmt_endereco_id->execute();
        $endereco_id = $stmt_endereco_id->fetchColumn();

        $query_endereco = "UPDATE endereco SET Cidade = :cidade, Bairro = :bairro, Rua = :rua, Numero = :numero WHERE ID_Endereco = $endereco_id ";
        $stmt_endereco = $this->db->prepare($query_endereco);
        $stmt_endereco->bindParam(":cidade", $cidade);
        $stmt_endereco->bindParam(":bairro", $bairro);
        $stmt_endereco->bindParam(":rua", $rua);
        $stmt_endereco->bindParam(":numero", $numero);
        $stmt_endereco->execute();

        $query_aluno = "UPDATE aluno SET Nome = :nome, Telefone = :telefone, Email = :email WHERE ID_Aluno = $id";
        $stmt_aluno = $this->db->prepare($query_aluno);
        $stmt_aluno->bindParam(":nome", $nome);
        $stmt_aluno->bindParam(":telefone", $telefone);
        $stmt_aluno->bindParam(":email", $email);
        $stmt_aluno->execute();
    }

    public function apagarAluno($id)
    {
        $query_endereco_id = "SELECT fk_ID_Endereco FROM aluno WHERE ID_Aluno = :ID_Aluno";
        $stmt_endereco_id = $this->db->prepare($query_endereco_id);
        $stmt_endereco_id->bindParam(":ID_Aluno", $id);
        $stmt_endereco_id->execute();
        $endereco_id = $stmt_endereco_id->fetchColumn();

        $query_delete_aluno = "DELETE FROM aluno WHERE ID_Aluno = :ID_Aluno";
        $stmt_aluno = $this->db->prepare($query_delete_aluno);
        $stmt_aluno->bindParam(":ID_Aluno", $id);
        $stmt_aluno->execute();

        $query_delete_endereco = "DELETE FROM endereco WHERE ID_Endereco = :ID_Endereco";
        $stmt_endereco = $this->db->prepare($query_delete_endereco);
        $stmt_endereco->bindParam(":ID_Endereco", $endereco_id);
        $stmt_endereco->execute();
    }

    public function listarAlunos()
    {
        $query = "SELECT ID_Aluno, Nome FROM aluno";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalAlunos()
    {
        $query = "SELECT COUNT(ID_Aluno) FROM aluno";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchColumn();
    }
}
