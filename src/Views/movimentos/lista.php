<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Movimentos — Inventário</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../../../css/style.css" />
</head>

<body class="page-app">

  <aside class="sidebar">
    <div class="sidebar-logo"></div>
    <p class="nav-label">Menu</p>
    <ul class="nav">
      <li><a href="../dashboard.html"><svg width="15" height="15" viewBox="0 0 15 15" fill="none">
            <rect x="1" y="1" width="5.5" height="5.5" rx="1.5" fill="currentColor" />
            <rect x="8.5" y="1" width="5.5" height="5.5" rx="1.5" fill="currentColor" />
            <rect x="1" y="8.5" width="5.5" height="5.5" rx="1.5" fill="currentColor" />
            <rect x="8.5" y="8.5" width="5.5" height="5.5" rx="1.5" fill="currentColor" />
          </svg>Dashboard</a></li>
      <li><a href="../produtos/lista.html"><svg width="15" height="15" viewBox="0 0 15 15" fill="none">
            <rect x="1.5" y="1.5" width="12" height="12" rx="2" stroke="currentColor" stroke-width="1.4" />
            <path d="M5 7.5h5M7.5 5v5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
          </svg>Produtos</a></li>
      <li><a href="../categorias/lista.html"><svg width="15" height="15" viewBox="0 0 15 15" fill="none">
            <path d="M2 4h11M2 7.5h7M2 11h5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
          </svg>Categorias</a></li>
      <li><a href="lista.html" class="active"><svg width="15" height="15" viewBox="0 0 15 15" fill="none">
            <path d="M7.5 1v13M3 5l4.5-4.5L12 5M3 10l4.5 4.5L12 10" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
          </svg>Movimentos</a></li>
      <li><a href="../utilizadores/lista.html"><svg width="15" height="15" viewBox="0 0 15 15" fill="none">
            <circle cx="7.5" cy="5" r="3" stroke="currentColor" stroke-width="1.4" />
            <path d="M2 13c0-3 2.5-5 5.5-5s5.5 2 5.5 5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
          </svg>Utilizadores</a></li>
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

  <div class="main">
    <div class="topbar">
      <div>
        <h1>Movimentos</h1>
        <p>Histórico de entradas e saídas de stock.</p>
      </div>
      <a href="../login.html" class="logout-btn">Sair</a>
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
        <a href="formulario.html" class="btn-primary">
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
  </div>

</body>

</html>