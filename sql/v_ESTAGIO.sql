--------------------------------------------------------
--  Arquivo criado - Quinta-feira-Março-10-2016   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for View V_ESTAGIARIO
--------------------------------------------------------

  CREATE OR REPLACE FORCE VIEW "SEMAD"."V_ESTAGIARIO" ("TX_NOME", "CS_TIPO_PESSOA", "CS_SEXO", "DT_ATUALIZACAO", "NB_RG", "NB_CPF", "DT_NASCIMENTO", "TX_ORGAO_EMISSOR", "ID_PESSOA_ESTAGIARIO", "ID_PESSOA_FUNCIONARIO", "NB_FUNCIONARIO", "TX_CEP", "TX_ENDERECO", "NB_NUMERO", "TX_COMPLEMENTO", "TX_BAIRRO", "TX_AGENCIA", "TX_CONTA_CORRENTE", "TX_CONTATO", "TX_EMAIL", "NB_PCD") AS 
  SELECT
	A .TX_NOME,
	A .CS_TIPO_PESSOA,
	b.CS_SEXO,
	B.DT_ATUALIZACAO,
	--b.CS_TIPO,
	b.NB_RG,
	b.NB_CPF,
	B.DT_NASCIMENTO,
	--b.LR_FOTO,
	b.TX_ORGAO_EMISSOR,
	c.ID_PESSOA_ESTAGIARIO,
	c.ID_PESSOA_FUNCIONARIO,
	c.NB_FUNCIONARIO,
	c.TX_CEP,
	c.TX_ENDERECO,
	c.NB_NUMERO,
	c.TX_COMPLEMENTO,
	c.TX_BAIRRO,
	c.TX_AGENCIA,
	c.TX_CONTA_CORRENTE,
	c.TX_CONTATO,
	c.TX_EMAIL,
	c.NB_PCD
FROM
	PESSOA A,
	PESSOA_FISICA b,
	semad.ESTAGIARIO c
WHERE
	A .ID_PESSOA = b.ID_PESSOA
AND B.ID_PESSOA = C.ID_PESSOA_ESTAGIARIO;
--------------------------------------------------------
--  DDL for View V_ESTAGIARIO_2
--------------------------------------------------------

  CREATE OR REPLACE FORCE VIEW "SEMAD"."V_ESTAGIARIO_2" ("TX_NOME", "CS_TIPO_PESSOA", "CS_SEXO", "DT_ATUALIZACAO", "CS_TIPO", "NB_RG", "NB_CPF", "DT_NASCIMENTO", "LR_FOTO", "TX_ORGAO_EMISSOR", "ID_PESSOA_ESTAGIARIO", "ID_PESSOA_FUNCIONARIO", "NB_FUNCIONARIO", "ID_OFERTA_VAGA", "TX_CEP", "TX_ENDERECO", "NB_NUMERO", "TX_COMPLEMENTO", "TX_BAIRRO", "TX_AGENCIA", "TX_CONTA_CORRENTE", "CS_ESCOLARIDADE", "ID_CURSO_ESTAGIO", "NB_PERIODO_ANO", "CS_TURNO", "ID_INSTITUICAO_ENSINO", "ID_ORGAO_ESTAGIO", "CS_TIPO_VAGA_ESTAGIO", "TX_HORA_INICIO", "TX_HORA_FINAL", "ID_BOLSA_ESTAGIO", "ID_PESSOA_SUPERVISOR") AS 
  select a.TX_NOME, a.CS_TIPO_PESSOA, b.CS_SEXO, b.DT_ATUALIZACAO, b.CS_TIPO, b.NB_RG, b.NB_CPF, b.DT_NASCIMENTO, b.LR_FOTO, b.TX_ORGAO_EMISSOR,
       c.ID_PESSOA_ESTAGIARIO, c.ID_PESSOA_FUNCIONARIO, c.NB_FUNCIONARIO, c.ID_OFERTA_VAGA, c.TX_CEP, c.TX_ENDERECO, c.NB_NUMERO, c.TX_COMPLEMENTO,
       c.TX_BAIRRO, c.TX_AGENCIA, c.TX_CONTA_CORRENTE, c.CS_ESCOLARIDADE, c.ID_CURSO_ESTAGIO, c.NB_PERIODO_ANO, c.CS_TURNO, c.ID_INSTITUICAO_ENSINO,
       c.ID_ORGAO_ESTAGIO, c.CS_TIPO_VAGA_ESTAGIO, c.TX_HORA_INICIO, c.TX_HORA_FINAL, c.ID_BOLSA_ESTAGIO, c.ID_PESSOA_SUPERVISOR
  from PESSOA a, PESSOA_FISICA b, semad.ESTAGIARIO c
 where a.ID_PESSOA = b.ID_PESSOA
   and b.ID_PESSOA = c.ID_PESSOA_ESTAGIARIO
;
