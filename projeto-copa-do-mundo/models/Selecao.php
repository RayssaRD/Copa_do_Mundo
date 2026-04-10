<?php 

    class Selecao{
        private $conn;
        private $table = "selecoes"; //nome da tabela no MYSQL

        //constuct 
        public function __construct($db){
            $this ->conn = $db; //conn= instância o banco de dados
        }

        //listar todas as selecoes (READ)sssss
        public function buscarTodos(){
            $query = "SELECT * FROM " . $this->table. " ORDER BY nome ASC"; //ASC: Ordem alfabética
            $stmt = $this->conn->prepare($query); //prepara a consulta SQL
            $stmt->execute(); //executa a consulta SQL
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //Salvar novo estudante (CREATE)

        public function salvar($dados){
            $query = "INSERT INTO " . $this->table. " (nome, grupo, titulos, criado_em) VALUES (:nome, :grupo, :titulos, :criado_em)"; 
            //: serve para a segurança do banco de dados
            $stmt = $this->conn->prepare($query);

            //Blindar SQL
            $stmt -> bindParam(':nome', $dados['nome']);
            $stmt -> bindParam(':grupo', $dados['grupo']);
            $stmt -> bindParam(':titulos', $dados['titulos']);
            $stmt -> bindParam(':criado_em', $dados['criado_em']);

            return $stmt->execute();
        }
            // UPDATE
        public function atualizarDados($dados){
    // Remova o espaço de "criado em" na query SQL [cite: 69]
    $query = "UPDATE " . $this->table. "
                SET nome = :nome, grupo = :grupo, titulos = :titulos, criado_em = :criado_em
                WHERE id = :id";

    $stmt = $this->conn->prepare($query);
    
    // Ajuste o bindParam para usar a chave correta sem espaço
    $stmt->bindParam(':nome', $dados['nome']);
    $stmt->bindParam(':grupo', $dados['grupo']);
    $stmt->bindParam(':titulos', $dados['titulos']);
    $stmt->bindParam(':criado_em', $dados['criado_em']); // Aqui!
    $stmt->bindParam(':id', $dados['id']);
    
    return $stmt->execute();
}
            //READ ONE 
        public function buscarPorId($id) {
            $query = "SELECT * FROM " .$this->table . " WHERE id= ? LIMIT 0,1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt-> execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }

        //delete (DELETE)
        public function deletar($id) {
            $query = "DELETE FROM " . $this->table . " WHERE id= ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);
            return $stmt->execute();
        }
 }
?>