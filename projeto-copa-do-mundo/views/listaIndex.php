<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copa do Mundo</title>
</head>
<body>
    <h1>Seleções Cadastradas</h1>
    <p> <a href="index.php?action=novo"> + Cadastrar Nova Seleção</a></p>
    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>grupo</th>
                <th>titulos</th>
                <th>Criado em</th>
            </tr>
        </thead> 
        <tbody>
            <?php foreach ($selecoes as $selecao): ?>
            <tr>
                <td><?= htmlspecialchars($selecao['nome']) ?></td>
                <td><?= htmlspecialchars($selecao['grupo']) ?></td>
                <td><?= htmlspecialchars($selecao['titulos']) ?></td>
                <td><?= htmlspecialchars($selecao['criado_em']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    
</body>
</html>