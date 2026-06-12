<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Apagar produto — Inventário</title>
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
        <h1>Apagar produto</h1>
        <p>Confirme a remoção do produto.</p>
      </div>
      <a href="../login.html" class="logout-btn">Sair</a>
    </div>

    <div class="content">
      <div class="confirm-page">

        <div class="confirm-icon-lg">
          <svg width="28" height="28" viewBox="0 0 28 28" fill="none">
            <path d="M4 7h20M10 7V4.5h8V7M12.5 12v8M15.5 12v8M5.5 7l1.5 16a1.5 1.5 0 001.5 1.5h11a1.5 1.5 0 001.5-1.5L22.5 7" stroke="#A03030" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>

        <h2 class="confirm-page-title">Tens a certeza?</h2>

        <!-- Nome do produto vem do Controller: $produto['nome'] -->
        <p class="confirm-page-desc">
          Estás prestes a apagar o produto <strong>Monitor 24"</strong>.
          Esta acção é permanente e não pode ser desfeita.
          O histórico de movimentos associado será mantido.
        </p>

        <!-- action="/produtos/1/apagar" method="POST" → ProdutoController@delete -->
        <form action="#" method="POST" class="confirm-page-actions">
          <a href="lista.html" class="btn-secondary">Cancelar</a>
          <button type="submit" class="btn-danger">Apagar definitivamente</button>
        </form>

      </div>
    </div>
  </div>

</body>
</html>
