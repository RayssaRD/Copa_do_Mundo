<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$selecoes = [
    ['nome' => 'Brasil',         'grupo' => 'A', 'titulos' => 5],
    ['nome' => 'Sérvia',         'grupo' => 'A', 'titulos' => 0],
    ['nome' => 'Suíça',          'grupo' => 'A', 'titulos' => 0],
    ['nome' => 'Camarões',       'grupo' => 'A', 'titulos' => 0],
    ['nome' => 'Inglaterra',     'grupo' => 'B', 'titulos' => 1],
    ['nome' => 'Irã',            'grupo' => 'B', 'titulos' => 0],
    ['nome' => 'Estados Unidos', 'grupo' => 'B', 'titulos' => 0],
    ['nome' => 'País de Gales',  'grupo' => 'B', 'titulos' => 0],
    ['nome' => 'Argentina',      'grupo' => 'C', 'titulos' => 3],
    ['nome' => 'Arábia Saudita', 'grupo' => 'C', 'titulos' => 0],
    ['nome' => 'México',         'grupo' => 'C', 'titulos' => 0],
    ['nome' => 'Polônia',        'grupo' => 'C', 'titulos' => 0],
    ['nome' => 'França',         'grupo' => 'D', 'titulos' => 2],
    ['nome' => 'Austrália',      'grupo' => 'D', 'titulos' => 0],
    ['nome' => 'Dinamarca',      'grupo' => 'D', 'titulos' => 0],
    ['nome' => 'Tunísia',        'grupo' => 'D', 'titulos' => 0],
    ['nome' => 'Espanha',        'grupo' => 'E', 'titulos' => 1],
    ['nome' => 'Costa Rica',     'grupo' => 'E', 'titulos' => 0],
    ['nome' => 'Alemanha',       'grupo' => 'E', 'titulos' => 4],
    ['nome' => 'Japão',          'grupo' => 'E', 'titulos' => 0],
    ['nome' => 'Bélgica',        'grupo' => 'F', 'titulos' => 0],
    ['nome' => 'Canadá',         'grupo' => 'F', 'titulos' => 0],
    ['nome' => 'Marrocos',       'grupo' => 'F', 'titulos' => 0],
    ['nome' => 'Croácia',        'grupo' => 'F', 'titulos' => 0],
    ['nome' => 'Portugal',       'grupo' => 'G', 'titulos' => 0],
    ['nome' => 'Gana',           'grupo' => 'G', 'titulos' => 0],
    ['nome' => 'Uruguai',        'grupo' => 'G', 'titulos' => 2],
    ['nome' => 'Coreia do Sul',  'grupo' => 'G', 'titulos' => 0],
    ['nome' => 'Holanda',        'grupo' => 'H', 'titulos' => 0],
    ['nome' => 'Senegal',        'grupo' => 'H', 'titulos' => 0],
    ['nome' => 'Equador',        'grupo' => 'H', 'titulos' => 0],
    ['nome' => 'Catar',          'grupo' => 'H', 'titulos' => 0],
];

$action = $_GET['action'] ?? 'listar';
$nome   = strtolower(trim($_GET['nome'] ?? ''));

switch ($action) {
    case 'listar':
        echo json_encode(['status' => 'ok', 'data' => $selecoes]);
        break;

    case 'buscar':
        if (empty($nome)) { http_response_code(400); echo json_encode(['status' => 'erro', 'msg' => 'Parâmetro nome obrigatório.']); break; }
        $result = array_values(array_filter($selecoes, fn($s) => strpos(strtolower($s['nome']), $nome) !== false));
        echo empty($result)
            ? (http_response_code(404) ?: json_encode(['status' => 'erro', 'msg' => 'Não encontrada.']))
            : json_encode(['status' => 'ok', 'data' => $result]);
        break;

    case 'grupo':
        if (empty($nome)) { http_response_code(400); echo json_encode(['status' => 'erro', 'msg' => 'Parâmetro nome obrigatório.']); break; }
        $found = null;
        foreach ($selecoes as $s) { if (strpos(strtolower($s['nome']), $nome) !== false) { $found = $s; break; } }
        echo $found
            ? json_encode(['status' => 'ok', 'nome' => $found['nome'], 'grupo' => $found['grupo']])
            : (http_response_code(404) ?: json_encode(['status' => 'erro', 'msg' => 'Não encontrada.']));
        break;

    case 'titulos':
        if (empty($nome)) { http_response_code(400); echo json_encode(['status' => 'erro', 'msg' => 'Parâmetro nome obrigatório.']); break; }
        $found = null;
        foreach ($selecoes as $s) { if (strpos(strtolower($s['nome']), $nome) !== false) { $found = $s; break; } }
        echo $found
            ? json_encode(['status' => 'ok', 'nome' => $found['nome'], 'titulos' => $found['titulos']])
            : (http_response_code(404) ?: json_encode(['status' => 'erro', 'msg' => 'Não encontrada.']));
        break;

    default:
        http_response_code(400);
        echo json_encode(['status' => 'erro', 'msg' => 'Ações válidas: listar, buscar, grupo, titulos']);
}
?>