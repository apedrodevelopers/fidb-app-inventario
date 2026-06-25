<?php
$caminhoCss = "../../css/style.css";

include "../src/Views/layouts/header.php";
?>

<div class="topbar">
  <div>
    <h1>Registar movimento</h1>
    <p>Entrada ou saída de stock.</p>
  </div>
  <a href="/logout" class="logout-btn">Sair</a>
</div>
<div class="content">

  <!-- action="/movimentos" method="POST" → MovimentoController@store -->
  <form action="/admin/movimentos" method="POST" class="form-page">
    <div class="form-card">
      <h2 class="form-section-title">Dados do movimento</h2>

      <div class="form-group">
        <label class="form-label">Produto *</label>
        <select class="form-select" name="produto_id">
          <!-- <option value="0">Seleccionar produto…</option> -->
          <?php
          foreach ($produtos as $p) {
          ?>
            <option value="<?= $p['id'] ?>"> <?= $p['nome'] ?> </option>
          <?php
          }
          ?>

        </select>
        <!-- <p class="form-error">Seleccione um produto.</p> -->
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Tipo *</label>
          <select class="form-select" name="tipo">
            <option value="entrada">Entrada</option>
            <option value="saida">Saída</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Quantidade *</label>
          <input class="form-input" type="number" name="quantidade" min="1" placeholder="0" value="" />
          <p class="form-hint">O stock do produto será actualizado automaticamente.</p>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Observação</label>
        <input class="form-input" type="text" name="observacao" placeholder="Ex: Compra de fornecedor, venda balcão, encomenda nº…" value="" />
      </div>
    </div>

    <div class="form-actions-page">
      <a href="/admin/movimentos/lista" class="btn-secondary">Cancelar</a>
      <button type="submit" class="btn-primary">
        <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
          <path d="M2 7l3.5 3.5L11 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        Registar
      </button>
    </div>
  </form>
</div>

<?php
include "../src/Views/layouts/footer.php";
?>