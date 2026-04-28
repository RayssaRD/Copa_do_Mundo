<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Seleção</title>
</head>
<body>
    <h2>Editar Seleção</h2>
    <form method="POST" action="index.php?action=atualizar">
        <input type="hidden" name="id" value="<?= (int)$selecao['id'] ?>">
        <p>
            Nome: <input type="text" name="nome"
                         value="<?= htmlspecialchars($selecao['nome'], ENT_QUOTES, 'UTF-8') ?>"
                         required>
        </p>
        <p>
            Grupo: <input type="text" name="grupo"
                          value="<?= htmlspecialchars($selecao['grupo'], ENT_QUOTES, 'UTF-8') ?>"
                          required>
        </p>
        <p>
            Títulos: <input type="number" name="titulos" min="0"
                            value="<?= htmlspecialchars($selecao['titulos'], ENT_QUOTES, 'UTF-8') ?>"
                            required>
        </p>
        <p>
            Criado em: <strong><?= htmlspecialchars($selecao['criado_em'], ENT_QUOTES, 'UTF-8') ?></strong>
        </p>
        <button type="submit">Salvar Alterações</button>
        <a href="index.php">Voltar para a lista</a>
    </form>
</body>
</html>