ALTER TABLE pet.TB_Avaliacao CHANGE ModificadoEm AtualizadoEm TIMESTAMP NULL;
ALTER TABLE pet.TB_Contato CHANGE ModificadoEm AtualizadoEm TIMESTAMP NULL ;
ALTER TABLE pet.TB_Galeria CHANGE ModificadoEm AtualizadoEm TIMESTAMP NULL ;
ALTER TABLE pet.TB_Localizacao CHANGE EditadoEm AtualizadoEm TIMESTAMP NULL ;
ALTER TABLE pet.TB_Usuario CHANGE ModificadoEm AtualizadoEm TIMESTAMP NULL ;

DROP VIEW pet.VW_Estabelecimentos;
CREATE VIEW VW_Estabelecimentos AS
  SELECT es.CodEstabelecimento as EsCodEstabelecimento, es.Nome as EsNome, es.Descricao as EsDescricao,
         es.Foto as EsFoto, es.CriadoEm as EsCriadoEm, es.AtualizadoEm as EsAtualizadoEm, es.CNPJ as EsCNPJ,
         ca.CodCategoria as CaCodCategoria, ca.Nome as CaNome, lo.CodLocalizacao as CoCodLocalizacao,
         lo.Estado as LoEstado, lo.Cidade as LoCidade, lo.Cep as LoCep, lo.Rua as LoRua, lo.Numero as LoNumero,
         lo.Bairro as LoBairro, lo.Complemento as LoComplemento, lo.CriadoEm as LoCriadoEm, lo.AtualizadoEm as LoAtualizadoEm,
         lo.Latitude as LoLatitude, lo.Longitude as LoLongitude, us.CodUsuario as UsCodUsuario, us.Nome as UsNome,
         us.Login as UsLogin, us.Senha as UsSenha, us.Email as UsEmail, us.Sexo as UsSexo, us.CriadoEm as UsCriadoEm,
         co.Valor as CoValor, co.Nome as CoNome,
         us.AtualizadoEm as UsAtualizadoEm
  FROM TB_Estabelecimento as es
    INNER JOIN TB_Categoria as ca ON es.CategoriaCod = ca.CodCategoria
    INNER JOIN TB_Localizacao as lo ON es.LocalizacaoCod = lo.CodLocalizacao
    INNER JOIN TB_Usuario as us ON es.UsuarioCod = us.CodUsuario
    INNER JOIN TB_Contato as co ON es.CodEstabelecimento = co.EstabelecimentoCod;
