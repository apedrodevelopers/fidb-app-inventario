<?php
$caminhoCss = "../../../css/style.css";
$painel = "produtos";

include "../src/Views/layouts/header.php";
?>


<div class="topbar">
  <div>
    <h1>Apagar produto </h1>
    <p>Confirme a remoção do produto.</p>
  </div>
  <a href="/logout" class="logout-btn">Sair</a>
</div>

<div class="content">
  <div class="confirm-page">

    <div class="confirm-icon-lg">
      <svg width="28" height="28" viewBox="0 0 28 28" fill="none">
        <path d="M4 7h20M10 7V4.5h8V7M12.5 12v8M15.5 12v8M5.5 7l1.5 16a1.5 1.5 0 001.5 1.5h11a1.5 1.5 0 001.5-1.5L22.5 7" stroke="#A03030" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </div>

    <h2 class="confirm-page-title">Tens a certeza?</h2>

    <!-- Nome do produto vem do Controller: $produto['nome'] -->
    <p class="confirm-page-desc">
      Estás prestes a apagar o produto <strong> <?= $produto['nome'] ?> </strong>.
      Esta acção é permanente e não pode ser desfeita.
      O histórico de movimentos associado será mantido.
    </p>

    <!-- action="/produtos/1/apagar" method="POST" → ProdutoController@delete -->
    <form action="/admin/produtos/<?= $produto['id'] ?>/apagar" method="get" class="confirm-page-actions">
      <a href="/admin/produtos/lista" class="btn-secondary">Cancelar</a>
      <button type="submit" class="btn-danger">Apagar definitivamente</button>
    </form>

  </div>
</div>

<?php
include "../src/Views/layouts/footer.php";
?>