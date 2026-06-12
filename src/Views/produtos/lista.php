<?php

use App\Models\ProdutoModel;

$produtos = ProdutoModel::getProdutos();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Produtos — Inventário</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../../css/style.css" />
</head>

<body class="page-app">

  <!-- ── Sidebar ── -->
  <aside class="sidebar">
    <div class="sidebar-logo"></div>
    <p class="nav-label">Menu</p>
    <ul class="nav">
      <li><a href="/admin/dashboard">
          <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
            <rect x="1" y="1" width="5.5" height="5.5" rx="1.5" fill="currentColor" />
            <rect x="8.5" y="1" width="5.5" height="5.5" rx="1.5" fill="currentColor" />
            <rect x="1" y="8.5" width="5.5" height="5.5" rx="1.5" fill="currentColor" />
            <rect x="8.5" y="8.5" width="5.5" height="5.5" rx="1.5" fill="currentColor" />
          </svg>
          Dashboard
        </a></li>
      <li><a href="/admin/produtos/lista" class="active">
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
            <option value="">Todas as categorias</option>
            <!-- foreach ($categorias as $c) -->
            <option value="1">Periféricos</option>
            <option value="2">Cabos</option>
            <option value="3">Armazenamento</option>
            <option value="4">Monitores</option>
            <option value="5">Redes</option>
            <option value="6">Energia</option>
            <!-- endforeach -->
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
                    <a href="/admin/produtos/<?= $produto["id"] ?>/apagar" class="btn-icon danger" title="Apagar">
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
  </div>

</body>

</html>