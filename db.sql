CREATE TABLE TB_Avaliacao
(
    CodAvaliacao INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    EstabelecimentoCod INT(11) NOT NULL,
    UsuarioCod INT(11) NOT NULL,
    Nota INT(11) NOT NULL,
    Descricao VARCHAR(255) NOT NULL,
    CriadoEm TIMESTAMP,
    ModificadoEm TIMESTAMP,
    CONSTRAINT TB_Avaliacao_TB_Estabelecimento_CodEstabelecimento_fk FOREIGN KEY (EstabelecimentoCod) REFERENCES TB_Estabelecimento (CodEstabelecimento),
    CONSTRAINT TB_Avaliacao_TB_Usuario_CodUsuario_fk FOREIGN KEY (UsuarioCod) REFERENCES TB_Usuario (CodUsuario)
);
CREATE UNIQUE INDEX TB_Avaliacao_CodAvaliacao_uindex ON TB_Avaliacao (CodAvaliacao);
CREATE INDEX TB_Avaliacao_TB_Estabelecimento_CodEstabelecimento_fk ON TB_Avaliacao (EstabelecimentoCod);
CREATE INDEX TB_Avaliacao_TB_Usuario_CodUsuario_fk ON TB_Avaliacao (UsuarioCod);
CREATE TABLE TB_Categoria
(
    CodCategoria INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Nome VARCHAR(30) NOT NULL
);
CREATE UNIQUE INDEX TB_Categoria_CodCategoria_uindex ON TB_Categoria (CodCategoria);
CREATE TABLE TB_Estabelecimento
(
    CodEstabelecimento INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    CategoriaCod INT(11) NOT NULL,
    LocalizacaoCod INT(11) NOT NULL,
    UsuarioCod INT(11) NOT NULL,
    Nome VARCHAR(120) NOT NULL,
    Descricao TEXT NOT NULL,
    Foto TEXT NOT NULL,
    CriadoEm TIMESTAMP,
    AtualizadoEm TIMESTAMP,
    CNPJ INT(11) NOT NULL,
    CONSTRAINT Estabelecimento_Categoria FOREIGN KEY (CategoriaCod) REFERENCES TB_Categoria (CodCategoria),
    CONSTRAINT TB_Estabelecimento_TB_Localizacao_CodLocalizacao_fk FOREIGN KEY (LocalizacaoCod) REFERENCES TB_Localizacao (CodLocalizacao),
    CONSTRAINT TB_Estabelecimento_TB_Usuario_fk FOREIGN KEY (UsuarioCod) REFERENCES TB_Usuario (CodUsuario)
);
CREATE INDEX Estabelecimento_Categoria ON TB_Estabelecimento (CategoriaCod);
CREATE UNIQUE INDEX TB_Estabelecimento_CNPJ_uindex ON TB_Estabelecimento (CNPJ);
CREATE UNIQUE INDEX TB_Estabelecimento_CodEstabelecimento_uindex ON TB_Estabelecimento (CodEstabelecimento);
CREATE INDEX TB_Estabelecimento_TB_Localizacao_CodLocalizacao_fk ON TB_Estabelecimento (LocalizacaoCod);
CREATE INDEX TB_Estabelecimento_TB_Usuario_fk ON TB_Estabelecimento (UsuarioCod);
CREATE TABLE TB_Galeria
(
    CodGaleria INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    EstabelecimentoCod INT(11) NOT NULL,
    Nome VARCHAR(120),
    Descricao VARCHAR(255),
    Arquivo TEXT NOT NULL,
    CriadoEm TIMESTAMP,
    ModificadoEm TIMESTAMP,
    CONSTRAINT TB_Galeria_TB_Estabelecimento_CodEstabelecimento_fk FOREIGN KEY (EstabelecimentoCod) REFERENCES TB_Estabelecimento (CodEstabelecimento)
);
CREATE UNIQUE INDEX TB_Galeria_CodGaleria_uindex ON TB_Galeria (CodGaleria);
CREATE INDEX TB_Galeria_TB_Estabelecimento_CodEstabelecimento_fk ON TB_Galeria (EstabelecimentoCod);
CREATE TABLE TB_Localizacao
(
    CodLocalizacao INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Estado VARCHAR(100),
    Cidade VARCHAR(125),
    Cep INT(11),
    Rua VARCHAR(255),
    Numero INT(11),
    Bairro VARCHAR(255),
    Complemento VARCHAR(255),
    CriadoEm TIMESTAMP,
    EditadoEm TIMESTAMP,
    Latitude VARCHAR(255),
    Longitude VARCHAR(255)
);
CREATE UNIQUE INDEX TB_Localizacao_CodLocalizacao_uindex ON TB_Localizacao (CodLocalizacao);
CREATE TABLE TB_Permissao
(
    CodPermissao INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Nome VARCHAR(60) NOT NULL,
    Descricao VARCHAR(255)
);
CREATE UNIQUE INDEX TB_Permissao_CodPermissao_uindex ON TB_Permissao (CodPermissao);
CREATE TABLE TB_PermissaoUsuario
(
    CodPermissaoUsuario INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    PermissaoCod INT(11) NOT NULL,
    UsuarioCod INT(11),
    CONSTRAINT TB_PermissaoUsuario_TB_Permissao_CodPermissao_fk FOREIGN KEY (PermissaoCod) REFERENCES TB_Permissao (CodPermissao),
    CONSTRAINT TB_PermissaoUsuario_TB_Usuario_CodUsuario_fk FOREIGN KEY (UsuarioCod) REFERENCES TB_Usuario (CodUsuario)
);
CREATE UNIQUE INDEX TB_PermissaoUsuario_CodPermissaoUsuario_uindex ON TB_PermissaoUsuario (CodPermissaoUsuario);
CREATE INDEX TB_PermissaoUsuario_TB_Permissao_CodPermissao_fk ON TB_PermissaoUsuario (PermissaoCod);
CREATE INDEX TB_PermissaoUsuario_TB_Usuario_CodUsuario_fk ON TB_PermissaoUsuario (UsuarioCod);
CREATE TABLE TB_Sessions
(
    id VARCHAR(40) NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    timestamp INT(10) unsigned DEFAULT '0' NOT NULL,
    data BLOB NOT NULL
);
CREATE INDEX ci_sessions_timestamp ON TB_Sessions (timestamp);
CREATE TABLE TB_Tag
(
    CodTag INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Nome VARCHAR(30) NOT NULL
);
CREATE UNIQUE INDEX Cod ON TB_Tag (CodTag);
CREATE TABLE TB_TagEstabelecimento
(
    CodTagEstabelecimento INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    EstabelecimentoCod INT(11) NOT NULL,
    TagCod INT(11) NOT NULL,
    CONSTRAINT TB_TagEstabelecimento_TB_Estabelecimento_fk FOREIGN KEY (EstabelecimentoCod) REFERENCES TB_Estabelecimento (CodEstabelecimento),
    CONSTRAINT TB_TagEstabelecimento_TB_Tag_fk FOREIGN KEY (TagCod) REFERENCES TB_Tag (CodTag)
);
CREATE UNIQUE INDEX TB_TagEstabelecimento_CodTagEstabelecimento_uindex ON TB_TagEstabelecimento (CodTagEstabelecimento);
CREATE INDEX TB_TagEstabelecimento_TB_Estabelecimento_fk ON TB_TagEstabelecimento (EstabelecimentoCod);
CREATE INDEX TB_TagEstabelecimento_TB_Tag_fk ON TB_TagEstabelecimento (TagCod);
CREATE TABLE TB_Usuario
(
    CodUsuario INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    LocalizacaoCod INT(11),
    Nome VARCHAR(120) NOT NULL,
    Login VARCHAR(30) NOT NULL,
    Senha VARCHAR(150) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Sexo ENUM('M', 'F') NOT NULL,
    CriadoEm TIMESTAMP,
    ModificadoEm TIMESTAMP,
    CONSTRAINT TB_Usuario_TB_Localizacao_CodLocalizacao_fk FOREIGN KEY (LocalizacaoCod) REFERENCES TB_Localizacao (CodLocalizacao)
);
CREATE UNIQUE INDEX TB_Usuario_CodUsuario_uindex ON TB_Usuario (CodUsuario);
CREATE UNIQUE INDEX TB_Usuario_Email_uindex ON TB_Usuario (Email);
CREATE UNIQUE INDEX TB_Usuario_Login_uindex ON TB_Usuario (Login);
CREATE INDEX TB_Usuario_TB_Localizacao_CodLocalizacao_fk ON TB_Usuario (LocalizacaoCod);
CREATE TABLE TB_Contato
(
    CodContato INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    UsuarioCod INT(11),
    EstabelecimentoCod INT(11),
    Valor VARCHAR(255) NOT NULL,
    Nome VARCHAR(30) NOT NULL,
    CriadoEm TIMESTAMP,
    ModificadoEm TIMESTAMP,
    CONSTRAINT TB_Contato_TB_Usuario_CodUsuario_fk FOREIGN KEY (UsuarioCod) REFERENCES TB_Usuario (CodUsuario),
    CONSTRAINT TB_Contato_TB_Estabelecimento_CodEstabelecimento_fk FOREIGN KEY (EstabelecimentoCod) REFERENCES TB_Estabelecimento (CodEstabelecimento)
);
CREATE UNIQUE INDEX TB_Contato_CodContato_uindex ON TB_Contato (CodContato);
CREATE INDEX TB_Contato_TB_Estabelecimento_CodEstabelecimento_fk ON TB_Contato (EstabelecimentoCod);
CREATE INDEX TB_Contato_TB_Usuario_CodUsuario_fk ON TB_Contato (UsuarioCod);
CREATE TABLE TB_Historico
(
    CodHistorico INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    EstabelecimentoCod INT(11),
    TagCod INT(11),
    CategoriaCod INT(11),
    UsuarioCod INT(11),
    CONSTRAINT TB_Historico_TB_Estabelecimento_CodEstabelecimento_fk FOREIGN KEY (EstabelecimentoCod) REFERENCES TB_Estabelecimento (CodEstabelecimento),
    CONSTRAINT TB_Historico_TB_Tag_CodTag_fk FOREIGN KEY (TagCod) REFERENCES TB_Tag (CodTag),
    CONSTRAINT TB_Historico_TB_Categoria_CodCategoria_fk FOREIGN KEY (CategoriaCod) REFERENCES TB_Categoria (CodCategoria),
    CONSTRAINT TB_Historico_TB_Usuario_CodUsuario_fk FOREIGN KEY (UsuarioCod) REFERENCES TB_Usuario (CodUsuario)
);
CREATE UNIQUE INDEX TB_Historico_CodHistorico_uindex ON TB_Historico (CodHistorico);
CREATE INDEX TB_Historico_TB_Categoria_CodCategoria_fk ON TB_Historico (CategoriaCod);
CREATE INDEX TB_Historico_TB_Estabelecimento_CodEstabelecimento_fk ON TB_Historico (EstabelecimentoCod);
CREATE INDEX TB_Historico_TB_Tag_CodTag_fk ON TB_Historico (TagCod);
CREATE INDEX TB_Historico_TB_Usuario_CodUsuario_fk ON TB_Historico (UsuarioCod);