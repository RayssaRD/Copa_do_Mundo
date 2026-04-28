<?php 
require_once './models/Selecao.php';
require_once './config/database.php';

class SelecaoController {
    private $db;
    private $selecao;

    public function __construct() {
        $database      = new Database();
        $this->db      = $database->getConnection();
        $this->selecao = new Selecao($this->db);
    }

    public function index() {
        $selecoes = $this->selecao->buscarTodos();
        require_once './views/listaIndex.php';
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dados = [
                'nome'    => htmlspecialchars(trim($_POST['nome']),    ENT_QUOTES, 'UTF-8'),
                'grupo'   => htmlspecialchars(trim($_POST['grupo']),   ENT_QUOTES, 'UTF-8'),
                'titulos' => htmlspecialchars(trim($_POST['titulos']), ENT_QUOTES, 'UTF-8'),
            ];

            if (empty($dados['nome']) || empty($dados['grupo'])) {
                header("Location: index.php?status=erro&msg=Preencha todos os campos!");
                exit;
            }

            if ($this->selecao->salvar($dados)) {
                header("Location: index.php?status=sucesso");
                exit;
            } else {
                header("Location: index.php?status=erro&msg=Erro ao salvar");
                exit;
            }
        }
    }

    public function editar($id) {
        $selecao = $this->selecao->buscarPorId($id);
        if ($selecao) {
            require_once './views/edit.php';
        } else {
            header("Location: index.php?status=erro&msg=Seleção não encontrada");
            exit;
        }
    }

    public function atualizarDados() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'id'      => (int)$_POST['id'],
                'nome'    => htmlspecialchars(trim($_POST['nome']),    ENT_QUOTES, 'UTF-8'),
                'grupo'   => htmlspecialchars(trim($_POST['grupo']),   ENT_QUOTES, 'UTF-8'),
                'titulos' => htmlspecialchars(trim($_POST['titulos']), ENT_QUOTES, 'UTF-8'),
            ];

            if ($this->selecao->atualizarDados($dados)) {
                header("Location: index.php?status=sucesso&msg=Atualizado!");
                exit;
            } else {
                header("Location: index.php?status=erro&msg=Erro ao atualizar");
                exit;
            }
        }
    }

    public function deletar($id) {
        if ($this->selecao->deletar($id)) {
            header("Location: index.php?status=sucesso&msg=Excluído!");
            exit;
        }
    }
}