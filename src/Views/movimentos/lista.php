<?php

$caminhoCss = "../../css/style.css";

include "../src/Views/layouts/header.php";
?>

<div class="topbar">
  <div>
    <h1>Movimentos</h1>
    <p>Histórico de entradas e saídas de stock.</p>
  </div>
  <a href="/logout" class="logout-btn">Sair</a>
</div>
<div class="content">

  <!-- Filtros: action="/movimentos" method="GET" → MovimentoController@index -->
  <form action="/admin/movimentos/lista" method="GET" class="toolbar">
    <div class="search-wrap">
      <select class="filter-select" name="tipo">
        <option value="0">Todos os tipos</option>
        <option value="entrada">Entrada</option>
        <option value="saida">Saída</option>
      </select>
      <select class="filter-select" name="categoria_id">
        <option value="0">Todas as categorias</option>

        <?php
        foreach ($categorias as $c) {
        ?>
          <option value="<?= $c['id'] ?>"> <?= $c['nome'] ?> </option>
        <?php
        }
        ?>

      </select>
      <button class="btn-search" type="submit">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
          <circle cx="6" cy="6" r="4.5" stroke="currentColor" stroke-width="1.5" />
          <path d="M10 10l2.5 2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
        </svg>
        Pesquisar
      </button>
    </div>
    <!-- href="/movimentos/novo" → MovimentoController@create -->
    <a href="/admin/movimentos/create" class="btn-primary">
      <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
        <path d="M6.5 1v11M1 6.5h11" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
      </svg>
      Registar movimento
    </a>
  </form>

  <div class="table-card">
    <div class="table-header">
      <h2>Histórico de movimentos</h2><span></span>
    </div>
    <table>
      <thead>
        <tr>
          <th>Produto</th>
          <th>Categoria</th>
          <th>Tipo</th>
          <th>Quantidade</th>
          <th>Observação</th>
          <th>Registado por</th>
          <th>Data</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($movimentos as $m) {
        ?>

          <tr>
            <td> <?= $m["nome"] ?> </td>
            <td class="muted"> <?= $m["categoria"] ?> </td>
            <td>
              <span class="badge <?= $m["tipo"] === 'entrada' ? 'badge-entrada' : 'badge-saida' ?>">
                <?= $m["tipo"] ?>
              </span>
            </td>
            <td class="muted"> <?= $m["quantidade"] ?> </td>
            <td class="muted"> <?= $m["observacao"] ?> </td>
            <td class="muted"> <?= $m["utilizador"] ?> </td>
            <td class="muted"> <?= $m["data"] ?> </td>
          </tr>

        <?php
        }
        ?>

      </tbody>
    </table>
  </div>
</div>

<?php
include "../src/Views/layouts/footer.php";
?>