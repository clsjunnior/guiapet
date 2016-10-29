CREATE
VIEW VW_Estabelecimentosavaliacao AS
    SELECT
        es.CodEstabelecimento AS EsCodEstabelecimento,
        es.Nome AS EsNome,
        es.Descricao AS EsDescricao,
        es.Foto AS EsFoto,
        es.CriadoEm AS EsCriadoEm,
        es.AtualizadoEm AS EsAtualizadoEm,
        es.CNPJ AS EsCNPJ,
        ca.CodCategoria AS CaCodCategoria,
        ca.Nome AS CaNome,
        lo.CodLocalizacao AS CoCodLocalizacao,
        lo.Estado AS LoEstado,
        lo.Cidade AS LoCidade,
        lo.Cep AS LoCep,
        lo.Rua AS LoRua,
        lo.Numero AS LoNumero,
        lo.Bairro AS LoBairro,
        lo.Complemento AS LoComplemento,
        lo.CriadoEm AS LoCriadoEm,
        lo.AtualizadoEm AS LoAtualizadoEm,
        lo.Latitude AS LoLatitude,
        lo.Longitude AS LoLongitude,
        us.CodUsuario AS UsCodUsuario,
        us.Nome AS UsNome,
        us.Login AS UsLogin,
        us.Senha AS UsSenha,
        us.Email AS UsEmail,
        us.Sexo AS UsSexo,
        us.CriadoEm AS UsCriadoEm,
        us.AtualizadoEm AS UsAtualizadoEm,
        co.TelefonePrincipal AS CoTelefonePrincipal,
        co.TelefoneSecundario AS CoTelefoneSecundario,
        co.Facebook AS CoFacebook,
        co.Twitter AS CoTwitter,
        co.Site AS CoSite,
        co.Email AS CoEmail,
        ROUND(AVG(av.Nota), 0) AS media
    FROM
        (((((tb_estabelecimento es
        JOIN tb_categoria ca ON ((es.CategoriaCod = ca.CodCategoria)))
        JOIN tb_localizacao lo ON ((es.LocalizacaoCod = lo.CodLocalizacao)))
        JOIN tb_usuario us ON ((es.UsuarioCod = us.CodUsuario)))
        LEFT JOIN tb_avaliacao av ON ((es.CodEstabelecimento = av.EstabelecimentoCod)))
        LEFT JOIN tb_contato co ON ((es.CodEstabelecimento = co.EstabelecimentoCod)))
    GROUP BY es.CodEstabelecimento;

CREATE VIEW vw_estabelecimentoTags AS
	SELECT es.CodEstabelecimento as EsCodEstabelecimento, es.Nome as EsNome, es.Descricao as EsDescricao,
			 es.Foto as EsFoto, es.CriadoEm as EsCriadoEm, es.AtualizadoEm as EsAtualizadoEm, es.CNPJ as EsCNPJ,
			 ca.CodCategoria as CaCodCategoria, ca.Nome as CaNome, lo.CodLocalizacao as CoCodLocalizacao,
			 lo.Estado as LoEstado, lo.Cidade as LoCidade, lo.Cep as LoCep, lo.Rua as LoRua, lo.Numero as LoNumero,
			 lo.Bairro as LoBairro, lo.Complemento as LoComplemento, lo.CriadoEm as LoCriadoEm, lo.AtualizadoEm as LoAtualizadoEm,
			 lo.Latitude as LoLatitude, lo.Longitude as LoLongitude, us.CodUsuario as UsCodUsuario, us.Nome as UsNome,
			 us.Login as UsLogin, us.Senha as UsSenha, us.Email as UsEmail, us.Sexo as UsSexo, us.CriadoEm as UsCriadoEm,
			 us.AtualizadoEm as UsAtualizadoEm, co.TelefonePrincipal as CoTelefonePrincipal,
			 co.TelefoneSecundario as CoTelefoneSecundario, co.Facebook as CoFacebook, co.Twitter as CoTwitter,
			 co.Site as CoSite, co.Email as CoEmail,
             tg.Nome as tgNome, tg.CodTag as tgCod
	  FROM TB_Estabelecimento as es
		INNER JOIN TB_Categoria as ca ON es.CategoriaCod = ca.CodCategoria
		INNER JOIN TB_Localizacao as lo ON es.LocalizacaoCod = lo.CodLocalizacao
		INNER JOIN TB_Usuario as us ON es.UsuarioCod = us.CodUsuario
		LEFT JOIN TB_Contato as co ON es.CodEstabelecimento = co.EstabelecimentoCod
		LEFT JOIN tb_tagestabelecimento as tges on es.CodEstabelecimento = tges.EstabelecimentoCod
		LEFT JOIN tb_tag as tg on tges.TagCod = tg.CodTag;

CREATE VIEW vw_tagEs AS
SELECT tgEs.CodTagEstabelecimento as codTagEs, tag.CodTag as codTag, tag.Nome as tagNome
FROM tb_tagestabelecimento as tgEs
INNER JOIN tb_tag as tag on tgEs.TagCod = tag.CodTag;
