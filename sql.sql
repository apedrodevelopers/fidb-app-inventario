-- ============================================================
--  inventario — Schema SQL
--  Sistema de Gestão de Inventários — FIDB
--  Motor: MySQL 8.x
-- ============================================================

DROP DATABASE IF EXISTS fidb_inventario;
CREATE DATABASE fidb_inventario
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE fidb_inventario;

-- ============================================================
--  TABELA: utilizadores
-- ============================================================
CREATE TABLE utilizadores (
  id        INT           NOT NULL AUTO_INCREMENT,
  nome      VARCHAR(100)  NOT NULL,
  email     VARCHAR(150)  NOT NULL,
  senha     VARCHAR(255)  NOT NULL COMMENT 'Hash bcrypt via password_hash()',
  perfil    ENUM('administrador', 'operador', 'visualizador') NOT NULL DEFAULT 'operador',
  estado    ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo',
  criado_em TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (id),
  UNIQUE KEY uq_utilizadores_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
--  TABELA: categorias
-- ============================================================
CREATE TABLE categorias (
  id   INT          NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,

  PRIMARY KEY (id),
  UNIQUE KEY uq_categorias_nome (nome)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
--  TABELA: produtos
-- ============================================================
CREATE TABLE produtos (
  id                 INT            NOT NULL AUTO_INCREMENT,
  nome               VARCHAR(150)   NOT NULL,
  descricao          TEXT,
  preco              DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  quantidade         INT            NOT NULL DEFAULT 0 COMMENT 'Stock actual',
  quantidade_minima  INT            NOT NULL DEFAULT 0 COMMENT 'Limiar de alerta de stock baixo',
  categoria_id       INT            NOT NULL,
  criado_em          TIMESTAMP      NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (id),
  CONSTRAINT fk_produtos_categoria
    FOREIGN KEY (categoria_id) REFERENCES categorias (id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
--  TABELA: movimentos
-- ============================================================
CREATE TABLE movimentos (
  id             INT          NOT NULL AUTO_INCREMENT,
  produto_id     INT          NOT NULL,
  tipo           ENUM('entrada', 'saida') NOT NULL,
  quantidade     INT          NOT NULL,
  observacao     VARCHAR(255),
  utilizador_id  INT          NOT NULL,
  criado_em      TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (id),
  CONSTRAINT fk_movimentos_produto
    FOREIGN KEY (produto_id)    REFERENCES produtos    (id)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT fk_movimentos_utilizador
    FOREIGN KEY (utilizador_id) REFERENCES utilizadores (id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  SELECT
    c.id,
    c.nome                        AS categoria,
    COUNT(p.id)                   AS total_produtos,
    COALESCE(SUM(p.quantidade), 0) AS total_stock
  FROM categorias c
  LEFT JOIN produtos p ON p.categoria_id = c.id
  GROUP BY c.id, c.nome
  ORDER BY c.nome;

-- ============================================================
--  DADOS INICIAIS
-- ============================================================

-- ------------------------------------------------------------
--  Utilizadores
--  Senha de todos: 123456
--  Hash gerada com: N/A
-- ------------------------------------------------------------
INSERT INTO utilizadores (nome, email, senha, perfil, estado) VALUES
  (
    'Administrador',
    'admin@inventario.ao',
    '123456',
    'administrador',
    'ativo'
  ),
  (
    'Maria Souza',
    'maria@inventario.ao',
    '123456',
    'operador',
    'ativo'
  ),
  (
    'Carlos Lima',
    'carlos@inventario.ao',
    '123456',
    'visualizador',
    'inativo'
  );

-- ------------------------------------------------------------
--  Categorias
-- ------------------------------------------------------------
INSERT INTO categorias (nome) VALUES
  ('Periféricos'),
  ('Cabos'),
  ('Armazenamento'),
  ('Monitores'),
  ('Redes'),
  ('Energia');

-- ------------------------------------------------------------
--  Produtos
--  categoria_id: 1=Periféricos 2=Cabos 3=Armazenamento
--                4=Monitores   5=Redes  6=Energia
-- ------------------------------------------------------------
INSERT INTO produtos (nome, descricao, preco, quantidade, quantidade_minima, categoria_id) VALUES
  ('Monitor 24"',       'Monitor Full HD 1920x1080, entradas HDMI e VGA.',            45000.00, 15,  5, 4),
  ('Cabo HDMI 2m',      'Cabo HDMI 2.0, suporte 4K, comprimento 2 metros.',            2500.00,  2, 10, 2),
  ('Teclado USB',       'Teclado com fio, layout ABNT2, teclas de atalho.',             8000.00, 20,  5, 1),
  ('Pen Drive 32GB',    'Pen drive USB 3.0, velocidade de leitura até 100 MB/s.',      3200.00,  0, 10, 3),
  ('Rato sem fio',      'Rato óptico sem fio 2.4GHz, pilhas incluídas.',               7500.00, 12,  8, 1),
  ('Hub USB 4 portas',  'Hub USB 3.0 com 4 portas, alimentação por cabo.',             5000.00,  2,  5, 5),
  ('SSD 240GB',         'SSD SATA III 2.5", velocidade de leitura até 500 MB/s.',     18000.00,  8,  3, 3),
  ('Cabo de Rede Cat6', 'Cabo UTP Cat6 1 metro, conector RJ45 em ambas as pontas.',    1200.00, 30,  10, 2),
  ('Switch 8 portas',   'Switch Fast Ethernet 10/100 Mbps, 8 portas RJ45.',           12000.00,  5,  2, 5),
  ('Estabilizador 1KVA','Estabilizador de tensão 1000VA/500W, 4 tomadas.',            22000.00,  4,  2, 6);

-- ------------------------------------------------------------
--  Movimentos
--  Reflectem o stock actual dos produtos acima
-- ------------------------------------------------------------
INSERT INTO movimentos (produto_id, tipo, quantidade, observacao, utilizador_id, criado_em) VALUES
  -- Monitor 24" → stock 15
  (1, 'entrada', 20, 'Compra inicial de fornecedor',     1, '2025-04-01 09:00:00'),
  (1, 'saida',    5, 'Entrega a departamento de TI',      2, '2025-04-15 14:30:00'),

  -- Cabo HDMI 2m → stock 2 (alerta)
  (2, 'entrada', 15, 'Compra inicial de fornecedor',     1, '2025-04-01 09:05:00'),
  (2, 'saida',   13, 'Distribuição de cabos por salas',  2, '2025-05-10 11:00:00'),

  -- Teclado USB → stock 20
  (3, 'entrada', 25, 'Compra inicial de fornecedor',     1, '2025-04-01 09:10:00'),
  (3, 'saida',    5, 'Substituição de teclados avariados', 2, '2025-04-20 16:00:00'),

  -- Pen Drive 32GB → stock 0 (alerta)
  (4, 'entrada', 20, 'Compra inicial de fornecedor',     1, '2025-04-01 09:15:00'),
  (4, 'saida',   20, 'Distribuição a formandos',         2, '2025-05-05 10:00:00'),

  -- Rato sem fio → stock 12
  (5, 'entrada', 15, 'Compra inicial de fornecedor',     1, '2025-04-01 09:20:00'),
  (5, 'saida',    3, 'Substituição de ratos avariados',  2, '2025-04-25 15:00:00'),

  -- Hub USB 4 portas → stock 2 (alerta)
  (6, 'entrada', 10, 'Compra inicial de fornecedor',     1, '2025-04-01 09:25:00'),
  (6, 'saida',    8, 'Distribuição por salas de aula',   2, '2025-05-12 09:00:00'),

  -- SSD 240GB → stock 8
  (7, 'entrada', 10, 'Compra inicial de fornecedor',     1, '2025-04-02 10:00:00'),
  (7, 'saida',    2, 'Instalação em computadores novos', 1, '2025-05-01 14:00:00'),

  -- Cabo de Rede Cat6 → stock 30
  (8, 'entrada', 50, 'Compra inicial de fornecedor',     1, '2025-04-02 10:05:00'),
  (8, 'saida',   20, 'Instalação de rede sala B',        2, '2025-04-28 08:30:00'),

  -- Switch 8 portas → stock 5
  (9, 'entrada',  6, 'Compra inicial de fornecedor',     1, '2025-04-02 10:10:00'),
  (9, 'saida',    1, 'Instalação sala de servidores',    1, '2025-05-03 11:00:00'),

  -- Estabilizador 1KVA → stock 4
  (10,'entrada',  5, 'Compra inicial de fornecedor',     1, '2025-04-02 10:15:00'),
  (10,'saida',    1, 'Instalação em sala de TI',         1, '2025-05-08 13:00:00');

-- ============================================================
--  VERIFICAÇÃO FINAL
-- ============================================================
SELECT 'utilizadores' AS tabela, COUNT(*) AS registos FROM utilizadores
UNION ALL
SELECT 'categorias',  COUNT(*) FROM categorias
UNION ALL
SELECT 'produtos',    COUNT(*) FROM produtos
UNION ALL
SELECT 'movimentos',  COUNT(*) FROM movimentos;
