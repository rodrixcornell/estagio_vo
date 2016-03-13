select se.ID_SOLICITACAO_ESTAGIO,
       se.DT_CADASTRO,
       se.DT_ATUALIZACAO,
       se.TX_COD_SOLICITACAO,
       se.ID_USUARIO_ATUALIZACAO,
       se.ID_USUARIO_CADASTRO,
       se.ID_ORGAO_ESTAGIO,
       se.ID_ORGAO_GESTOR_ESTAGIO,
       se.TX_JUSTIFICATIVA,
       se.CS_SITUACAO,
       se.ID_AGENCIA_ESTAGIO
  from SEMAD.SOLICITACAO_ESTAGIO se;

select SEMAD.F_G_PK_SOLICITACAO_ESTAGIO as ID_SOLICITACAO_ESTAGIO
from dual;

INSERT
     INTO SOLICITACAO_ESTAGIO
     (ID_SOLICITACAO_ESTAGIO, DT_CADASTRO, DT_ATUALIZACAO, TX_COD_SOLICITACAO, ID_USUARIO_ATUALIZACAO, ID_USUARIO_CADASTRO,
      ID_ORGAO_ESTAGIO, ID_ORGAO_GESTOR_ESTAGIO, TX_JUSTIFICATIVA, CS_SITUACAO, ID_AGENCIA_ESTAGIO)
     values
     (SEMAD.F_G_PK_SOLICITACAO_ESTAGIO, sysdate, sysdate, 'TX_COD_SOLICITACAO', 143, 143,
      1, 2, 'TX_JUSTIFICATIVA', 2, 2);

select oge.ID_ORGAO_GESTOR_ESTAGIO CODIGO,
       oge.TX_ORGAO_GESTOR_ESTAGIO
  from ORGAO_GESTOR_ESTAGIO oge
order by TX_ORGAO_GESTOR_ESTAGIO;

select se.rowid,
       se.id_solicitacao_estagio,
       se.id_orgao_estagio,
       se.id_orgao_gestor_estagio,
       se.id_agencia_estagio,
       se.cs_situacao,
       se.tx_cod_solicitacao,
       se.tx_justificativa,
       se.dt_cadastro,
       se.dt_atualizacao,
       se.id_usuario_cadastro,
       se.id_usuario_atualizacao,
       vs.nb_quantidade,
       vs.cs_tipo_vaga_estagio,
       vs.id_curso_estagio
  from solicitacao_estagio se,
       vagas_solicitacao vs
 where se.id_solicitacao_estagio = vs.id_solicitacao_estagio(+)
       and se.id_orgao_estagio = vs.id_orgao_estagio(+)
order by se.dt_atualizacao desc;

select ID_CURSO_ESTAGIO CODIGO,
       TX_CURSO_ESTAGIO
  from CURSO_ESTAGIO
order by TX_CURSO_ESTAGIO;

select NB_QUANTIDADE,
       ID_CURSO_ESTAGIO
  from VAGAS_ESTAGIO
 where ID_ORGAO_ESTAGIO = 2
       and ID_QUADRO_VAGAS_ESTAGIO = 101
       and CS_TIPO_VAGA_ESTAGIO = 1;

select NB_QUANTIDADE,
       id_orgao_estagio,
       id_quadro_vagas_estagio,
       cs_tipo_vaga_estagio,
       id_curso_estagio
  from VAGAS_ESTAGIO;

