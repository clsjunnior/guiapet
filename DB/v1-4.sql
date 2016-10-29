DROP INDEX TB_Estabelecimento_CNPJ_uindex ON TB_Estabelecimento;
ALTER TABLE TB_Estabelecimento MODIFY CNPJ VARCHAR(14) NOT NULL;
CREATE UNIQUE INDEX TB_Estabelecimento_CNPJ_uindex ON TB_Estabelecimento (CNPJ);
ALTER TABLE TB_Localizacao MODIFY Cep VARCHAR(11);