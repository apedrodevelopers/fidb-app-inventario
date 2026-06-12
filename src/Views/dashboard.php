<?php

use App\Controllers\AuthController;

AuthController::verificarAutenticacao();

?>


<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard — Inventário</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css" />
</head>

<body class="page-app">

  <!-- ── Sidebar ── -->
  <aside class="sidebar">
    <div class="sidebar-logo"></div>
    <p class="nav-label">Menu</p>
    <ul class="nav">
      <li><a href="dashboard.html" class="active">
          <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
            <rect x="1" y="1" width="5.5" height="5.5" rx="1.5" fill="currentColor" />
            <rect x="8.5" y="1" width="5.5" height="5.5" rx="1.5" fill="currentColor" />
            <rect x="1" y="8.5" width="5.5" height="5.5" rx="1.5" fill="currentColor" />
            <rect x="8.5" y="8.5" width="5.5" height="5.5" rx="1.5" fill="currentColor" />
          </svg>
          Dashboard
        </a></li>
      <li><a href="produtos/lista.html">
          <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
            <rect x="1.5" y="1.5" width="12" height="12" rx="2" stroke="currentColor" stroke-width="1.4" />
            <path d="M5 7.5h5M7.5 5v5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
          </svg>
          Produtos
        </a></li>
      <li><a href="categorias/lista.html">
          <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
            <path d="M2 4h11M2 7.5h7M2 11h5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
          </svg>
          Categorias
        </a></li>
      <li><a href="movimentos/lista.html">
          <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
            <path d="M7.5 1v13M3 5l4.5-4.5L12 5M3 10l4.5 4.5L12 10" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          Movimentos
        </a></li>
      <li><a href="utilizadores/lista.html">
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
    <div class="topbar">
      <div>
        <h1>Dashboard</h1>
        <p>Visão geral do inventário.</p>
      </div>
      <!-- href="/logout" → AuthController@logout -->
      <a href="/logout" class="logout-btn">Sair</a>
    </div>

    <div class="content">

      <!-- Métricas — valores virão de DashboardController -->
      <div class="metrics">
        <div class="metric-card">
          <p class="metric-label">Total de produtos</p>
          <p class="metric-value"> <?= $dados["total_produtos_cadastrados"] ?> </p>
          <p class="metric-sub">Registados no sistema</p>
        </div>
        <div class="metric-card">
          <p class="metric-label">Categorias</p>
          <p class="metric-value"> <?= $dados["total_categorias_cadastradas"] ?> </p>
          <p class="metric-sub">Categorias activas</p>
        </div>
        <div class="metric-card alert">
          <p class="metric-label">Stock baixo</p>
          <p class="metric-value"> <?= $dados["total_produtos_abaixo_estoque_minimo"] ?> </p>
          <p class="metric-sub">Produtos abaixo do mínimo</p>
        </div>
        <div class="metric-card">
          <p class="metric-label">Movimentos (mês)</p>
          <p class="metric-value"> <?= $dados["total_movimentos_do_mes"] ?> </p>
          <p class="metric-sub">Entradas e saídas</p>
        </div>
      </div>

      <div class="dashboard-grid">

        <!-- Produtos com stock baixo -->
        <div class="table-card">
          <div class="table-header">
            <h2>⚠ Stock baixo</h2>
            <a href="/admin/produtos" class="table-link">Ver todos</a>
          </div>
          <table>
            <thead>
              <tr>
                <th>Produto</th>
                <th>Qtd.</th>
                <th>Mínimo</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $itens = $dados["lista_produtos_abaixo_estoque_minimo"];
              foreach ($itens as $item) {
              ?>
                <tr>
                  <td> <?= $item["nome"] ?> </td>
                  <td><span class="stock-num low"> <?= $item["quantidade"] ?> </span></td>
                  <td class="muted"> <?= $item["quantidade_minima"] ?> </td>
                </tr>

              <?php
              }
              ?>



            </tbody>
          </table>
        </div>

        <!-- Últimos movimentos -->
        <div class="table-card">
          <div class="table-header">
            <h2>Últimos movimentos</h2>
            <a href="/admin/movimentos" class="table-link">Ver todos</a>
          </div>
          <table>
            <thead>
              <tr>
                <th>Produto</th>
                <th>Tipo</th>
                <th>Qtd.</th>
                <th>Data</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $itens = $dados["lista_dos_ultimos_movimentos"];

              foreach ($itens as $item) {
              ?>
                <tr>
                  <td> <?= $item["nome"] ?> </td>
                  <td>
                    <span class="badge <?= $item["tipo"] === 'entrada' ? 'badge-entrada' : 'badge-saida' ?>">
                      <?= $item["tipo"] ?>
                    </span>
                  </td>
                  <td class="muted"> <?= $item["quantidade"] ?> </td>
                  <td class="muted"> <?= $item["data"] ?> </td>
                </tr>
              <?php
              }
              ?>

            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

</body>

</html>