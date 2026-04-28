<?php 

class Selecao {
    private $conn;
    private $table = "selecoes";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function buscarTodos() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY nome ASC";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar($dados) {
        $query = "INSERT INTO " . $this->table . " (nome, grupo, titulos) VALUES (:nome, :grupo, :titulos)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':nome',    $dados['nome']);
        $stmt->bindParam(':grupo',   $dados['grupo']);
        $stmt->bindParam(':titulos', $dados['titulos']);
        return $stmt->execute();
    }

    public function atualizarDados($dados) {
        $query = "UPDATE " . $this->table . "
                  SET nome = :nome, grupo = :grupo, titulos = :titulos
                  WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':nome',    $dados['nome']);
        $stmt->bindParam(':grupo',   $dados['grupo']);
        $stmt->bindParam(':titulos', $dados['titulos']);
        $stmt->bindParam(':id',      $dados['id']);
        return $stmt->execute();
    }

    public function buscarPorId($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 1";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deletar($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }
}