select (ve.ID_QUADRO_VAGAS_ESTAGIO ||'_'|| ve.CS_TIPO_VAGA_ESTAGIO ||'_'|| ve.ID_CURSO_ESTAGIO) CODIGO,
       ve.ID_ORGAO_ESTAGIO,
       ve.NB_QUANTIDADE,
       qve.ID_AGENCIA_ESTAGIO,
       tve.TX_TIPO_VAGA_ESTAGIO,
       oe.tx_orgao_estagio,
       oge.tx_orgao_gestor_estagio
  from QUADRO_VAGAS_ESTAGIO qve,
       VAGAS_ESTAGIO ve,
       TIPO_VAGA_ESTAGIO tve,
       ORGAO_ESTAGIO oe,
       ORGAO_GESTOR_ESTAGIO oge
 where qve.ID_QUADRO_VAGAS_ESTAGIO = ve.ID_QUADRO_VAGAS_ESTAGIO
       and ve.CS_TIPO_VAGA_ESTAGIO = tve.CS_TIPO_VAGA_ESTAGIO
       and qve.ID_AGENCIA_ESTAGIO = 2
       and ve.ID_ORGAO_ESTAGIO = 2
       and ve.id_orgao_estagio = oe.id_orgao_estagio
       and qve.id_orgao_gestor_estagio = oge.id_orgao_gestor_estagio
order by tve.TX_TIPO_VAGA_ESTAGIO;

select vs.rowid,
       vs.ID_SOLICITACAO_ESTAGIO,
       vs.ID_ORGAO_ESTAGIO,
       vs.ID_QUADRO_VAGAS_ESTAGIO,
       vs.NB_QUANTIDADE,
       vs.CS_TIPO_VAGA_ESTAGIO,
       vs.ID_CURSO_ESTAGIO,
       vs.CS_SITUACAO,
       decode(vs.CS_SITUACAO, 1, 'EFETIVADO', 2, 'NÃO EFETIVADO') TX_SITUACAO,
       oe.TX_ORGAO_ESTAGIO,
       ae.TX_AGENCIA_ESTAGIO,
       tve.TX_TIPO_VAGA_ESTAGIO,
       ce.TX_CURSO_ESTAGIO
  from VAGAS_SOLICITACAO vs,
       QUADRO_VAGAS_ESTAGIO qve,
       AGENCIA_ESTAGIO ae,
       ORGAO_ESTAGIO oe,
       TIPO_VAGA_ESTAGIO tve,
       CURSO_ESTAGIO ce
 where (vs.ID_ORGAO_ESTAGIO = oe.ID_ORGAO_ESTAGIO)
       and (vs.ID_QUADRO_VAGAS_ESTAGIO = qve.ID_QUADRO_VAGAS_ESTAGIO(+))
       and (qve.ID_AGENCIA_ESTAGIO = ae.ID_AGENCIA_ESTAGIO(+))
       and (vs.CS_TIPO_VAGA_ESTAGIO = tve.CS_TIPO_VAGA_ESTAGIO)
       and (vs.ID_CURSO_ESTAGIO = ce.ID_CURSO_ESTAGIO)
--       and vs.id_solicitacao_estagio = 
--       and vs.id_orgao_estagio = 
order by oe.TX_ORGAO_ESTAGIO,
      ae.TX_AGENCIA_ESTAGIO;

select vs.ID_SOLICITACAO_ESTAGIO,
       vs.ID_ORGAO_ESTAGIO,
       (vs.ID_QUADRO_VAGAS_ESTAGIO ||'_'|| vs.CS_TIPO_VAGA_ESTAGIO) CODIGO,
       vs.ID_CURSO_ESTAGIO,
       vs.NB_QUANTIDADE,
       oe.TX_ORGAO_ESTAGIO,
       ae.TX_AGENCIA_ESTAGIO,
       tve.TX_TIPO_VAGA_ESTAGIO,
       ce.TX_CURSO_ESTAGIO
  from VAGAS_SOLICITACAO vs,
       QUADRO_VAGAS_ESTAGIO qve,
       AGENCIA_ESTAGIO ae,
       ORGAO_ESTAGIO oe,
       TIPO_VAGA_ESTAGIO tve,
       CURSO_ESTAGIO ce
 where (vs.ID_ORGAO_ESTAGIO = oe.ID_ORGAO_ESTAGIO) and (vs.ID_QUADRO_VAGAS_ESTAGIO = qve.ID_QUADRO_VAGAS_ESTAGIO(+)) and (qve.ID_AGENCIA_ESTAGIO = ae.ID_AGENCIA_ESTAGIO(+)) and (vs.CS_TIPO_VAGA_ESTAGIO = tve.CS_TIPO_VAGA_ESTAGIO) and (vs.ID_CURSO_ESTAGIO = ce.ID_CURSO_ESTAGIO) and vs.ID_SOLICITACAO_ESTAGIO = 12 and vs.ID_ORGAO_ESTAGIO = 2
