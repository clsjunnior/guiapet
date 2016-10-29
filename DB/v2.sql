-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0;
SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0;
SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema guiapet
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema guiapet
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS guiapet
  DEFAULT CHARACTER SET utf8;


-- -----------------------------------------------------
-- Table tb_sessions
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tb_sessions (
  id         VARCHAR(40) NOT NULL,
  ip_address VARCHAR(45) NOT NULL,
  timestamp  INT(10)     NOT NULL,
  data       BLOB        NOT NULL
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table tb_localizacao
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tb_localizacao (
  CodLocalizacao INT          NOT NULL AUTO_INCREMENT,
  Estado         VARCHAR(2)   NULL,
  Cidade         VARCHAR(125) NULL,
  Cep            VARCHAR(11)  NULL,
  Rua            VARCHAR(255) NULL,
  Numero         VARCHAR(11)  NULL,
  Bairro         VARCHAR(255) NULL,
  Complemento    VARCHAR(255) NULL,
  Latitude       VARCHAR(255) NULL,
  Longitude      VARCHAR(255) NULL,
  PRIMARY KEY (CodLocalizacao),
  UNIQUE INDEX CodLocalizacao_UNIQUE (CodLocalizacao ASC)
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table tb_contato
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tb_contato (
  CodContato         INT          NOT NULL AUTO_INCREMENT,
  TelefonePrincipal  VARCHAR(15)  NULL,
  TelefoneSecundario VARCHAR(15)  NULL,
  Facebook           VARCHAR(255) NULL,
  Twitter            VARCHAR(255) NULL,
  Site               VARCHAR(255) NULL,
  Email              VARCHAR(255) NULL,
  PRIMARY KEY (CodContato)
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table tb_permissao
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tb_permissao (
  CodPermissao INT         NOT NULL AUTO_INCREMENT,
  Nome         VARCHAR(60) NOT NULL,
  Descricao    TEXT        NULL,
  PRIMARY KEY (CodPermissao),
  UNIQUE INDEX CodPermissao_UNIQUE (CodPermissao ASC)
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table tb_usuario
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tb_usuario (
  CodUsuario     INT             NOT NULL AUTO_INCREMENT,
  Nome           VARCHAR(120)    NOT NULL,
  Login          VARCHAR(50)     NOT NULL,
  Senha          VARCHAR(150)    NOT NULL,
  Email          VARCHAR(255)    NOT NULL,
  Sexo           ENUM ('M', 'F') NOT NULL,
  LocalizacaoCod INT             NULL,
  ContatoCod     INT             NULL,
  PermissaoCod   INT             NOT NULL,
  PRIMARY KEY (CodUsuario),
  UNIQUE INDEX CodUsuario_UNIQUE (CodUsuario ASC),
  INDEX fk_tb_usuario_tb_localizacao1_idx (LocalizacaoCod ASC),
  INDEX fk_tb_usuario_tb_contato1_idx (ContatoCod ASC),
  INDEX fk_tb_usuario_tb_permissao1_idx (PermissaoCod ASC),
  CONSTRAINT fk_tb_usuario_tb_localizacao1
  FOREIGN KEY (LocalizacaoCod)
  REFERENCES tb_localizacao (CodLocalizacao)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_tb_usuario_tb_contato1
  FOREIGN KEY (ContatoCod)
  REFERENCES tb_contato (CodContato)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_tb_usuario_tb_permissao1
  FOREIGN KEY (PermissaoCod)
  REFERENCES tb_permissao (CodPermissao)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table tb_categoria
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tb_categoria (
  CodCategoria INT         NOT NULL AUTO_INCREMENT,
  Nome         VARCHAR(30) NOT NULL,
  PRIMARY KEY (CodCategoria),
  UNIQUE INDEX CodCategoria_UNIQUE (CodCategoria ASC)
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table tb_estabelecimento
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tb_estabelecimento (
  CodEstabelecimento INT          NOT NULL AUTO_INCREMENT,
  Nome               VARCHAR(120) NOT NULL,
  Descricao          TEXT         NOT NULL,
  Foto               TEXT         NOT NULL,
  CNPJ               VARCHAR(14)  NOT NULL,
  LocalizacaoCod     INT          NOT NULL,
  ContatoCod         INT          NULL,
  UsuarioCod         INT          NOT NULL,
  CategoriaCod       INT          NOT NULL,
  PRIMARY KEY (CodEstabelecimento),
  UNIQUE INDEX CodEstabelecimento_UNIQUE (CodEstabelecimento ASC),
  INDEX fk_tb_estabelecimento_tb_localizacao1_idx (LocalizacaoCod ASC),
  INDEX fk_tb_estabelecimento_tb_contato1_idx (ContatoCod ASC),
  INDEX fk_tb_estabelecimento_tb_usuario1_idx (UsuarioCod ASC),
  INDEX fk_tb_estabelecimento_tb_categoria1_idx (CategoriaCod ASC),
  CONSTRAINT fk_tb_estabelecimento_tb_localizacao1
  FOREIGN KEY (LocalizacaoCod)
  REFERENCES tb_localizacao (CodLocalizacao)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_tb_estabelecimento_tb_contato1
  FOREIGN KEY (ContatoCod)
  REFERENCES tb_contato (CodContato)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_tb_estabelecimento_tb_usuario1
  FOREIGN KEY (UsuarioCod)
  REFERENCES tb_usuario (CodUsuario)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_tb_estabelecimento_tb_categoria1
  FOREIGN KEY (CategoriaCod)
  REFERENCES tb_categoria (CodCategoria)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table tb_historico
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tb_historico (
  CodHistorico       INT  NOT NULL AUTO_INCREMENT,
  TagsCod            TEXT NULL,
  UsuarioCod         INT  NOT NULL,
  EstabelecimentoCod INT  NOT NULL,
  CategoriaCod       INT  NOT NULL,
  PRIMARY KEY (CodHistorico),
  UNIQUE INDEX CodHistorico_UNIQUE (CodHistorico ASC),
  INDEX fk_tb_historico_tb_usuario_idx (UsuarioCod ASC),
  INDEX fk_tb_historico_tb_estabelecimento1_idx (EstabelecimentoCod ASC),
  INDEX fk_tb_historico_tb_categoria1_idx (CategoriaCod ASC),
  CONSTRAINT fk_tb_historico_tb_usuario
  FOREIGN KEY (UsuarioCod)
  REFERENCES tb_usuario (CodUsuario)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_tb_historico_tb_estabelecimento1
  FOREIGN KEY (EstabelecimentoCod)
  REFERENCES tb_estabelecimento (CodEstabelecimento)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_tb_historico_tb_categoria1
  FOREIGN KEY (CategoriaCod)
  REFERENCES tb_categoria (CodCategoria)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table tb_tag
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tb_tag (
  CodTag INT         NOT NULL AUTO_INCREMENT,
  Nome   VARCHAR(30) NOT NULL,
  PRIMARY KEY (CodTag),
  UNIQUE INDEX CodTag_UNIQUE (CodTag ASC)
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table tb_tagestabelecimento
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tb_tagestabelecimento (
  CodTagEstabelecimento INT NOT NULL AUTO_INCREMENT,
  TagCod                INT NOT NULL,
  EstabelecimentoCod    INT NOT NULL,
  PRIMARY KEY (CodTagEstabelecimento),
  UNIQUE INDEX CodfTagEstabelecimento_UNIQUE (CodTagEstabelecimento ASC),
  INDEX fk_tb_tagestabelecimento_tb_tag1_idx (TagCod ASC),
  INDEX fk_tb_tagestabelecimento_tb_estabelecimento1_idx (EstabelecimentoCod ASC),
  CONSTRAINT fk_tb_tagestabelecimento_tb_tag1
  FOREIGN KEY (TagCod)
  REFERENCES tb_tag (CodTag)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_tb_tagestabelecimento_tb_estabelecimento1
  FOREIGN KEY (EstabelecimentoCod)
  REFERENCES tb_estabelecimento (CodEstabelecimento)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table tb_galeria
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tb_galeria (
  CodGaleria         INT          NOT NULL AUTO_INCREMENT,
  Nome               VARCHAR(120) NULL,
  Descricao          VARCHAR(255) NULL,
  Arquivo            TEXT         NOT NULL,
  EstabelecimentoCod INT          NOT NULL,
  PRIMARY KEY (CodGaleria),
  UNIQUE INDEX CodGaleria_UNIQUE (CodGaleria ASC),
  INDEX fk_tb_galeria_tb_estabelecimento1_idx (EstabelecimentoCod ASC),
  CONSTRAINT fk_tb_galeria_tb_estabelecimento1
  FOREIGN KEY (EstabelecimentoCod)
  REFERENCES tb_estabelecimento (CodEstabelecimento)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table tb_avaliacao
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tb_avaliacao (
  CodAvaliacao       INT    NOT NULL AUTO_INCREMENT,
  Nota               INT(1) NOT NULL,
  EstabelecimentoCod INT    NOT NULL,
  UsuarioCod         INT    NOT NULL,
  PRIMARY KEY (CodAvaliacao),
  UNIQUE INDEX CodAvaliacao_UNIQUE (CodAvaliacao ASC),
  INDEX fk_tb_avaliacao_tb_estabelecimento1_idx (EstabelecimentoCod ASC),
  INDEX fk_tb_avaliacao_tb_usuario1_idx (UsuarioCod ASC),
  CONSTRAINT fk_tb_avaliacao_tb_estabelecimento1
  FOREIGN KEY (EstabelecimentoCod)
  REFERENCES tb_estabelecimento (CodEstabelecimento)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_tb_avaliacao_tb_usuario1
  FOREIGN KEY (UsuarioCod)
  REFERENCES tb_usuario (CodUsuario)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;



-- -----------------------------------------------------
-- Placeholder table for view VW_Estabelecimentosavaliacao
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS VW_Estabelecimentosavaliacao (
  EsCodEstabelecimento INT,
  EsNome               INT,
  EsDescricao          INT,
  EsFoto               INT,
  EsCNPJ               INT,
  CaCodCategoria       INT,
  CaNome               INT,
  CoCodLocalizacao     INT,
  LoEstado             INT,
  LoCidade             INT,
  LoCep                INT,
  LoRua                INT,
  LoNumero             INT,
  LoBairro             INT,
  LoComplemento        INT,
  LoLatitude           INT,
  LoLongitude          INT,
  UsCodUsuario         INT,
  UsNome               INT,
  UsLogin              INT,
  UsSenha              INT,
  UsEmail              INT,
  UsSexo               INT,
  CoTelefonePrincipal  INT,
  CoTelefoneSecundario INT,
  CoFacebook           INT,
  CoTwitter            INT,
  CoSite               INT,
  CoEmail              INT,
  media                INT
);

-- -----------------------------------------------------
-- Placeholder table for view vw_estabelecimentoTags
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS vw_estabelecimentoTags (
  EsCodEstabelecimento INT,
  EsNome               INT,
  EsDescricao          INT,
  EsFoto               INT,
  EsCNPJ               INT,
  CaCodCategoria       INT,
  CaNome               INT,
  CoCodLocalizacao     INT,
  LoEstado             INT,
  LoCidade             INT,
  LoCep                INT,
  LoRua                INT,
  LoNumero             INT,
  LoBairro             INT,
  LoComplemento        INT,
  LoLatitude           INT,
  LoLongitude          INT,
  UsCodUsuario         INT,
  UsNome               INT,
  UsLogin              INT,
  UsSenha              INT,
  UsEmail              INT,
  UsSexo               INT,
  CoTelefonePrincipal  INT,
  CoTelefoneSecundario INT,
  CoFacebook           INT,
  CoTwitter            INT,
  CoSite               INT,
  CoEmail              INT,
  tgNome               INT,
  tgCod                INT
);

-- -----------------------------------------------------
-- Placeholder table for view vw_tagEs
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS vw_tagEs (
  codTagEs INT,
  codTag   INT,
  tagNome  INT
);

-- -----------------------------------------------------
-- Placeholder table for view vw_estabelecimentos
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS vw_estabelecimentos (
  EsCodEstabelecimento INT,
  EsNome               INT,
  EsDescricao          INT,
  EsFoto               INT,
  EsCNPJ               INT,
  EsContatoCod         INT,
  CaCodCategoria       INT,
  CaNome               INT,
  CoCodLocalizacao     INT,
  LoEstado             INT,
  LoCidade             INT,
  LoCep                INT,
  LoRua                INT,
  LoNumero             INT,
  LoBairro             INT,
  LoComplemento        INT,
  LoLatitude           INT,
  LoLongitude          INT,
  UsCodUsuario         INT,
  UsNome               INT,
  UsLogin              INT,
  UsSenha              INT,
  UsEmail              INT,
  UsSexo               INT,
  CoTelefonePrincipal  INT,
  CoTelefoneSecundario INT,
  CoFacebook           INT,
  CoTwitter            INT,
  CoSite               INT,
  CoEmail              INT
);

-- -----------------------------------------------------
-- View VW_Estabelecimentosavaliacao
-- -----------------------------------------------------
DROP TABLE IF EXISTS VW_Estabelecimentosavaliacao;

CREATE OR REPLACE VIEW VW_Estabelecimentosavaliacao AS
  SELECT
    es.CodEstabelecimento  AS EsCodEstabelecimento,
    es.Nome                AS EsNome,
    es.Descricao           AS EsDescricao,
    es.Foto                AS EsFoto,
    es.CNPJ                AS EsCNPJ,
    ca.CodCategoria        AS CaCodCategoria,
    ca.Nome                AS CaNome,
    lo.CodLocalizacao      AS CoCodLocalizacao,
    lo.Estado              AS LoEstado,
    lo.Cidade              AS LoCidade,
    lo.Cep                 AS LoCep,
    lo.Rua                 AS LoRua,
    lo.Numero              AS LoNumero,
    lo.Bairro              AS LoBairro,
    lo.Complemento         AS LoComplemento,
    lo.Latitude            AS LoLatitude,
    lo.Longitude           AS LoLongitude,
    us.CodUsuario          AS UsCodUsuario,
    us.Nome                AS UsNome,
    us.Login               AS UsLogin,
    us.Senha               AS UsSenha,
    us.Email               AS UsEmail,
    us.Sexo                AS UsSexo,
    co.TelefonePrincipal   AS CoTelefonePrincipal,
    co.TelefoneSecundario  AS CoTelefoneSecundario,
    co.Facebook            AS CoFacebook,
    co.Twitter             AS CoTwitter,
    co.Site                AS CoSite,
    co.Email               AS CoEmail,
    ROUND(AVG(av.Nota), 0) AS media
  FROM
    (((((tb_estabelecimento es
      JOIN tb_categoria ca ON ((es.CategoriaCod = ca.CodCategoria)))
      JOIN tb_localizacao lo ON ((es.LocalizacaoCod = lo.CodLocalizacao)))
      JOIN tb_usuario us ON ((es.UsuarioCod = us.CodUsuario)))
      LEFT JOIN tb_avaliacao av ON ((es.CodEstabelecimento = av.EstabelecimentoCod)))
      JOIN tb_contato co ON ((es.ContatoCod = co.CodContato)))
  GROUP BY es.CodEstabelecimento;

-- -----------------------------------------------------
-- View vw_estabelecimentoTags
-- -----------------------------------------------------
DROP TABLE IF EXISTS vw_estabelecimentoTags;
CREATE OR REPLACE VIEW vw_estabelecimentoTags AS
  SELECT
    es.CodEstabelecimento AS EsCodEstabelecimento,
    es.Nome               AS EsNome,
    es.Descricao          AS EsDescricao,
    es.Foto               AS EsFoto,
    es.CNPJ               AS EsCNPJ,
    ca.CodCategoria       AS CaCodCategoria,
    ca.Nome               AS CaNome,
    lo.CodLocalizacao     AS CoCodLocalizacao,
    lo.Estado             AS LoEstado,
    lo.Cidade             AS LoCidade,
    lo.Cep                AS LoCep,
    lo.Rua                AS LoRua,
    lo.Numero             AS LoNumero,
    lo.Bairro             AS LoBairro,
    lo.Complemento        AS LoComplemento,
    lo.Latitude           AS LoLatitude,
    lo.Longitude          AS LoLongitude,
    us.CodUsuario         AS UsCodUsuario,
    us.Nome               AS UsNome,
    us.Login              AS UsLogin,
    us.Senha              AS UsSenha,
    us.Email              AS UsEmail,
    us.Sexo               AS UsSexo,
    co.TelefonePrincipal  AS CoTelefonePrincipal,
    co.TelefoneSecundario AS CoTelefoneSecundario,
    co.Facebook           AS CoFacebook,
    co.Twitter            AS CoTwitter,
    co.Site               AS CoSite,
    co.Email              AS CoEmail,
    tg.Nome               AS tgNome,
    tg.CodTag             AS tgCod
  FROM
    TB_Estabelecimento AS es
    INNER JOIN
    TB_Categoria AS ca ON es.CategoriaCod = ca.CodCategoria
    INNER JOIN
    TB_Localizacao AS lo ON es.LocalizacaoCod = lo.CodLocalizacao
    INNER JOIN
    TB_Usuario AS us ON es.UsuarioCod = us.CodUsuario
    INNER JOIN
    TB_Contato AS co ON es.ContatoCod = co.CodContato
    LEFT JOIN
    tb_tagestabelecimento AS tges ON es.CodEstabelecimento = tges.EstabelecimentoCod
    LEFT JOIN
    tb_tag AS tg ON tges.TagCod = tg.CodTag;

-- -----------------------------------------------------
-- View vw_tagEs
-- -----------------------------------------------------
DROP TABLE IF EXISTS vw_tagEs;
CREATE OR REPLACE VIEW vw_tagEs AS
  SELECT
    tgEs.CodTagEstabelecimento AS codTagEs,
    tag.CodTag                 AS codTag,
    tag.Nome                   AS tagNome
  FROM
    tb_tagestabelecimento AS tgEs
    INNER JOIN
    tb_tag AS tag ON tgEs.TagCod = tag.CodTag;

-- -----------------------------------------------------
-- View vw_estabelecimentos
-- -----------------------------------------------------
DROP TABLE IF EXISTS vw_estabelecimentos;
CREATE OR REPLACE VIEW vw_estabelecimentos AS
  SELECT
    es.CodEstabelecimento AS EsCodEstabelecimento,
    es.Nome               AS EsNome,
    es.Descricao          AS EsDescricao,
    es.Foto               AS EsFoto,
    es.CNPJ               AS EsCNPJ,
    es.ContatoCod         AS EsContatoCod,
    ca.CodCategoria       AS CaCodCategoria,
    ca.Nome               AS CaNome,
    lo.CodLocalizacao     AS CoCodLocalizacao,
    lo.Estado             AS LoEstado,
    lo.Cidade             AS LoCidade,
    lo.Cep                AS LoCep,
    lo.Rua                AS LoRua,
    lo.Numero             AS LoNumero,
    lo.Bairro             AS LoBairro,
    lo.Complemento        AS LoComplemento,
    lo.Latitude           AS LoLatitude,
    lo.Longitude          AS LoLongitude,
    us.CodUsuario         AS UsCodUsuario,
    us.Nome               AS UsNome,
    us.Login              AS UsLogin,
    us.Senha              AS UsSenha,
    us.Email              AS UsEmail,
    us.Sexo               AS UsSexo,
    co.TelefonePrincipal  AS CoTelefonePrincipal,
    co.TelefoneSecundario AS CoTelefoneSecundario,
    co.Facebook           AS CoFacebook,
    co.Twitter            AS CoTwitter,
    co.Site               AS CoSite,
    co.Email              AS CoEmail
  FROM
    TB_Estabelecimento AS es
    INNER JOIN
    TB_Categoria AS ca ON es.CategoriaCod = ca.CodCategoria
    INNER JOIN
    TB_Localizacao AS lo ON es.LocalizacaoCod = lo.CodLocalizacao
    INNER JOIN
    TB_Usuario AS us ON es.UsuarioCod = us.CodUsuario
    INNER JOIN
    TB_Contato AS co ON es.ContatoCod = co.CodContato;

SET SQL_MODE = @OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS;
