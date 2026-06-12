<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Título muda via PHP: "Novo produto" ou "Editar produto" -->
  <title>Produto — Inventário</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../style.css" />
</head>
<body class="page-app">

  <!-- ── Sidebar ── -->
  <aside class="sidebar">
    <div class="sidebar-logo"></div>
    <p class="nav-label">Menu</p>
    <ul class="nav">
      <li><a href="../dashboard.html">
        <svg width="15" height="15" viewBox="0 0 15 15" fill="none"><rect x="1" y="1" width="5.5" height="5.5" rx="1.5" fill="currentColor"/><rect x="8.5" y="1" width="5.5" height="5.5" rx="1.5" fill="currentColor"/><rect x="1" y="8.5" width="5.5" height="5.5" rx="1.5" fill="currentColor"/><rect x="8.5" y="8.5" width="5.5" height="5.5" rx="1.5" fill="currentColor"/></svg>
        Dashboard
      </a></li>
      <li><a href="lista.html" class="active">
        <svg width="15" height="15" viewBox="0 0 15 15" fill="none"><rect x="1.5" y="1.5" width="12" height="12" rx="2" stroke="currentColor" stroke-width="1.4"/><path d="M5 7.5h5M7.5 5v5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
        Produtos
      </a></li>
      <li><a href="../categorias/lista.html">
        <svg width="15" height="15" viewBox="0 0 15 15" fill="none"><path d="M2 4h11M2 7.5h7M2 11h5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
        Categorias
      </a></li>
      <li><a href="../movimentos/lista.html">
        <svg width="15" height="15" viewBox="0 0 15 15" fill="none"><path d="M7.5 1v13M3 5l4.5-4.5L12 5M3 10l4.5 4.5L12 10" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Movimentos
      </a></li>
      <li><a href="../utilizadores/lista.html">
        <svg width="15" height="15" viewBox="0 0 15 15" fill="none"><circle cx="7.5" cy="5" r="3" stroke="currentColor" stroke-width="1.4"/><path d="M2 13c0-3 2.5-5 5.5-5s5.5 2 5.5 5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
        Utilizadores
      </a></li>
    </ul>
    <div class="sidebar-footer">
      <div class="user-info">
        <div class="avatar">AD</div>
        <div>
          <p class="user-name">Admin</p>
          <p class="user-role">Administrador</p>
        </div>
      </div>
    </div>
  </aside>

  <!-- ── Main ── -->
  <div class="main">
    <div class="topbar">
      <div>
        <!-- Título via PHP: "Novo produto" ou "Editar: Monitor 24"" -->
        <h1>Novo produto</h1>
        <p>Preencha os dados do produto.</p>
      </div>
      <a href="../login.html" class="logout-btn">Sair</a>
    </div>

    <div class="content">

      <!-- Flash de erro de validação -->
      <!-- <div class="flash flash-error">✗ Corrija os erros assinalados.</div> -->

      <!--
        Criação : action="/produtos"          method="POST"
        Edição  : action="/produtos/1"        method="POST"
        No PHP o Controller distingue pela presença do $id
      -->
      <form action="#" method="POST" class="form-page">

        <div class="form-card">
          <h2 class="form-section-title">Informações gerais</h2>

          <div class="form-group">
            <label class="form-label">Nome *</label>
            <!-- value="<?= htmlspecialchars($produto['nome'] ?? '') ?>" -->
            <input class="form-input" type="text" name="nome" placeholder="Ex: Teclado mecânico" value="" />
            <!-- <p class="form-error">O nome é obrigatório.</p> -->
          </div>

          <div class="form-group">
            <label class="form-label">Descrição</label>
            <textarea class="form-textarea" name="descricao" placeholder="Descrição opcional do produto…"></textarea>
            <!-- valor: <?= htmlspecialchars($produto['descricao'] ?? '') ?> -->
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Preço (Kz) *</label>
              <input class="form-input" type="number" name="preco" step="0.01" min="0" placeholder="0.00" value="" />
              <!-- value="<?= $produto['preco'] ?? '' ?>" -->
            </div>
            <div class="form-group">
              <label class="form-label">Categoria *</label>
              <select class="form-select" name="categoria_id">
                <option value="">Seleccionar…</option>
                <!-- foreach ($categorias as $c) -->
                <!-- selected quando $c['id'] == $produto['categoria_id'] -->
                <option value="1">Periféricos</option>
                <option value="2">Cabos</option>
                <option value="3">Armazenamento</option>
                <option value="4">Monitores</option>
                <option value="5">Redes</option>
                <option value="6">Energia</option>
                <!-- endforeach -->
              </select>
            </div>
          </div>
        </div>

        <div class="form-card">
          <h2 class="form-section-title">Stock</h2>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Quantidade inicial</label>
              <input class="form-input" type="number" name="quantidade" min="0" placeholder="0" value="" />
              <p class="form-hint">Apenas para criação. Use Movimentos para ajustar o stock.</p>
            </div>
            <div class="form-group">
              <label class="form-label">Quantidade mínima</label>
              <input class="form-input" type="number" name="quantidade_minima" min="0" placeholder="5" value="" />
              <p class="form-hint">Abaixo deste valor o sistema emite alerta.</p>
            </div>
          </div>
        </div>

        <div class="form-actions-page">
          <a href="lista.html" class="btn-secondary">Cancelar</a>
          <button type="submit" class="btn-primary">
            <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M2 7l3.5 3.5L11 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Guardar produto
          </button>
        </div>

      </form>
    </div>
  </div>

</body>
</html>