order by oe.TX_ORGAO_ESTAGIO,
      ae.TX_AGENCIA_ESTAGIO;

INSERT
INTO VAGAS_SOLICITACAO
     (ID_SOLICITACAO_ESTAGIO, ID_ORGAO_ESTAGIO, ID_QUADRO_VAGAS_ESTAGIO, CS_TIPO_VAGA_ESTAGIO, ID_CURSO_ESTAGIO, NB_QUANTIDADE, DT_CADASTRO, DT_ATUALIZACAO, ID_USUARIO_CADASTRO, ID_USUARIO_ATUALIZACAO)
values
     (12, 2, 101, 2, 102, 10, SYSDATE, SYSDATE, 143, 143);

select id_solicitacao_estagio,
       id_quadro_vagas_estagio,
       id_orgao_estagio,
       cs_tipo_vaga_estagio,
       id_curso_estagio
  from vagas_solicitacao;

select id_quadro_vagas_estagio,
       id_orgao_estagio,
       cs_tipo_vaga_estagio,
       id_curso_estagio,
       nb_quantidade
  from vagas_estagio;

select *
  from curso_estagio;

select qve.ID_QUADRO_VAGAS_ESTAGIO CODIGO,
       qve.TX_CODIGO
  from QUADRO_VAGAS_ESTAGIO qve
-- where qve.ID_ORGAO_GESTOR_ESTAGIO =
--   and qve.ID_AGENCIA_ESTAGIO =
order by TX_CODIGO desc;

select se.ID_SOLICITACAO_ESTAGIO,
       se.ID_ORGAO_GESTOR_ESTAGIO,
       se.ID_AGENCIA_ESTAGIO,
       se.ID_ORGAO_ESTAGIO,
       se.TX_COD_SOLICITACAO,
       se.TX_JUSTIFICATIVA,
       se.CS_SITUACAO,
       se.ID_QUADRO_VAGAS_ESTAGIO,
       to_char(se.DT_CADASTRO, 'dd/mm/yyyy') DT_CADASTRO,
       to_char(se.DT_ATUALIZACAO, 'dd/mm/yyyy') DT_ATUALIZACAO,
       se.ID_USUARIO_CADASTRO,
       se.ID_USUARIO_ATUALIZACAO,
       oge.TX_ORGAO_GESTOR_ESTAGIO,
       ae.TX_AGENCIA_ESTAGIO,
       oe.TX_ORGAO_ESTAGIO,
       qve.TX_CODIGO,
       vft_cad.TX_FUNCIONARIO TX_FUNCIONARIO_CAD,
       vft_atual.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
  from SOLICITACAO_ESTAGIO se,
       ORGAO_GESTOR_ESTAGIO oge,
       AGENCIA_ESTAGIO ae,
       ORGAO_ESTAGIO oe,
       QUADRO_VAGAS_ESTAGIO qve,
       USUARIO u_cad,
       USUARIO u_atual,
       V_FUNCIONARIO_TOTAL vft_cad,
       V_FUNCIONARIO_TOTAL vft_atual
 where se.ID_ORGAO_GESTOR_ESTAGIO = oge.ID_ORGAO_GESTOR_ESTAGIO
       and se.ID_AGENCIA_ESTAGIO = ae.ID_AGENCIA_ESTAGIO
       and se.ID_ORGAO_ESTAGIO = oe.ID_ORGAO_ESTAGIO
       and se.ID_QUADRO_VAGAS_ESTAGIO = qve.ID_QUADRO_VAGAS_ESTAGIO
       and se.ID_USUARIO_CADASTRO = u_cad.ID_USUARIO
       and se.ID_USUARIO_ATUALIZACAO = u_atual.ID_USUARIO
       and u_cad.ID_PESSOA_FUNCIONARIO = vft_cad.ID_PESSOA_FUNCIONARIO
       and u_atual.ID_PESSOA_FUNCIONARIO = vft_atual.ID_PESSOA_FUNCIONARIO
       and se.ID_SOLICITACAO_ESTAGIO = 72;

