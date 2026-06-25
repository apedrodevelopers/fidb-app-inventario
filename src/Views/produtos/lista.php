<?php

$caminhoCss = "../../css/style.css";

include "../src/Views/layouts/header.php";
?>

<div class="topbar">
  <div>
    <h1>Produtos</h1>
    <p>Gerir produtos do inventário.</p>
  </div>
  <a href="../login.html" class="logout-btn">Sair</a>
</div>

<div class="content">

  <!-- Flash: visível quando $_SESSION['sucesso'] ou $_SESSION['erro'] estiverem definidos -->
  <!-- <div class="flash flash-success">✓ Produto criado com sucesso.</div> -->
  <!-- <div class="flash flash-error">✗ Erro ao apagar o produto.</div> -->

  <!-- Filtros: action="/produtos" method="GET" → ProdutoController@index -->
  <form action="/admin/produtos/lista" method="GET" class="toolbar">
    <div class="search-wrap">
      <input class="search-input" type="text" name="pesquisa" placeholder="Pesquisar por nome…" value="" />
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
    <!-- href="/produtos/novo" → ProdutoController@create -->
    <a href="/admin/produtos/novo" class="btn-primary">
      <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
        <path d="M6.5 1v11M1 6.5h11" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
      </svg>
      Novo produto
    </a>
  </form>

  <div class="table-card">
    <div class="table-header">
      <h2>Lista de produtos</h2>
      <span></span>
    </div>
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Categoria</th>
          <th>Preço</th>
          <th>Stock</th>
          <th>Estado</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($produtos as $produto) {
        ?>

          <tr>
            <td> <?= $produto["nome"] ?> </td>
            <td class="muted"> <?= $produto["categoria"] ?> </td>
            <td class="muted"> <?= number_format($produto["preco"], 2, ",") ?> </td>
            <td>
              <span class="<?= $produto["quantidade"] <= $produto["quantidade_minima"] ? 'stock-num' : ''  ?>">
                <?= $produto["quantidade"] ?>
              </span>
            </td>
            <td>
              <span class="badge <?= $produto["quantidade"] <= $produto["quantidade_minima"] ? 'badge-alerta' : 'badge-ok'  ?> ">
                <?= $produto["quantidade"] <= $produto["quantidade_minima"] ? 'Alerta' : 'OK'  ?>
              </span>
            </td>
            <td>
              <div class="actions">
                <!-- href="/produtos/1/editar" → ProdutoController@edit -->
                <a href="/admin/produtos/<?= $produto["id"] ?>/editar" class="btn-icon" title="Editar">
                  <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                    <path d="M9 2l2 2-7 7H2V9l7-7z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round" />
                  </svg>
                </a>
                <!-- href="/produtos/1/apagar" → ProdutoController@deleteConfirm -->
                <a href="/admin/produtos/<?= $produto["id"] ?>/confirmar-apagar" class="btn-icon danger" title="Apagar">
                  <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                    <path d="M2 3.5h9M5 3.5V2h3v1.5M5.5 6v4M7.5 6v4M3 3.5l.75 7.5h5.5L10 3.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </a>
              </div>
            </td>
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