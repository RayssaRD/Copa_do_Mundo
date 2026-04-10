<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
    <h2>Editar seleção</h2>

    <form method="POST" action="index.php?action=atualizar"> 
        <input type="hidden" name="id" value="<?= $selecao['id']?>">
        <p>
            Nome: <input type="text" name="Nome" value="<?= safe($selecao['nome'])?>" required>
        </p>  
        <p> 
            Grupo: <input type="text" name="Grupo" value="<?= safe($selecao['grupo'])?>" required>
        </p>  
        <p>  
            Títulos: <input type="text" name="Titulos" value="<?= safe($selecao['titulos'])?>" required>
        </p>
        <p>  
            Criado em: <input type="text" name="criado em" value="<?= safe($selecao['criado em'])?>" required>
        </p>
       
        <button type="submit"> Salvar Alterações </button>
    </form>
</body>
</html>