select t.rowid,
       t.*
  from semad.solicitacao_estagio t
order by dt_atualizacao desc,
      dt_cadastro desc;

select (ve.CS_TIPO_VAGA_ESTAGIO ||'_'|| ve.ID_CURSO_ESTAGIO ||'_'|| ve.NB_QUANTIDADE) CODIGO, tve.TX_TIPO_VAGA_ESTAGIO
  from QUADRO_VAGAS_ESTAGIO qve,
       VAGAS_ESTAGIO ve,
       TIPO_VAGA_ESTAGIO tve
 where (qve.ID_QUADRO_VAGAS_ESTAGIO = ve.ID_QUADRO_VAGAS_ESTAGIO)
       and (ve.CS_TIPO_VAGA_ESTAGIO = tve.CS_TIPO_VAGA_ESTAGIO)
       and (ve.ID_ORGAO_ESTAGIO = 1)
       and (qve.ID_AGENCIA_ESTAGIO = 2)
       and (qve.ID_QUADRO_VAGAS_ESTAGIO = 101)
order by tve.TX_TIPO_VAGA_ESTAGIO;

select *
from vagas_estagio;

select (ve.CS_TIPO_VAGA_ESTAGIO ||'_'|| ve.ID_CURSO_ESTAGIO ||'_'|| ve.NB_QUANTIDADE) CODIGO,
       tve.TX_TIPO_VAGA_ESTAGIO
  from QUADRO_VAGAS_ESTAGIO qve,
       VAGAS_ESTAGIO ve,
       TIPO_VAGA_ESTAGIO tve
 where (qve.ID_QUADRO_VAGAS_ESTAGIO = ve.ID_QUADRO_VAGAS_ESTAGIO)
       and (ve.CS_TIPO_VAGA_ESTAGIO = tve.CS_TIPO_VAGA_ESTAGIO)
       and (ve.ID_ORGAO_ESTAGIO = 1)
       and (qve.ID_AGENCIA_ESTAGIO = 2)
       and (qve.ID_QUADRO_VAGAS_ESTAGIO = 101)
       and (qve.ID_QUADRO_VAGAS_ESTAGIO not in (select ID_QUADRO_VAGAS_ESTAGIO from QUADRO_VAGAS_ESTAGIO where ID_QUADRO_VAGAS_ESTAGIO = 101))
order by tve.TX_TIPO_VAGA_ESTAGIO;

select vs.ID_SOLICITACAO_ESTAGIO, vs.ID_ORGAO_ESTAGIO, vs.ID_QUADRO_VAGAS_ESTAGIO, vs.CS_TIPO_VAGA_ESTAGIO,
       vs.ID_CURSO_ESTAGIO,
       vs.NB_QUANTIDADE,
       oe.TX_ORGAO_ESTAGIO,
       ae.TX_AGENCIA_ESTAGIO,
       tve.TX_TIPO_VAGA_ESTAGIO,
       ce.TX_CURSO_ESTAGIO
  from VAGAS_SOLICITACAO vs,
       QUADRO_VAGAS_ESTAGIO qve,
       AGENCIA_ESTAGIO ae,
       ORGAO_ESTAGIO oe,
       TIPO_VAGA_ESTAGIO tve,
       CURSO_ESTAGIO ce
 where (vs.ID_ORGAO_ESTAGIO = oe.ID_ORGAO_ESTAGIO)
       and (vs.ID_QUADRO_VAGAS_ESTAGIO = qve.ID_QUADRO_VAGAS_ESTAGIO(+))
       and (qve.ID_AGENCIA_ESTAGIO = ae.ID_AGENCIA_ESTAGIO(+))
       and (vs.CS_TIPO_VAGA_ESTAGIO = tve.CS_TIPO_VAGA_ESTAGIO)
       and (vs.ID_CURSO_ESTAGIO = ce.ID_CURSO_ESTAGIO)
       and (vs.ID_SOLICITACAO_ESTAGIO = 73)
       and (vs.ID_ORGAO_ESTAGIO = 1)
       and (vs.ID_QUADRO_VAGAS_ESTAGIO = 101)
