<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Seleção</title>
</head>
<body>
    <h1>Nova Seleção</h1>
    <form method="POST" action="index.php?acao=salvar">
        <p>
            <label>Nome:</label><br>
            <input type="text" name="Nome" required>
        </p>
        <p>
            <label>grupo:</label><br>
            <input type="text" name="Grupo" required>
        </p>
        <p>
            <label>titulos:</label><br>
            <input type="text" name="Títulos" required>
        </p>
        <p>
            <label>cadastrado em:</label><br>
            <input type="text" name="cadastrado_em" required>
        </p>

        <button type="submit">Salvar seleção</button>
        <a href="index.php">Voltar para a lista</a>
    </form>
</body>
</html>