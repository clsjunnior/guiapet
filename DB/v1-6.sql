ALTER TABLE TB_Contato ADD TelefoneSecundario VARCHAR(9) NULL;
ALTER TABLE TB_Contato ADD Facebook VARCHAR(255) NULL;
ALTER TABLE TB_Contato ADD Twitter VARCHAR(255) NULL;
ALTER TABLE TB_Contato ADD Site VARCHAR(255) NULL;
ALTER TABLE TB_Contato ADD Email VARCHAR(255) NULL;
ALTER TABLE TB_Contato CHANGE Valor TelefonePrincipal VARCHAR(9) NOT NULL;
ALTER TABLE TB_Contato DROP Nome;
ALTER TABLE TB_Contato DROP CriadoEm;
ALTER TABLE TB_Contato DROP AtualizadoEm;

DROP VIEW VW_Estabelecimentos;
CREATE VIEW VW_Estabelecimentos AS
  SELECT es.CodEstabelecimento as EsCodEstabelecimento, es.Nome as EsNome, es.Descricao as EsDescricao,
         es.Foto as EsFoto, es.CriadoEm as EsCriadoEm, es.AtualizadoEm as EsAtualizadoEm, es.CNPJ as EsCNPJ,
         ca.CodCategoria as CaCodCategoria, ca.Nome as CaNome, lo.CodLocalizacao as CoCodLocalizacao,
         lo.Estado as LoEstado, lo.Cidade as LoCidade, lo.Cep as LoCep, lo.Rua as LoRua, lo.Numero as LoNumero,
         lo.Bairro as LoBairro, lo.Complemento as LoComplemento, lo.CriadoEm as LoCriadoEm, lo.AtualizadoEm as LoAtualizadoEm,
         lo.Latitude as LoLatitude, lo.Longitude as LoLongitude, us.CodUsuario as UsCodUsuario, us.Nome as UsNome,
         us.Login as UsLogin, us.Senha as UsSenha, us.Email as UsEmail, us.Sexo as UsSexo, us.CriadoEm as UsCriadoEm,
         us.AtualizadoEm as UsAtualizadoEm, co.TelefonePrincipal as CoTelefonePrincipal,
         co.TelefoneSecundario as CoTelefoneSecundario, co.Facebook as CoFacebook, co.Twitter as CoTwitter,
         co.Site as CoSite, co.Email as CoEmail
  FROM TB_Estabelecimento as es
    INNER JOIN TB_Categoria as ca ON es.CategoriaCod = ca.CodCategoria
    INNER JOIN TB_Localizacao as lo ON es.LocalizacaoCod = lo.CodLocalizacao
    INNER JOIN TB_Usuario as us ON es.UsuarioCod = us.CodUsuario
    LEFT JOIN TB_Contato as co ON es.CodEstabelecimento = co.EstabelecimentoCod;