order by oe.TX_ORGAO_ESTAGIO,
      ae.TX_AGENCIA_ESTAGIO;

select (ve.CS_TIPO_VAGA_ESTAGIO ||'_'|| ve.ID_CURSO_ESTAGIO ||'_'|| ve.NB_QUANTIDADE) CODIGO,
       tve.TX_TIPO_VAGA_ESTAGIO
  from QUADRO_VAGAS_ESTAGIO qve,
       VAGAS_ESTAGIO ve,
       TIPO_VAGA_ESTAGIO tve
 where (qve.ID_QUADRO_VAGAS_ESTAGIO = ve.ID_QUADRO_VAGAS_ESTAGIO)
       and (ve.CS_TIPO_VAGA_ESTAGIO = tve.CS_TIPO_VAGA_ESTAGIO)
       and (ve.ID_ORGAO_ESTAGIO = 1)
--       and (qve.ID_AGENCIA_ESTAGIO = 2)
       and (qve.ID_QUADRO_VAGAS_ESTAGIO = 101)
       and (ve.CS_TIPO_VAGA_ESTAGIO not in (select CS_TIPO_VAGA_ESTAGIO from VAGAS_SOLICITACAO where ID_ORGAO_ESTAGIO = 1 and ID_QUADRO_VAGAS_ESTAGIO = 101))
order by tve.TX_TIPO_VAGA_ESTAGIO;

select ve.CS_TIPO_VAGA_ESTAGIO, ve.*
  from VAGAS_ESTAGIO ve
 where ID_ORGAO_ESTAGIO = 1 and ID_QUADRO_VAGAS_ESTAGIO = 101;

select vs.CS_TIPO_VAGA_ESTAGIO, vs.*
from VAGAS_SOLICITACAO vs
where ID_ORGAO_ESTAGIO = 1 and ID_QUADRO_VAGAS_ESTAGIO = 101;

select se.ID_SOLICITACAO_ESTAGIO,
       se.TX_COD_SOLICITACAO,
       se.rowid,
       se.ID_ORGAO_ESTAGIO,
       se.ID_ORGAO_GESTOR_ESTAGIO,
       se.ID_AGENCIA_ESTAGIO,
       se.CS_SITUACAO,
       oe.TX_ORGAO_ESTAGIO,
       oge.TX_ORGAO_GESTOR_ESTAGIO,
       ae.TX_AGENCIA_ESTAGIO,
       tve.tx_tipo_vaga_estagio,
       ce.tx_curso_estagio,
       vs.nb_quantidade
  from SOLICITACAO_ESTAGIO se,
       ORGAO_ESTAGIO oe,
       ORGAO_GESTOR_ESTAGIO oge,
       AGENCIA_ESTAGIO ae,
       VAGAS_SOLICITACAO vs,
       TIPO_VAGA_ESTAGIO tve,
       CURSO_ESTAGIO ce
 where (se.ID_ORGAO_ESTAGIO = oe.ID_ORGAO_ESTAGIO)
       and (se.ID_ORGAO_GESTOR_ESTAGIO = oge.ID_ORGAO_GESTOR_ESTAGIO)
       and (se.ID_AGENCIA_ESTAGIO = ae.ID_AGENCIA_ESTAGIO)
       and (se.ID_ORGAO_ESTAGIO = 1)
       and (se.ID_ORGAO_GESTOR_ESTAGIO = 1)
      
       and se.id_solicitacao_estagio = vs.id_solicitacao_estagio(+)
       and se.id_quadro_vagas_estagio = vs.id_quadro_vagas_estagio(+)
       and se.id_orgao_estagio = vs.id_orgao_estagio(+)
       and vs.cs_tipo_vaga_estagio = tve.cs_tipo_vaga_estagio(+)
       and vs.id_curso_estagio = ce.id_curso_estagio(+)
