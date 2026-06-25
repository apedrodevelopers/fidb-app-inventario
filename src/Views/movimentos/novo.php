<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registar movimento — Inventário</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../style.css" />
</head>
<body class="page-app">

  <aside class="sidebar">
    <div class="sidebar-logo"></div>
    <p class="nav-label">Menu</p>
    <ul class="nav">
      <li><a href="../dashboard.html"><svg width="15" height="15" viewBox="0 0 15 15" fill="none"><rect x="1" y="1" width="5.5" height="5.5" rx="1.5" fill="currentColor"/><rect x="8.5" y="1" width="5.5" height="5.5" rx="1.5" fill="currentColor"/><rect x="1" y="8.5" width="5.5" height="5.5" rx="1.5" fill="currentColor"/><rect x="8.5" y="8.5" width="5.5" height="5.5" rx="1.5" fill="currentColor"/></svg>Dashboard</a></li>
      <li><a href="../produtos/lista.html"><svg width="15" height="15" viewBox="0 0 15 15" fill="none"><rect x="1.5" y="1.5" width="12" height="12" rx="2" stroke="currentColor" stroke-width="1.4"/><path d="M5 7.5h5M7.5 5v5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>Produtos</a></li>
      <li><a href="../categorias/lista.html"><svg width="15" height="15" viewBox="0 0 15 15" fill="none"><path d="M2 4h11M2 7.5h7M2 11h5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>Categorias</a></li>
      <li><a href="lista.html" class="active"><svg width="15" height="15" viewBox="0 0 15 15" fill="none"><path d="M7.5 1v13M3 5l4.5-4.5L12 5M3 10l4.5 4.5L12 10" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>Movimentos</a></li>
      <li><a href="../utilizadores/lista.html"><svg width="15" height="15" viewBox="0 0 15 15" fill="none"><circle cx="7.5" cy="5" r="3" stroke="currentColor" stroke-width="1.4"/><path d="M2 13c0-3 2.5-5 5.5-5s5.5 2 5.5 5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>Utilizadores</a></li>
    </ul>
    <div class="sidebar-footer"><div class="user-info"><div class="avatar">AD</div><div><p class="user-name">Admin</p><p class="user-role">Administrador</p></div></div></div>
  </aside>

  <div class="main">
    <div class="topbar">
      <div><h1>Registar movimento</h1><p>Entrada ou saída de stock.</p></div>
      <a href="../login.html" class="logout-btn">Sair</a>
    </div>
    <div class="content">

      <!-- action="/movimentos" method="POST" → MovimentoController@store -->
      <form action="#" method="POST" class="form-page">
        <div class="form-card">
          <h2 class="form-section-title">Dados do movimento</h2>

          <div class="form-group">
            <label class="form-label">Produto *</label>
            <select class="form-select" name="produto_id">
              <option value="">Seleccionar produto…</option>
              <!-- foreach ($produtos as $p) -->
              <option value="1">Monitor 24"</option>
              <option value="2">Cabo HDMI 2m</option>
              <option value="3">Teclado USB</option>
              <option value="4">Pen Drive 32GB</option>
              <option value="5">Rato sem fio</option>
              <!-- endforeach -->
            </select>
            <!-- <p class="form-error">Seleccione um produto.</p> -->
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Tipo *</label>
              <select class="form-select" name="tipo">
                <option value="entrada">Entrada</option>
                <option value="saida">Saída</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Quantidade *</label>
              <input class="form-input" type="number" name="quantidade" min="1" placeholder="0" value="" />
              <p class="form-hint">O stock do produto será actualizado automaticamente.</p>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Observação</label>
            <input class="form-input" type="text" name="observacao" placeholder="Ex: Compra de fornecedor, venda balcão, encomenda nº…" value="" />
          </div>
        </div>

        <div class="form-actions-page">
          <a href="lista.html" class="btn-secondary">Cancelar</a>
          <button type="submit" class="btn-primary">
            <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M2 7l3.5 3.5L11 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Registar
          </button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
