<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard — Inventário</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <!-- <link rel="stylesheet" href="../css/style.css" /> -->
  <link rel="stylesheet" href="<?= $caminhoCss ?>" />
</head>

<body class="page-app">

  <!-- ── Sidebar ── -->
  <aside class="sidebar">
    <div class="sidebar-logo"></div>
    <p class="nav-label">Menu</p>
    <ul class="nav">
      <li><a href="/admin/dashboard" class="active">
          <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
            <rect x="1" y="1" width="5.5" height="5.5" rx="1.5" fill="currentColor" />
            <rect x="8.5" y="1" width="5.5" height="5.5" rx="1.5" fill="currentColor" />
            <rect x="1" y="8.5" width="5.5" height="5.5" rx="1.5" fill="currentColor" />
            <rect x="8.5" y="8.5" width="5.5" height="5.5" rx="1.5" fill="currentColor" />
          </svg>
          Dashboard
        </a></li>
      <li><a href="/admin/produtos/lista">
          <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
            <rect x="1.5" y="1.5" width="12" height="12" rx="2" stroke="currentColor" stroke-width="1.4" />
            <path d="M5 7.5h5M7.5 5v5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
          </svg>
          Produtos
        </a></li>
      <li><a href="/admin/categorias/lista">
          <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
            <path d="M2 4h11M2 7.5h7M2 11h5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
          </svg>
          Categorias
        </a></li>
      <li><a href="/admin/movimentos/lista">
          <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
            <path d="M7.5 1v13M3 5l4.5-4.5L12 5M3 10l4.5 4.5L12 10" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          Movimentos
        </a></li>
      <li><a href="/admin/utilizadores/lista">
          <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
            <circle cx="7.5" cy="5" r="3" stroke="currentColor" stroke-width="1.4" />
            <path d="M2 13c0-3 2.5-5 5.5-5s5.5 2 5.5 5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
          </svg>
          Utilizadores
        </a></li>
    </ul>
    <div class="sidebar-footer">
      <div class="user-info">
        <div class="avatar">AD</div>
        <div>
          <!-- Nome e perfil virão de $_SESSION['utilizador'] -->
          <p class="user-name"> <?= $_SESSION["usuario-logado"]["nome"] ?> </p>
          <p class="user-role"><?= $_SESSION["usuario-logado"]["perfil"] ?></p>
        </div>
      </div>
    </div>
  </aside>

  <!-- ── Main ── -->
  <div class="main">