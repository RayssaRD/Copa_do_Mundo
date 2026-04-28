<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copa do Mundo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Barlow', sans-serif;
            background: #0a1a0e;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        .bg-trophy {
            position: fixed;
            inset: 0;
            background-image: url('../assets/copa.jpg');
            background-size: cover;
            background-position: center 30%;
            filter: blur(6px) brightness(0.35);
            transform: scale(1.05);
            z-index: 0;
        }

        .bg-overlay {
            position: fixed;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.2) 0%, rgba(5,20,8,0.7) 60%, rgba(5,20,8,0.95) 100%);
            z-index: 1;
        }

        .content {
            position: relative;
            z-index: 2;
            padding: 2rem 1.5rem 3rem;
            max-width: 1100px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            padding: 2.5rem 0 2rem;
            animation: fadeDown 0.6s ease both;
        }

        .header-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #c9a84c;
            margin-bottom: 0.5rem;
        }

        .header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(2.8rem, 6vw, 4.5rem);
            color: #fff;
            letter-spacing: 3px;
            line-height: 1;
        }

        .header h1 span { color: #c9a84c; }

        .header-divider {
            width: 60px;
            height: 2px;
            background: #c9a84c;
            margin: 1rem auto 0;
            border-radius: 2px;
        }

        .flash {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 1.5rem;
            max-width: 500px;
        }
        .flash.sucesso { background: rgba(40,167,69,0.2); border: 1px solid rgba(40,167,69,0.4); color: #6fcf97; }
        .flash.erro    { background: rgba(220,53,69,0.2);  border: 1px solid rgba(220,53,69,0.4);  color: #f48a96; }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 12px;
            animation: fadeUp 0.5s ease 0.2s both;
        }

        .top-bar h2 {
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
        }

        .btn-novo {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #c9a84c;
            color: #0a1a0e;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 9px 20px;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
        }
        .btn-novo:hover { background: #e0bc62; transform: translateY(-1px); }

        .table-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            overflow: hidden;
            animation: fadeUp 0.5s ease 0.3s both;
        }

        table { width: 100%; border-collapse: collapse; font-size: 14px; }

        thead tr {
            background: rgba(201,168,76,0.12);
            border-bottom: 1px solid rgba(201,168,76,0.25);
        }

        thead th {
            padding: 13px 16px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #c9a84c;
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid rgba(255,255,255,0.05);
            transition: background 0.15s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(255,255,255,0.05); }

        tbody td { padding: 13px 16px; color: rgba(255,255,255,0.85); }

        .td-id    { color: rgba(255,255,255,0.3); font-size: 12px; width: 40px; }
        .td-data  { color: rgba(255,255,255,0.35); font-size: 12px; }

        /* Célula de nome com bandeira */
        .td-selecao {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .flag-img {
            width: 36px;
            height: 24px;
            object-fit: cover;
            border-radius: 3px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.5);
            flex-shrink: 0;
            display: block;
        }

        .selecao-nome {
            font-weight: 600;
            color: #fff;
        }

        .badge-grupo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 6px;
            background: rgba(201,168,76,0.15);
            border: 1px solid rgba(201,168,76,0.3);
            color: #c9a84c;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-titulo {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 20px;
            background: rgba(255,255,255,0.07);
            color: rgba(255,255,255,0.7);
            font-size: 13px;
        }
        .badge-titulo .star { color: #c9a84c; font-size: 12px; }

        .acoes { display: flex; gap: 8px; }

        .btn-editar, .btn-deletar {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.15s;
            border: 1px solid;
        }

        .btn-editar  { background: rgba(55,138,221,0.1); border-color: rgba(55,138,221,0.3); color: #7ab8f0; }
        .btn-editar:hover  { background: rgba(55,138,221,0.2); }
        .btn-deletar { background: rgba(220,53,69,0.1);  border-color: rgba(220,53,69,0.3);  color: #f48a96; }
        .btn-deletar:hover { background: rgba(220,53,69,0.2); }

        .empty-row td { text-align: center; padding: 3rem; color: rgba(255,255,255,0.25); }

        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="bg-trophy"></div>
    <div class="bg-overlay"></div>

    <?php
    // Mapa de bandeiras: nome da seleção => código ISO 2 letras (flagcdn.com)
    $bandeiras = [
        'Brasil'          => 'br',
        'Sérvia'          => 'rs',
        'Suíça'           => 'ch',
        'Camarões'        => 'cm',
        'Inglaterra'      => 'gb-eng',
        'Irã'             => 'ir',
        'Estados Unidos'  => 'us',
        'País de Gales'   => 'gb-wls',
        'Argentina'       => 'ar',
        'Arábia Saudita'  => 'sa',
        'México'          => 'mx',
        'Polônia'         => 'pl',
        'França'          => 'fr',
        'Austrália'       => 'au',
        'Dinamarca'       => 'dk',
        'Tunísia'         => 'tn',
        'Espanha'         => 'es',
        'Costa Rica'      => 'cr',
        'Alemanha'        => 'de',
        'Japão'           => 'jp',
        'Bélgica'         => 'be',
        'Canadá'          => 'ca',
        'Marrocos'        => 'ma',
        'Croácia'         => 'hr',
        'Portugal'        => 'pt',
        'Gana'            => 'gh',
        'Uruguai'         => 'uy',
        'Coreia do Sul'   => 'kr',
        'Holanda'         => 'nl',
        'Senegal'         => 'sn',
        'Equador'         => 'ec',
        'Catar'           => 'qa',
    ];
    ?>

    <div class="content">

        <div class="header">
            <p class="header-label">Sistema de Gerenciamento</p>
            <h1>Copa do <span>Mundo</span></h1>
            <div class="header-divider"></div>
        </div>

        <?php if (!empty($_GET['status'])): ?>
            <div class="flash <?= $_GET['status'] === 'sucesso' ? 'sucesso' : 'erro' ?>">
                <?= htmlspecialchars($_GET['msg'] ?? ($_GET['status'] === 'sucesso' ? 'Operação realizada com sucesso!' : 'Ocorreu um erro.')) ?>
            </div>
        <?php endif; ?>

        <div class="top-bar">
            <h2>Seleções Cadastradas</h2>
            <a href="index.php?action=novo" class="btn-novo">+ Nova Seleção</a>
        </div>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Seleção</th>
                        <th>Grupo</th>
                        <th>Títulos</th>
                        <th>Cadastrado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($selecoes)): ?>
                        <?php foreach ($selecoes as $s): ?>
                        <?php
                            $nomeSel = htmlspecialchars($s['nome'], ENT_QUOTES, 'UTF-8');
                            $isoCode = $bandeiras[$s['nome']] ?? 'un';
                            $flagUrl = "https://flagcdn.com/w40/{$isoCode}.png";
                        ?>
                        <tr>
                            <td class="td-id"><?= (int)$s['id'] ?></td>
                            <td>
                                <div class="td-selecao">
                                    <img class="flag-img" src="<?= $flagUrl ?>" alt="Bandeira <?= $nomeSel ?>" loading="lazy">
                                    <span class="selecao-nome"><?= $nomeSel ?></span>
                                </div>
                            </td>
                            <td><span class="badge-grupo"><?= htmlspecialchars($s['grupo'], ENT_QUOTES, 'UTF-8') ?></span></td>
                            <td>
                                <span class="badge-titulo">
                                    <?php for ($i = 0; $i < min((int)$s['titulos'], 5); $i++): ?>
                                        <span class="star">★</span>
                                    <?php endfor; ?>
                                    <?= (int)$s['titulos'] ?>
                                </span>
                            </td>
                            <td class="td-data"><?= htmlspecialchars($s['criado_em'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <div class="acoes">
                                    <a href="index.php?action=editar&id=<?= (int)$s['id'] ?>" class="btn-editar">✎ Editar</a>
                                    <a href="index.php?action=deletar&id=<?= (int)$s['id'] ?>"
                                       onclick="return confirm('Excluir <?= $nomeSel ?>?')"
                                       class="btn-deletar">✕ Excluir</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr class="empty-row">
                            <td colspan="6">Nenhuma seleção cadastrada ainda.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>