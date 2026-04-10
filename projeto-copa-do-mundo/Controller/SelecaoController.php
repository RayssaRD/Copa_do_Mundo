<?php 
require_once './models/Selecao.php';
require_once './config/database.php';

class SelecaoController {
    private $db;
    private $selecao;

    public function __construct() {
        //Preparar conexão com BD
        $database = new Database();
        $this->db = $database->getConnection();

        //instanciar a Model Estudante
        $this->selecao = new Selecao($this->db);

    }

    /*Ação */
    //listar todos as seleções na tela inicial
    public function index() {
        //pede lista de dados ao Model
        $selecoes = $this->selecao->buscarTodos();

        require_once './views/listaIndex.php';
    }

    public function salvar() {
        //verifica se o formulário foi enviado via POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dados = [
                'nome'  => htmlspecialchars(trim($_POST['nome']), ENT_QUOTES, 'UTF-8'),
                'rupo'  => htmlspecialchars(trim($_POST['grupo']), ENT_QUOTES, 'UTF-8'),
                'titulos'  => htmlspecialchars(trim($_POST['titulos']), ENT_QUOTES, 'UTF-8'),
                'criado em'  => htmlspecialchars(trim($_POST['criado_em']), ENT_QUOTES, 'UTF-8'),

            ];

            //VALIDANDO 
            //IMPEDIR QUE CAMPOS VAZIOS CHEGUEM NO BANCO
            if (empty($dados['nome'])|| empty($dados['grupo'])){

                header("Location: index.php?status=erro&msg=Preencha todos os campos!");
                exit;
            }
            //PERSISTÊNCIA DE DADOS: SALVAR INFORMAÇÕES NO BD E GUARDÁ-LOS MESMO QUE HAJA UM ENCERRAMENTO 
            // DO PROGRAMA OU DESLIGAMENTO DO SISTEMA

            //Chamar o Model para salvar dados limpos
            if ($this->selecao->salvar($dados)){
                //Redireciona o status de sucesso
                header("Location: index.php?status=sucesso");
                exit;

            } else {
                header("Location: index.php?status=erro&msg=Erro ao salvar");
                exit;
            }
        }
    }

    public function criar(){
        require_once './views/create.php';
    }

    public function editar($id){
        $selecao = $this->selecao->buscarPorId($id);
        if ($selecao) {
            require_once './View/edit.php';
        } else {
            header("Location: index.php?status=erro&msg=Seleção não encontrado");
        }
    }

    public function atualizarDados() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'id'    => (int)$_POST['id'],
                'nome'  => htmlspecialchars(trim($_POST['nome']), ENT_QUOTES, 'UTF-8'),
                'grupo'  => htmlspecialchars(trim($_POST['grupo']), ENT_QUOTES, 'UTF-8'),
                'titulos'  => htmlspecialchars(trim($_POST['titulos']), ENT_QUOTES, 'UTF-8'),
                'cadastrado em'  => htmlspecialchars(trim($_POST['cadastrado em']), ENT_QUOTES, 'UTF-8'),

            ];

            if($this->estudante->atualizarDados($dados)){
                header("Location: index.php?status=sucesso&msg=Atualizado!");
            }
        }
    }

    public function deletar($id) {
        if ($this->selecao-> deletar($id)){
            header("Location: index.php?status=sucesso&msg=Excluído!");
        }
    }
}
?>