order by se.DT_ATUALIZACAO,
      se.DT_CADASTRO,
      se.TX_COD_SOLICITACAO,
      oe.TX_ORGAO_ESTAGIO,
      oge.TX_ORGAO_GESTOR_ESTAGIO,
      ae.TX_AGENCIA_ESTAGIO;

select vs.ID_SOLICITACAO_ESTAGIO,
       vs.ID_ORGAO_ESTAGIO,
       vs.ID_QUADRO_VAGAS_ESTAGIO,
       vs.CS_TIPO_VAGA_ESTAGIO,
       vs.ID_CURSO_ESTAGIO,
       vs.NB_QUANTIDADE,
       tve.TX_TIPO_VAGA_ESTAGIO,
       ce.TX_CURSO_ESTAGIO,
       to_char(vs.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
       to_char(vs.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
       vs.ID_USUARIO_CADASTRO,
       vs.ID_USUARIO_ATUALIZACAO,
       vft_cad.TX_FUNCIONARIO TX_FUNCIONARIO_CAD,
       vft_atual.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
  from VAGAS_SOLICITACAO vs,
       TIPO_VAGA_ESTAGIO tve,
       CURSO_ESTAGIO ce,
       USUARIO u_cad,
       USUARIO u_atual,
       V_FUNCIONARIO_TOTAL vft_cad,
       V_FUNCIONARIO_TOTAL vft_atual
 where (vs.CS_TIPO_VAGA_ESTAGIO = tve.CS_TIPO_VAGA_ESTAGIO) and (vs.ID_CURSO_ESTAGIO = ce.ID_CURSO_ESTAGIO) and (vs.ID_USUARIO_CADASTRO = u_cad.ID_USUARIO) and (vs.ID_USUARIO_ATUALIZACAO = u_atual.ID_USUARIO) and (u_cad.ID_PESSOA_FUNCIONARIO = vft_cad.ID_PESSOA_FUNCIONARIO) and (u_cad.ID_UNIDADE_GESTORA = vft_cad.ID_UNIDADE_GESTORA) and (u_atual.ID_PESSOA_FUNCIONARIO = vft_atual.ID_PESSOA_FUNCIONARIO) and (u_atual.ID_UNIDADE_GESTORA = vft_atual.ID_UNIDADE_GESTORA) and (vs.ID_SOLICITACAO_ESTAGIO = 73) and (vs.ID_ORGAO_ESTAGIO = 1) and (vs.ID_QUADRO_VAGAS_ESTAGIO = 101)
order by oe.TX_ORGAO_ESTAGIO,
      ae.TX_AGENCIA_ESTAGIO;

select rowid,
       vagas_solicitacao.*
  from VAGAS_SOLICITACAO;

select vs.ID_SOLICITACAO_ESTAGIO,
       vs.ID_ORGAO_ESTAGIO,
       vs.ID_QUADRO_VAGAS_ESTAGIO,
       vs.CS_TIPO_VAGA_ESTAGIO,
       vs.ID_CURSO_ESTAGIO,
       vs.NB_QUANTIDADE,
       tve.TX_TIPO_VAGA_ESTAGIO,
       ce.TX_CURSO_ESTAGIO,
       to_char(vs.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
       to_char(vs.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
       vs.ID_USUARIO_CADASTRO,
       vs.ID_USUARIO_ATUALIZACAO,
       vft_cad.TX_FUNCIONARIO TX_FUNCIONARIO_CAD,
       vft_atual.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
  from VAGAS_SOLICITACAO vs,
       TIPO_VAGA_ESTAGIO tve,
       CURSO_ESTAGIO ce,
       USUARIO u_cad,
       USUARIO u_atual,
       V_FUNCIONARIO_TOTAL vft_cad,
       V_FUNCIONARIO_TOTAL vft_atual
 where (vs.CS_TIPO_VAGA_ESTAGIO = tve.CS_TIPO_VAGA_ESTAGIO)
       and (vs.ID_CURSO_ESTAGIO = ce.ID_CURSO_ESTAGIO)
       and (vs.ID_USUARIO_CADASTRO = u_cad.ID_USUARIO)
       and (vs.ID_USUARIO_ATUALIZACAO = u_atual.ID_USUARIO)
       and (u_cad.ID_PESSOA_FUNCIONARIO = vft_cad.ID_PESSOA_FUNCIONARIO)
       and (u_cad.ID_UNIDADE_GESTORA = vft_cad.ID_UNIDADE_GESTORA)
       and (u_atual.ID_PESSOA_FUNCIONARIO = vft_atual.ID_PESSOA_FUNCIONARIO)
       and (u_atual.ID_UNIDADE_GESTORA = vft_atual.ID_UNIDADE_GESTORA)
       and (vs.ID_SOLICITACAO_ESTAGIO = 73)
       and (vs.ID_ORGAO_ESTAGIO = 1)
       and (vs.ID_QUADRO_VAGAS_ESTAGIO = 101)
       and (vs.CS_TIPO_VAGA_ESTAGIO = 4);

select distinct
       qve.ID_QUADRO_VAGAS_ESTAGIO CODIGO,
       qve.TX_CODIGO
  from QUADRO_VAGAS_ESTAGIO qve,
       VAGAS_ESTAGIO ve
 where qve.ID_QUADRO_VAGAS_ESTAGIO = ve.ID_QUADRO_VAGAS_ESTAGIO
       and qve.ID_ORGAO_GESTOR_ESTAGIO = 1
       and qve.CS_SITUACAO = 1
       and ve.id_orgao_estagio = 2
order by TX_CODIGO desc;

select se.ID_SOLICITACAO_ESTAGIO,
       se.ID_ORGAO_GESTOR_ESTAGIO,
       se.ID_AGENCIA_ESTAGIO,
       se.ID_ORGAO_ESTAGIO,
       se.CS_SITUACAO,
       se.ID_QUADRO_VAGAS_ESTAGIO,
       se.TX_COD_SOLICITACAO,
       se.TX_JUSTIFICATIVA,
       to_char(se.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
       to_char(se.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
       se.ID_USUARIO_CADASTRO,
       se.ID_USUARIO_ATUALIZACAO,
       oge.TX_ORGAO_GESTOR_ESTAGIO,
       ae.TX_AGENCIA_ESTAGIO,
       oe.TX_ORGAO_ESTAGIO,
       qve.TX_CODIGO,
       vft_cad.TX_FUNCIONARIO TX_FUNCIONARIO_CAD,
       vft_atual.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
  from SOLICITACAO_ESTAGIO se,
       ORGAO_GESTOR_ESTAGIO oge,
       AGENCIA_ESTAGIO ae,
       ORGAO_ESTAGIO oe,
       QUADRO_VAGAS_ESTAGIO qve,
       USUARIO u_cad,
       USUARIO u_atual,
       V_FUNCIONARIO_TOTAL vft_cad,
       V_FUNCIONARIO_TOTAL vft_atual
 where se.ID_ORGAO_GESTOR_ESTAGIO = oge.ID_ORGAO_GESTOR_ESTAGIO
  and se.ID_AGENCIA_ESTAGIO = ae.ID_AGENCIA_ESTAGIO(+)
  and se.ID_ORGAO_ESTAGIO = oe.ID_ORGAO_ESTAGIO
  and se.ID_QUADRO_VAGAS_ESTAGIO = qve.ID_QUADRO_VAGAS_ESTAGIO(+)
  and se.ID_USUARIO_CADASTRO = u_cad.ID_USUARIO
  and se.ID_USUARIO_ATUALIZACAO = u_atual.ID_USUARIO
  and u_cad.ID_PESSOA_FUNCIONARIO = vft_cad.ID_PESSOA_FUNCIONARIO
  and u_atual.ID_PESSOA_FUNCIONARIO = vft_atual.ID_PESSOA_FUNCIONARIO
  and se.ID_SOLICITACAO_ESTAGIO = 62;

insert
  into SOLICITACAO_ESTAGIO
       (ID_SOLICITACAO_ESTAGIO, DT_CADASTRO, DT_ATUALIZACAO, TX_COD_SOLICITACAO, ID_USUARIO_ATUALIZACAO, ID_USUARIO_CADASTRO, ID_ORGAO_ESTAGIO, ID_ORGAO_GESTOR_ESTAGIO, TX_JUSTIFICATIVA, CS_SITUACAO, ID_QUADRO_VAGAS_ESTAGIO, ID_AGENCIA_ESTAGIO)
values (75, SYSDATE, SYSDATE, SEMAD.F_G_COD_SOLICITACAO_ESTAGIO(), 143, 143, 1, 2, 'testando', '1', 202, 0);

select vs.ID_SOLICITACAO_ESTAGIO,
       vs.ID_ORGAO_ESTAGIO,
       vs.ID_QUADRO_VAGAS_ESTAGIO,
       vs.CS_TIPO_VAGA_ESTAGIO,
       vs.ID_CURSO_ESTAGIO,
       vs.NB_QUANTIDADE,
       oe.TX_ORGAO_ESTAGIO,
       ae.TX_AGENCIA_ESTAGIO,
       tve.TX_TIPO_VAGA_ESTAGIO,
       ce.TX_CURSO_ESTAGIO
  from VAGAS_SOLICITACAO vs,
       QUADRO_VAGAS_ESTAGIO qve,
       AGENCIA_ESTAGIO ae,
       ORGAO_ESTAGIO oe,
       TIPO_VAGA_ESTAGIO tve,
       CURSO_ESTAGIO ce
 where (vs.ID_ORGAO_ESTAGIO = oe.ID_ORGAO_ESTAGIO)
       and (vs.ID_QUADRO_VAGAS_ESTAGIO = qve.ID_QUADRO_VAGAS_ESTAGIO)
       and (qve.ID_AGENCIA_ESTAGIO = ae.ID_AGENCIA_ESTAGIO(+))
       and (vs.CS_TIPO_VAGA_ESTAGIO = tve.CS_TIPO_VAGA_ESTAGIO)
       and (vs.ID_CURSO_ESTAGIO = ce.ID_CURSO_ESTAGIO)
       and (vs.ID_SOLICITACAO_ESTAGIO = 73)
       and (vs.ID_ORGAO_ESTAGIO = 1)
       and (vs.ID_QUADRO_VAGAS_ESTAGIO = 101)
order by oe.TX_ORGAO_ESTAGIO,
      ae.TX_AGENCIA_ESTAGIO;

select t.*,
       t.rowid
  from semad.solicitacao_estagio t
order by id_quadro_vagas_estagio desc;

select t.*,
       t.rowid,
       y.*,
       y.rowid
  from semad.quadro_vagas_estagio t,
       semad.vagas_estagio y
 where t.id_quadro_vagas_estagio = y.id_quadro_vagas_estagio
order by t.id_quadro_vagas_estagio desc,
      y.cs_tipo_vaga_estagio desc;
