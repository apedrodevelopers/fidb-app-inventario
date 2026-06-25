<?php

$caminhoCss = "../css/style.css";
$painel = "dashboard";

include "../src/Views/layouts/header.php";
?>

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

<?php
include "../src/Views/layouts/footer.php";
?>