<?php
$caminhoCss = "../../css/style.css";

include "../src/Views/layouts/header.php";
?>

<div class="topbar">
  <div>
    <!-- Título via PHP: "Novo produto" ou "Editar: Monitor 24"" -->
    <h1>Novo produto</h1>
    <p>Preencha os dados do produto.</p>
  </div>
  <a href="/logout" class="logout-btn">Sair</a>
</div>

<div class="content">

  <!-- Flash de erro de validação -->
  <!-- <div class="flash flash-error">✗ Corrija os erros assinalados.</div> -->

  <!--
        Criação : action="/produtos"          method="POST"
        Edição  : action="/produtos/1"        method="POST"
        No PHP o Controller distingue pela presença do $id
      -->
  <form action="/admin/produtos" method="POST" class="form-page">

    <div class="form-card">
      <h2 class="form-section-title">Informações gerais</h2>

      <div class="form-group">
        <label class="form-label">Nome *</label>
        <!-- value="<?= htmlspecialchars($produto['nome'] ?? '') ?>" -->
        <input class="form-input" type="text" name="nome" placeholder="Ex: Teclado mecânico" value="" />
        <!-- <p class="form-error">O nome é obrigatório.</p> -->
      </div>

      <div class="form-group">
        <label class="form-label">Descrição</label>
        <textarea class="form-textarea" name="descricao" placeholder="Descrição opcional do produto…"></textarea>
        <!-- valor: <?= htmlspecialchars($produto['descricao'] ?? '') ?> -->
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Preço (Kz) *</label>
          <input class="form-input" type="number" name="preco" step="0.01" min="0" placeholder="0.00" value="" />
          <!-- value="<?= $produto['preco'] ?? '' ?>" -->
        </div>
        <div class="form-group">
          <label class="form-label">Categoria *</label>
          <select class="form-select" name="categoria_id">
            <option value="">Seleccionar…</option>

            <?php
            foreach ($categorias as $c) {
            ?>
              <option value="<?= $c['id'] ?>"> <?= $c['nome'] ?> </option>
            <?php
            }
            ?>

          </select>
        </div>
      </div>
    </div>

    <div class="form-card">
      <h2 class="form-section-title">Stock</h2>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Quantidade inicial</label>
          <input class="form-input" type="number" name="quantidade" min="0" placeholder="0" value="" />
          <p class="form-hint">Apenas para criação. Use Movimentos para ajustar o stock.</p>
        </div>
        <div class="form-group">
          <label class="form-label">Quantidade mínima</label>
          <input class="form-input" type="number" name="quantidade_minima" min="0" placeholder="5" value="" />
          <p class="form-hint">Abaixo deste valor o sistema emite alerta.</p>
        </div>
      </div>
    </div>

    <div class="form-actions-page">
      <a href="lista.html" class="btn-secondary">Cancelar</a>
      <button type="submit" class="btn-primary">
        <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
          <path d="M2 7l3.5 3.5L11 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        Guardar produto
      </button>
    </div>

  </form>
</div>


<?php
include "../src/Views/layouts/footer.php";
?>