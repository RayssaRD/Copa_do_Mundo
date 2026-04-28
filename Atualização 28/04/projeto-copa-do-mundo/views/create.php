<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Seleção</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Barlow', sans-serif; background: #0a1a0e; min-height: 100vh; position: relative; }
        .bg-trophy { position: fixed; inset: 0; background-image: url('../assets/trofeu.jpg'); background-size: cover; background-position: center 30%; filter: blur(6px) brightness(0.35); transform: scale(1.05); z-index: 0; }
        .bg-overlay { position: fixed; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(5,20,8,0.95)); z-index: 1; }
        .content { position: relative; z-index: 2; padding: 2rem 1.5rem 3rem; max-width: 560px; margin: 0 auto; }
        .header { text-align: center; padding: 2.5rem 0 2rem; }
        .header-label { font-size: 11px; font-weight: 600; letter-spacing: 4px; text-transform: uppercase; color: #c9a84c; margin-bottom: 0.5rem; }
        .header h1 { font-family: 'Bebas Neue', sans-serif; font-size: 3rem; color: #fff; letter-spacing: 3px; }
        .header h1 span { color: #c9a84c; }
        .header-divider { width: 60px; height: 2px; background: #c9a84c; margin: 1rem auto 0; border-radius: 2px; }
        .form-card { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 14px; padding: 2rem; }
        .form-group { margin-bottom: 1.25rem; }
        label { display: block; font-size: 11px; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; color: rgba(255,255,255,0.45); margin-bottom: 8px; }
        .input-wrap { position: relative; }
        input[type="text"], input[type="number"] { width: 100%; padding: 11px 14px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 8px; color: #fff; font-family: 'Barlow', sans-serif; font-size: 15px; outline: none; transition: border-color 0.2s; }
        input:focus { border-color: rgba(201,168,76,0.5); background: rgba(255,255,255,0.09); }
        input.preenchido { border-color: rgba(40,167,69,0.5); background: rgba(40,167,69,0.07); color: #6fcf97; }
        .input-spinner { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; border: 2px solid rgba(201,168,76,0.3); border-top-color: #c9a84c; border-radius: 50%; animation: spin 0.7s linear infinite; display: none; }
        .hint { font-size: 12px; color: rgba(255,255,255,0.3); margin-top: 6px; }
        .hint.ok { color: #6fcf97; } .hint.erro { color: #f48a96; }
        .autocomplete-list { position: absolute; top: calc(100% + 4px); left: 0; right: 0; background: #132b18; border: 1px solid rgba(201,168,76,0.25); border-radius: 8px; overflow: hidden; z-index: 10; display: none; }
        .autocomplete-list li { list-style: none; padding: 10px 14px; cursor: pointer; color: rgba(255,255,255,0.8); font-size: 14px; display: flex; justify-content: space-between; align-items: center; transition: background 0.15s; }
        .autocomplete-list li:hover { background: rgba(201,168,76,0.12); }
        .ac-grupo { font-size: 11px; font-weight: 700; color: #c9a84c; background: rgba(201,168,76,0.12); border: 1px solid rgba(201,168,76,0.25); padding: 2px 8px; border-radius: 4px; }
        .form-actions { display: flex; gap: 10px; margin-top: 1.75rem; }
        .btn-salvar { flex: 1; padding: 12px; background: #c9a84c; color: #0a1a0e; font-family: 'Barlow', sans-serif; font-size: 14px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; border: none; border-radius: 8px; cursor: pointer; transition: background 0.2s; }
        .btn-salvar:hover { background: #e0bc62; }
        .btn-voltar { padding: 12px 20px; background: transparent; color: rgba(255,255,255,0.5); font-family: 'Barlow', sans-serif; font-size: 14px; font-weight: 600; border: 1px solid rgba(255,255,255,0.12); border-radius: 8px; text-decoration: none; display: flex; align-items: center; transition: all 0.2s; }
        .btn-voltar:hover { border-color: rgba(255,255,255,0.3); color: #fff; }
        @keyframes spin { to { transform: translateY(-50%) rotate(360deg); } }
    </style>
</head>
<body>
    <div class="bg-trophy"></div>
    <div class="bg-overlay"></div>
    <div class="content">
        <div class="header">
            <p class="header-label">Gerenciamento</p>
            <h1>Nova <span>Seleção</span></h1>
            <div class="header-divider"></div>
        </div>
        <div class="form-card">
            <form method="POST" action="index.php">
                <div class="form-group">
                    <label for="nome">Nome da Seleção</label>
                    <div class="input-wrap">
                        <input type="text" id="nome" name="nome" placeholder="Ex: Brasil, Alemanha..." autocomplete="off" required>
                        <div class="input-spinner" id="spinner"></div>
                        <ul class="autocomplete-list" id="autocomplete"></ul>
                    </div>
                    <p class="hint" id="hint-nome">Digite o nome para buscar automaticamente</p>
                </div>
                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <div class="input-wrap">
                        <input type="text" id="grupo" name="grupo" placeholder="Ex: A, B, C..." maxlength="1" required>
                    </div>
                    <p class="hint" id="hint-grupo"></p>
                </div>
                <div class="form-group">
                    <label for="titulos">Títulos Mundiais</label>
                    <div class="input-wrap">
                        <input type="number" id="titulos" name="titulos" min="0" value="0" required>
                    </div>
                    <p class="hint" id="hint-titulos"></p>
                </div>
                <div class="form-actions">
                    <a href="index.php" class="btn-voltar">← Voltar</a>
                    <button type="submit" class="btn-salvar">Salvar Seleção</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        let debounceTimer = null;
        let todasSelecoes = [];

        fetch('api.php?action=listar')
            .then(r => r.json())
            .then(res => { if (res.status === 'ok') todasSelecoes = res.data; });

        const inputNome    = document.getElementById('nome');
        const inputGrupo   = document.getElementById('grupo');
        const inputTitulos = document.getElementById('titulos');
        const spinner      = document.getElementById('spinner');
        const autocomplete = document.getElementById('autocomplete');
        const hintNome     = document.getElementById('hint-nome');
        const hintGrupo    = document.getElementById('hint-grupo');
        const hintTitulos  = document.getElementById('hint-titulos');

        inputNome.addEventListener('input', function () {
            const val = this.value.trim();
            clearTimeout(debounceTimer);
            autocomplete.style.display = 'none';
            if (val.length < 2) { hintNome.textContent = 'Digite o nome para buscar automaticamente'; hintNome.className = 'hint'; return; }
            debounceTimer = setTimeout(() => {
                spinner.style.display = 'block';
                const filtradas = todasSelecoes.filter(s => s.nome.toLowerCase().includes(val.toLowerCase()));
                spinner.style.display = 'none';
                if (filtradas.length > 0) {
                    autocomplete.innerHTML = '';
                    filtradas.slice(0, 6).forEach(s => {
                        const li = document.createElement('li');
                        li.innerHTML = `<span>${s.nome}</span><span class="ac-grupo">Grupo ${s.grupo} · ${s.titulos} títulos</span>`;
                        li.addEventListener('click', () => preencherCampos(s));
                        autocomplete.appendChild(li);
                    });
                    autocomplete.style.display = 'block';
                    hintNome.textContent = filtradas.length + ' seleção(ões) encontrada(s)';
                    hintNome.className = 'hint ok';
                } else {
                    hintNome.textContent = 'Não encontrada na API — preencha manualmente';
                    hintNome.className = 'hint erro';
                }
            }, 300);
        });

        function preencherCampos(s) {
            inputNome.value = s.nome; inputGrupo.value = s.grupo; inputTitulos.value = s.titulos;
            [inputNome, inputGrupo, inputTitulos].forEach(i => i.classList.add('preenchido'));
            hintNome.textContent = '✓ Encontrada na API'; hintNome.className = 'hint ok';
            hintGrupo.textContent = '✓ Preenchido automaticamente'; hintGrupo.className = 'hint ok';
            hintTitulos.textContent = '✓ Preenchido automaticamente'; hintTitulos.className = 'hint ok';
            autocomplete.style.display = 'none';
        }

        document.addEventListener('click', e => { if (!inputNome.contains(e.target)) autocomplete.style.display = 'none'; });
    </script>
</body>
</html>