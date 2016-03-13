--------------------------------------------------------
--  Arquivo criado - Quinta-feira-Março-10-2016   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_AGENCIA_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_AGENCIA_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Agencia_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('AGENCIA_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Agencia_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_AGENCIA_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Agencia_Estagio,
          :old.ID_Agencia_Estagio);

-- insere valor do campo tx_Agencia_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('TX_AGENCIA_ESTAGIO',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Agencia_Estagio,
          :old.tx_Agencia_Estagio);

-- insere valor do campo dt_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('DT_CADASTRO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Cadastro,
          :old.dt_Cadastro);

-- insere valor do campo dt_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('DT_ATUALIZACAO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Atualizacao,
          :old.dt_Atualizacao);

-- insere valor do campo tx_Sigla --
  pnb_Campo := F_AVS_Busca_Campo('TX_SIGLA',pID_Tabela,'VARCHAR2(20)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Sigla,
          :old.tx_Sigla);

-- insere valor do campo tx_CNPJ --
  pnb_Campo := F_AVS_Busca_Campo('TX_CNPJ',pID_Tabela,'VARCHAR2(20)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_CNPJ,
          :old.tx_CNPJ);

-- insere valor do campo ID_Usuario_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_CADASTRO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Cadastro,
          :old.ID_Usuario_Cadastro);

-- insere valor do campo ID_Usuario_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_ATUALIZACAO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Atualizacao,
          :old.ID_Usuario_Atualizacao);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_AGENCIA_ESTAGIO" DISABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_AGENTE_SET_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_AGENTE_SET_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Agente_Setorial_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('AGENTE_SETORIAL_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Setorial_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_SETORIAL_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Setorial_Estagio,
          :old.ID_Setorial_Estagio);

-- insere valor do campo ID_Usuario_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_CADASTRO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Cadastro,
          :old.ID_Usuario_Cadastro);

-- insere valor do campo ID_Usuario_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_ATUALIZACAO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Atualizacao,
          :old.ID_Usuario_Atualizacao);

-- insere valor do campo ID_Usuario --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario,
          :old.ID_Usuario);

-- insere valor do campo dt_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('DT_CADASTRO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Cadastro,
          :old.dt_Cadastro);

-- insere valor do campo dt_Atulizacao --
  pnb_Campo := F_AVS_Busca_Campo('DT_ATULIZACAO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Atulizacao,
          :old.dt_Atulizacao);


end; --
/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_AGENTE_SET_ESTAGIO" DISABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_BOLSA_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_BOLSA_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Bolsa_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('BOLSA_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Bolsa_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_BOLSA_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Bolsa_Estagio,
          :old.ID_Bolsa_Estagio);

-- insere valor do campo tx_Bolsa_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('TX_BOLSA_ESTAGIO',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Bolsa_Estagio,
          :old.tx_Bolsa_Estagio);

-- insere valor do campo nb_Valor --
  pnb_Campo := F_AVS_Busca_Campo('NB_VALOR',pID_Tabela,'NUMBER(12,2)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Valor,
          :old.nb_Valor);


end; --
/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_BOLSA_ESTAGIO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_CONTRATO_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_CONTRATO_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on SEMAD.Contrato_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('CONTRATO_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Contrato --
  pnb_Campo := F_AVS_Busca_Campo('ID_CONTRATO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Contrato,
          :old.ID_Contrato);

-- insere valor do campo ID_Pessoa_Estagiario --
  pnb_Campo := F_AVS_Busca_Campo('ID_PESSOA_ESTAGIARIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Pessoa_Estagiario,
          :old.ID_Pessoa_Estagiario);

-- insere valor do campo dt_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('DT_CADASTRO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Cadastro,
          :old.dt_Cadastro);

-- insere valor do campo dt_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('DT_ATUALIZACAO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Atualizacao,
          :old.dt_Atualizacao);

-- insere valor do campo dt_Inicio_Vigencia --
  pnb_Campo := F_AVS_Busca_Campo('DT_INICIO_VIGENCIA',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Inicio_Vigencia,
          :old.dt_Inicio_Vigencia);

-- insere valor do campo dt_Fim_Vigencia --
  pnb_Campo := F_AVS_Busca_Campo('DT_FIM_VIGENCIA',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Fim_Vigencia,
          :old.dt_Fim_Vigencia);

-- insere valor do campo dt_Desligamento --
  pnb_Campo := F_AVS_Busca_Campo('DT_DESLIGAMENTO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Desligamento,
          :old.dt_Desligamento);

-- insere valor do campo nb_Inicio_Horario --
  pnb_Campo := F_AVS_Busca_Campo('NB_INICIO_HORARIO',pID_Tabela,'VARCHAR2(20)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Inicio_Horario,
          :old.nb_Inicio_Horario);

-- insere valor do campo nb_Fim_Horario --
  pnb_Campo := F_AVS_Busca_Campo('NB_FIM_HORARIO',pID_Tabela,'VARCHAR2(20)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Fim_Horario,
          :old.nb_Fim_Horario);

-- insere valor do campo ID_Orgao_Gestor_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_ORGAO_GESTOR_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Orgao_Gestor_Estagio,
          :old.ID_Orgao_Gestor_Estagio);

-- insere valor do campo ID_Orgao_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_ORGAO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Orgao_Estagio,
          :old.ID_Orgao_Estagio);

-- insere valor do campo ID_Quadro_Vagas_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_QUADRO_VAGAS_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Quadro_Vagas_Estagio,
          :old.ID_Quadro_Vagas_Estagio);

-- insere valor do campo ID_Curso_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_CURSO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Curso_Estagio,
          :old.ID_Curso_Estagio);

-- insere valor do campo ID_Pessoa_Supervisor --
  pnb_Campo := F_AVS_Busca_Campo('ID_PESSOA_SUPERVISOR',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Pessoa_Supervisor,
          :old.ID_Pessoa_Supervisor);

-- insere valor do campo ID_Instituicao_Ensino --
  pnb_Campo := F_AVS_Busca_Campo('ID_INSTITUICAO_ENSINO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Instituicao_Ensino,
          :old.ID_Instituicao_Ensino);

-- insere valor do campo ID_Bolsa_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_BOLSA_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Bolsa_Estagio,
          :old.ID_Bolsa_Estagio);

-- insere valor do campo tx_Plano_Atividade --
  pnb_Campo := F_AVS_Busca_Campo('TX_PLANO_ATIVIDADE',pID_Tabela,'VARCHAR2(2000)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Plano_Atividade,
          :old.tx_Plano_Atividade);

-- insere valor do campo cs_Tipo --
  pnb_Campo := F_AVS_Busca_Campo('CS_TIPO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Tipo,
          :old.cs_Tipo);

-- insere valor do campo tx_TCE --
  pnb_Campo := F_AVS_Busca_Campo('TX_TCE',pID_Tabela,'VARCHAR2(20)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_TCE,
          :old.tx_TCE);

-- insere valor do campo ID_Unidade_Org --
  pnb_Campo := F_AVS_Busca_Campo('ID_UNIDADE_ORG',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Unidade_Org,
          :old.ID_Unidade_Org);

-- insere valor do campo ID_Selecao_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_SELECAO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Selecao_Estagio,
          :old.ID_Selecao_Estagio);

-- insere valor do campo ID_Recrutamento_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_RECRUTAMENTO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Recrutamento_Estagio,
          :old.ID_Recrutamento_Estagio);

-- insere valor do campo nb_Vagas_Recrutamento --
  pnb_Campo := F_AVS_Busca_Campo('NB_VAGAS_RECRUTAMENTO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Vagas_Recrutamento,
          :old.nb_Vagas_Recrutamento);

-- insere valor do campo nb_Candidato --
  pnb_Campo := F_AVS_Busca_Campo('NB_CANDIDATO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Candidato,
          :old.nb_Candidato);

-- insere valor do campo cs_Tipo_Vaga_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('CS_TIPO_VAGA_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Tipo_Vaga_Estagio,
          :old.cs_Tipo_Vaga_Estagio);

-- insere valor do campo cs_Periodo --
  pnb_Campo := F_AVS_Busca_Campo('CS_PERIODO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Periodo,
          :old.cs_Periodo);

-- insere valor do campo cs_Horario_Curso --
  pnb_Campo := F_AVS_Busca_Campo('CS_HORARIO_CURSO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Horario_Curso,
          :old.cs_Horario_Curso);

-- insere valor do campo ID_Agencia_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_AGENCIA_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Agencia_Estagio,
          :old.ID_Agencia_Estagio);

-- insere valor do campo tx_Email --
  pnb_Campo := F_AVS_Busca_Campo('TX_EMAIL',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Email,
          :old.tx_Email);

-- insere valor do campo tx_Codigo --
  pnb_Campo := F_AVS_Busca_Campo('TX_CODIGO',pID_Tabela,'VARCHAR2(20)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Codigo,
          :old.tx_Codigo);

-- insere valor do campo cs_Selecao --
  pnb_Campo := F_AVS_Busca_Campo('CS_SELECAO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Selecao,
          :old.cs_Selecao);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_CONTRATO_ESTAGIO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_CURSO_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_CURSO_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Curso_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('CURSO_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Curso_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_CURSO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Curso_Estagio,
          :old.ID_Curso_Estagio);

-- insere valor do campo tx_Curso_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('TX_CURSO_ESTAGIO',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Curso_Estagio,
          :old.tx_Curso_Estagio);

-- insere valor do campo cs_Area_Conhecimento --
  pnb_Campo := F_AVS_Busca_Campo('CS_AREA_CONHECIMENTO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Area_Conhecimento,
          :old.cs_Area_Conhecimento);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_CURSO_ESTAGIO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_ESTAGIARIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_ESTAGIARIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Estagiario
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('ESTAGIARIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Pessoa_Estagiario --
  pnb_Campo := F_AVS_Busca_Campo('ID_PESSOA_ESTAGIARIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Pessoa_Estagiario,
          :old.ID_Pessoa_Estagiario);

-- insere valor do campo ID_Pessoa_Funcionario --
  pnb_Campo := F_AVS_Busca_Campo('ID_PESSOA_FUNCIONARIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Pessoa_Funcionario,
          :old.ID_Pessoa_Funcionario);

-- insere valor do campo nb_Funcionario --
  pnb_Campo := F_AVS_Busca_Campo('NB_FUNCIONARIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Funcionario,
          :old.nb_Funcionario);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_ESTAGIARIO" DISABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_ESTAGIARIO_SELECAO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_ESTAGIARIO_SELECAO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on SEMAD.Estagiario_Selecao
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('ESTAGIARIO_SELECAO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Selecao_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_SELECAO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Selecao_Estagio,
          :old.ID_Selecao_Estagio);

-- insere valor do campo ID_Recrutamento_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_RECRUTAMENTO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Recrutamento_Estagio,
          :old.ID_Recrutamento_Estagio);

-- insere valor do campo nb_Vagas_Recrutamento --
  pnb_Campo := F_AVS_Busca_Campo('NB_VAGAS_RECRUTAMENTO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Vagas_Recrutamento,
          :old.nb_Vagas_Recrutamento);

-- insere valor do campo nb_Candidato --
  pnb_Campo := F_AVS_Busca_Campo('NB_CANDIDATO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Candidato,
          :old.nb_Candidato);

-- insere valor do campo ID_Usuario_Selecionador --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_SELECIONADOR',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Selecionador,
          :old.ID_Usuario_Selecionador);

-- insere valor do campo cs_Situacao --
  pnb_Campo := F_AVS_Busca_Campo('CS_SITUACAO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Situacao,
          :old.cs_Situacao);

-- insere valor do campo tx_Motivo_Situacao --
  pnb_Campo := F_AVS_Busca_Campo('TX_MOTIVO_SITUACAO',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Motivo_Situacao,
          :old.tx_Motivo_Situacao);

-- insere valor do campo ID_Usuario --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario,
          :old.ID_Usuario);

-- insere valor do campo dt_Agendamento --
  pnb_Campo := F_AVS_Busca_Campo('DT_AGENDAMENTO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Agendamento,
          :old.dt_Agendamento);

-- insere valor do campo dt_Realizacao --
  pnb_Campo := F_AVS_Busca_Campo('DT_REALIZACAO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Realizacao,
          :old.dt_Realizacao);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_ESTAGIARIO_SELECAO" DISABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_ESTAGIARIO_VAGA
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_ESTAGIARIO_VAGA" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on SEMAD.Estagiario_Vaga
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('ESTAGIARIO_VAGA');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Recrutamento_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_RECRUTAMENTO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Recrutamento_Estagio,
          :old.ID_Recrutamento_Estagio);

-- insere valor do campo nb_Vagas_Recrutamento --
  pnb_Campo := F_AVS_Busca_Campo('NB_VAGAS_RECRUTAMENTO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Vagas_Recrutamento,
          :old.nb_Vagas_Recrutamento);

-- insere valor do campo nb_Candidato --
  pnb_Campo := F_AVS_Busca_Campo('NB_CANDIDATO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Candidato,
          :old.nb_Candidato);

-- insere valor do campo cs_Situacao --
  pnb_Campo := F_AVS_Busca_Campo('CS_SITUACAO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Situacao,
          :old.cs_Situacao);

-- insere valor do campo tx_Motivo_Situacao --
  pnb_Campo := F_AVS_Busca_Campo('TX_MOTIVO_SITUACAO',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Motivo_Situacao,
          :old.tx_Motivo_Situacao);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_ESTAGIARIO_VAGA" ENABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_ITEM_PAG_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_ITEM_PAG_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Item_Pag_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('ITEM_PAG_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Pagamento_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_PAGAMENTO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Pagamento_Estagio,
          :old.ID_Pagamento_Estagio);

-- insere valor do campo ID_Item_Pagamento_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_ITEM_PAGAMENTO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Item_Pagamento_Estagio,
          :old.ID_Item_Pagamento_Estagio);

-- insere valor do campo ID_Contrato --
  pnb_Campo := F_AVS_Busca_Campo('ID_CONTRATO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Contrato,
          :old.ID_Contrato);

-- insere valor do campo dt_Processamento --
  pnb_Campo := F_AVS_Busca_Campo('DT_PROCESSAMENTO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Processamento,
          :old.dt_Processamento);

-- insere valor do campo nb_Valor_Base --
  pnb_Campo := F_AVS_Busca_Campo('NB_VALOR_BASE',pID_Tabela,'NUMBER(12,2)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Valor_Base,
          :old.nb_Valor_Base);

-- insere valor do campo nb_Valor_Calculado --
  pnb_Campo := F_AVS_Busca_Campo('NB_VALOR_CALCULADO',pID_Tabela,'NUMBER(12,2)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Valor_Calculado,
          :old.nb_Valor_Calculado);

-- insere valor do campo nb_Valor_Unitario --
  pnb_Campo := F_AVS_Busca_Campo('NB_VALOR_UNITARIO',pID_Tabela,'NUMBER(12,2)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Valor_Unitario,
          :old.nb_Valor_Unitario);

-- insere valor do campo nb_Quantidade --
  pnb_Campo := F_AVS_Busca_Campo('NB_QUANTIDADE',pID_Tabela,'NUMBER(12,2)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Quantidade,
          :old.nb_Quantidade);

-- insere valor do campo ID_Usuario --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario,
          :old.ID_Usuario);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_ITEM_PAG_ESTAGIO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_ORGAO_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_ORGAO_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Orgao_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('ORGAO_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Orgao_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_ORGAO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Orgao_Estagio,
          :old.ID_Orgao_Estagio);

-- insere valor do campo tx_Orgao_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('TX_ORGAO_ESTAGIO',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Orgao_Estagio,
          :old.tx_Orgao_Estagio);

-- insere valor do campo dt_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('DT_CADASTRO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Cadastro,
          :old.dt_Cadastro);

-- insere valor do campo dt_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('DT_ATUALIZACAO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Atualizacao,
          :old.dt_Atualizacao);

-- insere valor do campo ID_Unidade_Org --
  pnb_Campo := F_AVS_Busca_Campo('ID_UNIDADE_ORG',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Unidade_Org,
          :old.ID_Unidade_Org);

-- insere valor do campo ID_Usuario_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_CADASTRO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Cadastro,
          :old.ID_Usuario_Cadastro);

-- insere valor do campo ID_Usuario_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_ATUALIZACAO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Atualizacao,
          :old.ID_Usuario_Atualizacao);


end; --
/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_ORGAO_ESTAGIO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_ORGAO_GESTOR_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_ORGAO_GESTOR_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Orgao_Gestor_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('ORGAO_GESTOR_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Orgao_Gestor_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_ORGAO_GESTOR_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Orgao_Gestor_Estagio,
          :old.ID_Orgao_Gestor_Estagio);

-- insere valor do campo tx_Orgao_Gestor_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('TX_ORGAO_GESTOR_ESTAGIO',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Orgao_Gestor_Estagio,
          :old.tx_Orgao_Gestor_Estagio);

-- insere valor do campo dt_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('DT_CADASTRO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Cadastro,
          :old.dt_Cadastro);

-- insere valor do campo dt_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('DT_ATUALIZACAO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Atualizacao,
          :old.dt_Atualizacao);

-- insere valor do campo ID_Unidade_Org --
  pnb_Campo := F_AVS_Busca_Campo('ID_UNIDADE_ORG',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Unidade_Org,
          :old.ID_Unidade_Org);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_ORGAO_GESTOR_ESTAGIO" DISABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_PAGAMENTO_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_PAGAMENTO_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Pagamento_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('PAGAMENTO_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Pagamento_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_PAGAMENTO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Pagamento_Estagio,
          :old.ID_Pagamento_Estagio);

-- insere valor do campo dt_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('DT_CADASTRO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Cadastro,
          :old.dt_Cadastro);

-- insere valor do campo dt_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('DT_ATUALIZACAO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Atualizacao,
          :old.dt_Atualizacao);

-- insere valor do campo nb_Ano --
  pnb_Campo := F_AVS_Busca_Campo('NB_ANO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Ano,
          :old.nb_Ano);

-- insere valor do campo nb_Mes --
  pnb_Campo := F_AVS_Busca_Campo('NB_MES',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Mes,
          :old.nb_Mes);

-- insere valor do campo cs_Situacao --
  pnb_Campo := F_AVS_Busca_Campo('CS_SITUACAO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Situacao,
          :old.cs_Situacao);

-- insere valor do campo nb_Dias_Uteis --
  pnb_Campo := F_AVS_Busca_Campo('NB_DIAS_UTEIS',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Dias_Uteis,
          :old.nb_Dias_Uteis);

-- insere valor do campo ID_Orgao_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_ORGAO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Orgao_Estagio,
          :old.ID_Orgao_Estagio);

-- insere valor do campo ID_Orgao_Gestor_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_ORGAO_GESTOR_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Orgao_Gestor_Estagio,
          :old.ID_Orgao_Gestor_Estagio);

-- insere valor do campo ID_Agencia_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_AGENCIA_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Agencia_Estagio,
          :old.ID_Agencia_Estagio);

-- insere valor do campo ID_Usuario_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_CADASTRO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Cadastro,
          :old.ID_Usuario_Cadastro);

-- insere valor do campo ID_Usuario_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_ATUALIZACAO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Atualizacao,
          :old.ID_Usuario_Atualizacao);

-- insere valor do campo cs_Tipo_Pag_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('CS_TIPO_PAG_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Tipo_Pag_Estagio,
          :old.cs_Tipo_Pag_Estagio);

-- insere valor do campo dt_Inicio_Competencia --
  pnb_Campo := F_AVS_Busca_Campo('DT_INICIO_COMPETENCIA',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Inicio_Competencia,
          :old.dt_Inicio_Competencia);

-- insere valor do campo dt_Fim_Competencia --
  pnb_Campo := F_AVS_Busca_Campo('DT_FIM_COMPETENCIA',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Fim_Competencia,
          :old.dt_Fim_Competencia);

-- insere valor do campo dt_Inicio_Frequencia --
  pnb_Campo := F_AVS_Busca_Campo('DT_INICIO_FREQUENCIA',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Inicio_Frequencia,
          :old.dt_Inicio_Frequencia);

-- insere valor do campo dt_Fim_Frequencia --
  pnb_Campo := F_AVS_Busca_Campo('DT_FIM_FREQUENCIA',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Fim_Frequencia,
          :old.dt_Fim_Frequencia);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_PAGAMENTO_ESTAGIO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_QUADRO_VAGAS_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_QUADRO_VAGAS_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Quadro_Vagas_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('QUADRO_VAGAS_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Quadro_Vagas_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_QUADRO_VAGAS_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Quadro_Vagas_Estagio,
          :old.ID_Quadro_Vagas_Estagio);

-- insere valor do campo ID_Agencia_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_AGENCIA_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Agencia_Estagio,
          :old.ID_Agencia_Estagio);

-- insere valor do campo ID_Orgao_Gestor_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_ORGAO_GESTOR_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Orgao_Gestor_Estagio,
          :old.ID_Orgao_Gestor_Estagio);

-- insere valor do campo dt_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('DT_CADASTRO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Cadastro,
          :old.dt_Cadastro);

-- insere valor do campo dt_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('DT_ATUALIZACAO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Atualizacao,
          :old.dt_Atualizacao);

-- insere valor do campo ID_Usuario_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_CADASTRO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Cadastro,
          :old.ID_Usuario_Cadastro);

-- insere valor do campo ID_Usuario_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_ATUALIZACAO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Atualizacao,
          :old.ID_Usuario_Atualizacao);

-- insere valor do campo cs_Situacao --
  pnb_Campo := F_AVS_Busca_Campo('CS_SITUACAO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Situacao,
          :old.cs_Situacao);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_QUADRO_VAGAS_ESTAGIO" DISABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_RECESSO_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_RECESSO_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on SEMAD.Recesso_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('RECESSO_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Recesso_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_RECESSO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Recesso_Estagio,
          :old.ID_Recesso_Estagio);

-- insere valor do campo tx_Codigo --
  pnb_Campo := F_AVS_Busca_Campo('TX_CODIGO',pID_Tabela,'VARCHAR2(20)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Codigo,
          :old.tx_Codigo);

-- insere valor do campo tx_Cargo_Agente --
  pnb_Campo := F_AVS_Busca_Campo('TX_CARGO_AGENTE',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Cargo_Agente,
          :old.tx_Cargo_Agente);

-- insere valor do campo tx_Email_Agente --
  pnb_Campo := F_AVS_Busca_Campo('TX_EMAIL_AGENTE',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Email_Agente,
          :old.tx_Email_Agente);

-- insere valor do campo tx_Telefone_Agente --
  pnb_Campo := F_AVS_Busca_Campo('TX_TELEFONE_AGENTE',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Telefone_Agente,
          :old.tx_Telefone_Agente);

-- insere valor do campo dt_Inicio_Vig_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('DT_INICIO_VIG_ESTAGIO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Inicio_Vig_Estagio,
          :old.dt_Inicio_Vig_Estagio);

-- insere valor do campo tx_Justificativa_Adiamento --
  pnb_Campo := F_AVS_Busca_Campo('TX_JUSTIFICATIVA_ADIAMENTO',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Justificativa_Adiamento,
          :old.tx_Justificativa_Adiamento);

-- insere valor do campo dt_Adiamento --
  pnb_Campo := F_AVS_Busca_Campo('DT_ADIAMENTO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Adiamento,
          :old.dt_Adiamento);

-- insere valor do campo ID_Contrato --
  pnb_Campo := F_AVS_Busca_Campo('ID_CONTRATO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Contrato,
          :old.ID_Contrato);

-- insere valor do campo ID_Setorial_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_SETORIAL_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Setorial_Estagio,
          :old.ID_Setorial_Estagio);

-- insere valor do campo ID_Agencia_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_AGENCIA_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Agencia_Estagio,
          :old.ID_Agencia_Estagio);

-- insere valor do campo ID_Usuario_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_CADASTRO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Cadastro,
          :old.ID_Usuario_Cadastro);

-- insere valor do campo ID_Orgao_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_ORGAO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Orgao_Estagio,
          :old.ID_Orgao_Estagio);

-- insere valor do campo ID_Usuario_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_ATUALIZACAO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Atualizacao,
          :old.ID_Usuario_Atualizacao);

-- insere valor do campo dt_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('DT_CADASTRO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Cadastro,
          :old.dt_Cadastro);

-- insere valor do campo dt_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('DT_ATUALIZACAO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Atualizacao,
          :old.dt_Atualizacao);

-- insere valor do campo cs_Situacao --
  pnb_Campo := F_AVS_Busca_Campo('CS_SITUACAO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Situacao,
          :old.cs_Situacao);

-- insere valor do campo dt_Fim_Vigencia_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('DT_FIM_VIGENCIA_ESTAGIO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Fim_Vigencia_Estagio,
          :old.dt_Fim_Vigencia_Estagio);

-- insere valor do campo dt_Inicio_Recesso --
  pnb_Campo := F_AVS_Busca_Campo('DT_INICIO_RECESSO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Inicio_Recesso,
          :old.dt_Inicio_Recesso);

-- insere valor do campo dt_Fim_Recesso --
  pnb_Campo := F_AVS_Busca_Campo('DT_FIM_RECESSO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Fim_Recesso,
          :old.dt_Fim_Recesso);

-- insere valor do campo nb_Mes_Referencia --
  pnb_Campo := F_AVS_Busca_Campo('NB_MES_REFERENCIA',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Mes_Referencia,
          :old.nb_Mes_Referencia);

-- insere valor do campo nb_Ano_Referencia --
  pnb_Campo := F_AVS_Busca_Campo('NB_ANO_REFERENCIA',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Ano_Referencia,
          :old.nb_Ano_Referencia);

-- insere valor do campo dt_Assinatura --
  pnb_Campo := F_AVS_Busca_Campo('DT_ASSINATURA',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Assinatura,
          :old.dt_Assinatura);

-- insere valor do campo tx_Matricula --
  pnb_Campo := F_AVS_Busca_Campo('TX_MATRICULA',pID_Tabela,'VARCHAR2(20)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Matricula,
          :old.tx_Matricula);

-- insere valor do campo nb_Dias_Restantes --
  pnb_Campo := F_AVS_Busca_Campo('NB_DIAS_RESTANTES',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Dias_Restantes,
          :old.nb_Dias_Restantes);

-- insere valor do campo tx_Chefia_Imediata --
  pnb_Campo := F_AVS_Busca_Campo('TX_CHEFIA_IMEDIATA',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Chefia_Imediata,
          :old.tx_Chefia_Imediata);

-- insere valor do campo cs_Realizacao --
  pnb_Campo := F_AVS_Busca_Campo('CS_REALIZACAO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Realizacao,
          :old.cs_Realizacao);

-- insere valor do campo ID_Orgao_Gestor_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_ORGAO_GESTOR_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Orgao_Gestor_Estagio,
          :old.ID_Orgao_Gestor_Estagio);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_RECESSO_ESTAGIO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_RECRUTAMENTO_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_RECRUTAMENTO_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Recrutamento_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('RECRUTAMENTO_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Recrutamento_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_RECRUTAMENTO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Recrutamento_Estagio,
          :old.ID_Recrutamento_Estagio);

-- insere valor do campo tx_Cod_Recrutamento --
  pnb_Campo := F_AVS_Busca_Campo('TX_COD_RECRUTAMENTO',pID_Tabela,'VARCHAR2(20)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Cod_Recrutamento,
          :old.tx_Cod_Recrutamento);

-- insere valor do campo dt_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('DT_CADASTRO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Cadastro,
          :old.dt_Cadastro);

-- insere valor do campo dt_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('DT_ATUALIZACAO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Atualizacao,
          :old.dt_Atualizacao);

-- insere valor do campo tx_Doc_Autorizacao --
  pnb_Campo := F_AVS_Busca_Campo('TX_DOC_AUTORIZACAO',pID_Tabela,'VARCHAR2(20)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Doc_Autorizacao,
          :old.tx_Doc_Autorizacao);

-- insere valor do campo tx_Motivo --
  pnb_Campo := F_AVS_Busca_Campo('TX_MOTIVO',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Motivo,
          :old.tx_Motivo);

-- insere valor do campo ID_Quadro_Vagas_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_QUADRO_VAGAS_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Quadro_Vagas_Estagio,
          :old.ID_Quadro_Vagas_Estagio);

-- insere valor do campo ID_Orgao_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_ORGAO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Orgao_Estagio,
          :old.ID_Orgao_Estagio);

-- insere valor do campo ID_Usuario_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_CADASTRO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Cadastro,
          :old.ID_Usuario_Cadastro);

-- insere valor do campo ID_Usuario_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_ATUALIZACAO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Atualizacao,
          :old.ID_Usuario_Atualizacao);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_RECRUTAMENTO_ESTAGIO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_SELECAO_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_SELECAO_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Selecao_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('SELECAO_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Selecao_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_SELECAO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Selecao_Estagio,
          :old.ID_Selecao_Estagio);

-- insere valor do campo tx_Cod_Selecao --
  pnb_Campo := F_AVS_Busca_Campo('TX_COD_SELECAO',pID_Tabela,'VARCHAR2(20)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Cod_Selecao,
          :old.tx_Cod_Selecao);

-- insere valor do campo dt_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('DT_ATUALIZACAO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Atualizacao,
          :old.dt_Atualizacao);

-- insere valor do campo dt_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('DT_CADASTRO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Cadastro,
          :old.dt_Cadastro);

-- insere valor do campo dt_Realizacao --
  pnb_Campo := F_AVS_Busca_Campo('DT_REALIZACAO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Realizacao,
          :old.dt_Realizacao);

-- insere valor do campo dt_Agendamento --
  pnb_Campo := F_AVS_Busca_Campo('DT_AGENDAMENTO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Agendamento,
          :old.dt_Agendamento);

-- insere valor do campo ID_Usuario_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_CADASTRO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Cadastro,
          :old.ID_Usuario_Cadastro);

-- insere valor do campo ID_Usuario_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_ATUALIZACAO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Atualizacao,
          :old.ID_Usuario_Atualizacao);

-- insere valor do campo ID_Orgao_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_ORGAO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Orgao_Estagio,
          :old.ID_Orgao_Estagio);

-- insere valor do campo ID_Recrutamento_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_RECRUTAMENTO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Recrutamento_Estagio,
          :old.ID_Recrutamento_Estagio);

-- insere valor do campo ID_Orgao_Gestor_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_ORGAO_GESTOR_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Orgao_Gestor_Estagio,
          :old.ID_Orgao_Gestor_Estagio);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_SELECAO_ESTAGIO" DISABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_SOLICITACAO_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_SOLICITACAO_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Solicitacao_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('SEMAD.SOLICITACAO_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Solicitacao_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_SOLICITACAO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Solicitacao_Estagio,
          :old.ID_Solicitacao_Estagio);

-- insere valor do campo tx_Cod_Solicitacao --
  pnb_Campo := F_AVS_Busca_Campo('TX_COD_SOLICITACAO',pID_Tabela,'VARCHAR2(20)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Cod_Solicitacao,
          :old.tx_Cod_Solicitacao);

-- insere valor do campo dt_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('DT_CADASTRO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Cadastro,
          :old.dt_Cadastro);

-- insere valor do campo dt_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('DT_ATUALIZACAO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Atualizacao,
          :old.dt_Atualizacao);

-- insere valor do campo tx_Justificativa --
  pnb_Campo := F_AVS_Busca_Campo('TX_JUSTIFICATIVA',pID_Tabela,'VARCHAR2(20)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Justificativa,
          :old.tx_Justificativa);

-- insere valor do campo cs_Situacao --
  pnb_Campo := F_AVS_Busca_Campo('CS_SITUACAO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Situacao,
          :old.cs_Situacao);

-- insere valor do campo ID_Usuario_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_CADASTRO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Cadastro,
          :old.ID_Usuario_Cadastro);

-- insere valor do campo ID_Usuario_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_ATUALIZACAO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Atualizacao,
          :old.ID_Usuario_Atualizacao);

-- insere valor do campo ID_Orgao_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_ORGAO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Orgao_Estagio,
          :old.ID_Orgao_Estagio);

-- insere valor do campo ID_Orgao_Gestor_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_ORGAO_GESTOR_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Orgao_Gestor_Estagio,
          :old.ID_Orgao_Gestor_Estagio);

-- insere valor do campo ID_Quadro_Vagas_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_QUADRO_VAGAS_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Quadro_Vagas_Estagio,
          :old.ID_Quadro_Vagas_Estagio);


end; -- T_PRM_B_I_Pessoa_Fisica

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_SOLICITACAO_ESTAGIO" DISABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_SUPERVISOR_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_SUPERVISOR_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Supervisor_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('SUPERVISOR_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Pessoa_Supervisor --
  pnb_Campo := F_AVS_Busca_Campo('ID_PESSOA_SUPERVISOR',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Pessoa_Supervisor,
          :old.ID_Pessoa_Supervisor);

-- insere valor do campo ID_Pessoa_Funcionario --
  pnb_Campo := F_AVS_Busca_Campo('ID_PESSOA_FUNCIONARIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Pessoa_Funcionario,
          :old.ID_Pessoa_Funcionario);

-- insere valor do campo nb_Funcionario --
  pnb_Campo := F_AVS_Busca_Campo('NB_FUNCIONARIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Funcionario,
          :old.nb_Funcionario);

-- insere valor do campo tx_Curriculo --
  pnb_Campo := F_AVS_Busca_Campo('TX_CURRICULO',pID_Tabela,'VARCHAR2(2000)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Curriculo,
          :old.tx_Curriculo);

-- insere valor do campo ID_Conselho --
  pnb_Campo := F_AVS_Busca_Campo('ID_CONSELHO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Conselho,
          :old.ID_Conselho);

-- insere valor do campo nb_Inscricao_Conselho --
  pnb_Campo := F_AVS_Busca_Campo('NB_INSCRICAO_CONSELHO',pID_Tabela,'VARCHAR2(80)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Inscricao_Conselho,
          :old.nb_Inscricao_Conselho);

-- insere valor do campo tx_Formacao --
  pnb_Campo := F_AVS_Busca_Campo('TX_FORMACAO',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Formacao,
          :old.tx_Formacao);

-- insere valor do campo tx_Cargo --
  pnb_Campo := F_AVS_Busca_Campo('TX_CARGO',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Cargo,
          :old.tx_Cargo);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_SUPERVISOR_ESTAGIO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_TIPO_PAG_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_TIPO_PAG_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Tipo_Pag_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('TIPO_PAG_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo cs_Tipo_Pag_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('CS_TIPO_PAG_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Tipo_Pag_Estagio,
          :old.cs_Tipo_Pag_Estagio);

-- insere valor do campo tx_Tipo_Pag_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('TX_TIPO_PAG_ESTAGIO',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Tipo_Pag_Estagio,
          :old.tx_Tipo_Pag_Estagio);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_TIPO_PAG_ESTAGIO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_TIPO_VAGA_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_TIPO_VAGA_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Tipo_Vaga_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('TIPO_VAGA_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo cs_Tipo_Vaga_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('CS_TIPO_VAGA_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Tipo_Vaga_Estagio,
          :old.cs_Tipo_Vaga_Estagio);

-- insere valor do campo tx_Tipo_Vaga_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('TX_TIPO_VAGA_ESTAGIO',pID_Tabela,'VARCHAR2(255)');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.tx_Tipo_Vaga_Estagio,
          :old.tx_Tipo_Vaga_Estagio);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_TIPO_VAGA_ESTAGIO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_VAGAS_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_VAGAS_ESTAGIO" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on semad.Vagas_Estagio
  REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW

declare
  pnb_Valor_Historico number;
  pID_Tabela number;
  pnb_Campo number;
  pnb_Transacao number;
  pID_Usuario number;
  pcs_evento number;
begin
  select id_usuario into pid_usuario
  from usuario
  where tx_login = user;
  if inserting then
     pcs_evento := 1;
  else
     if updating then
        pcs_evento := 2;
     else
        pcs_evento := 3;
     end if;
  end if;
  pID_Tabela := F_AVS_Busca_Tabela('VAGAS_ESTAGIO');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Quadro_Vagas_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_QUADRO_VAGAS_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Quadro_Vagas_Estagio,
          :old.ID_Quadro_Vagas_Estagio);

-- insere valor do campo ID_Orgao_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_ORGAO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Orgao_Estagio,
          :old.ID_Orgao_Estagio);

-- insere valor do campo cs_Tipo_Vaga_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('CS_TIPO_VAGA_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.cs_Tipo_Vaga_Estagio,
          :old.cs_Tipo_Vaga_Estagio);

-- insere valor do campo nb_Quantidade --
  pnb_Campo := F_AVS_Busca_Campo('NB_QUANTIDADE',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.nb_Quantidade,
          :old.nb_Quantidade);

-- insere valor do campo dt_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('DT_CADASTRO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Cadastro,
          :old.dt_Cadastro);

-- insere valor do campo dt_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('DT_ATUALIZACAO',pID_Tabela,'DATE');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.dt_Atualizacao,
          :old.dt_Atualizacao);

-- insere valor do campo ID_Usuario_Cadastro --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_CADASTRO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Cadastro,
          :old.ID_Usuario_Cadastro);

-- insere valor do campo ID_Usuario_Atualizacao --
  pnb_Campo := F_AVS_Busca_Campo('ID_USUARIO_ATUALIZACAO',pID_Tabela,'NUMBER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Usuario_Atualizacao,
          :old.ID_Usuario_Atualizacao);

-- insere valor do campo ID_Curso_Estagio --
  pnb_Campo := F_AVS_Busca_Campo('ID_CURSO_ESTAGIO',pID_Tabela,'INTEGER');
  pnb_Valor_Historico := F_G_PK_Valor_Historico(pID_Tabela,pnb_Transacao,pnb_Campo,pID_usuario);
  insert into semad.Valor_Historico
         (nb_Valor_Historico,
          ID_Tabela,
          nb_Transacao_Historico,
          nb_Campo,
          ID_Usuario,
          nb_Valor_Varchar2000,
          nb_Old_Varchar2000)
  Values (pnb_Valor_Historico,
          pID_Tabela,
          pnb_Transacao,
          pnb_Campo,
          pID_Usuario,
          :new.ID_Curso_Estagio,
          :old.ID_Curso_Estagio);


end; --

/
ALTER TRIGGER "SEMAD"."T_AVS_IUD_VAGAS_ESTAGIO" DISABLE;
--------------------------------------------------------
--  DDL for Trigger T_EST_U_SELECAO_ESTAGIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_EST_U_SELECAO_ESTAGIO" 
  after
  UPDATE 
  on SEMAD.SELECAO_ESTAGIO
  referencing new as new old as old
   FOR EACH ROW
begin
  
  if :new.CS_SITUACAO = 2 then
    begin
      for CURSOR1 in (select ID_RECRUTAMENTO_ESTAGIO, NB_VAGAS_RECRUTAMENTO, NB_CANDIDATO, CS_SITUACAO, TX_MOTIVO_SITUACAO 
                        from ESTAGIARIO_SELECAO where ID_SELECAO_ESTAGIO = :new.ID_SELECAO_ESTAGIO) LOOP
                        
                          update ESTAGIARIO_VAGA set
                                  CS_SITUACAO = CURSOR1.CS_SITUACAO,
                                  TX_MOTIVO_SITUACAO = CURSOR1.TX_MOTIVO_SITUACAO
                          where ID_RECRUTAMENTO_ESTAGIO =  CURSOR1.ID_RECRUTAMENTO_ESTAGIO
                          and NB_VAGAS_RECRUTAMENTO = CURSOR1.NB_VAGAS_RECRUTAMENTO
                          and NB_CANDIDATO = CURSOR1.NB_CANDIDATO;
                        
                        end LOOP;
    end;
  else
    update ESTAGIARIO_VAGA set
                                  CS_SITUACAO = 1,
                                  TX_MOTIVO_SITUACAO = ''
                          where ID_RECRUTAMENTO_ESTAGIO =  :new.ID_RECRUTAMENTO_ESTAGIO;
  end if;
   
end; --
/
ALTER TRIGGER "SEMAD"."T_EST_U_SELECAO_ESTAGIO" DISABLE;
--------------------------------------------------------
--  DDL for Trigger T_GEST_I_D_V_ESTAGIARIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_GEST_I_D_V_ESTAGIARIO" 
  INSTEAD OF
  DELETE
    ON SEMAD.V_ESTAGIARIO REFERENCING OLD AS OLD NEW AS NEW DECLARE
    Pid_pessoa_estagiario estagiario.id_pessoa_estagiario%type;
  BEGIN
    Pid_pessoa_estagiario := :OLD.id_pessoa_estagiario;
    -- DELETE Estagiario
    DELETE
    FROM
      Estagiario
    WHERE
      id_pessoa_estagiario = Pid_pessoa_estagiario;
    -- DELETE TABLE Pessoa_Fisica
    --  DELETE FROM Pessoa_Fisica
    --  WHERE id_pessoa = Pid_pessoa_estagiario;
    -- DELETE TABLE Pessoa
    --  DELETE FROM Pessoa
    --  WHERE id_pessoa = Pid_pessoa_estagiario;
  END;
/
ALTER TRIGGER "SEMAD"."T_GEST_I_D_V_ESTAGIARIO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger T_GEST_I_I_V_ESTAGIARIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_GEST_I_I_V_ESTAGIARIO" INSTEAD OF
  INSERT
    ON SEMAD.V_ESTAGIARIO REFERENCING OLD AS OLD NEW AS NEW DECLARE BEGIN
  -- INSERT TABLE Pessoa
  INSERT
  INTO
    Pessoa
    (
      ID_Pessoa,
      tx_Nome,
      cs_Tipo_Pessoa
    )
    VALUES
    (
      :new.ID_PESSOA_ESTAGIARIO,
      :new.tx_Nome,
      :new.cs_Tipo_Pessoa
    );
  -- INSERT TABLE Pessoa_Fisica
  INSERT
  INTO
    Pessoa_Fisica
    (
      ID_Pessoa,
      nb_cpf,
      nb_rg,
      cs_sexo,
      dt_atualizacao,
      dt_nascimento
    )
    VALUES
    (
      :new.ID_PESSOA_ESTAGIARIO,
      :new.nb_cpf,
      :new.nb_rg,
      :new.cs_sexo,
      sysdate,
      :new.dt_nascimento
    );
  -- INSERT TABLE Estagiario
  INSERT
  INTO
    Estagiario
    (
      ID_PESSOA_ESTAGIARIO,
      ID_PESSOA_FUNCIONARIO,
      NB_FUNCIONARIO,
      TX_CEP,
      TX_ENDERECO,
      NB_NUMERO,
      TX_COMPLEMENTO,
      TX_BAIRRO,
      TX_AGENCIA,
      TX_CONTA_CORRENTE,
      TX_CONTATO,
      TX_EMAIL,
      NB_PCD
    )
    VALUES
    (
      :new.ID_PESSOA_ESTAGIARIO,
      :NEW.ID_PESSOA_FUNCIONARIO,
      :NEW.NB_FUNCIONARIO,
      :NEW.TX_CEP,
      :NEW.TX_ENDERECO,
      :NEW.NB_NUMERO,
      :NEW.TX_COMPLEMENTO,
      :NEW.TX_BAIRRO,
      :NEW.TX_AGENCIA,
      :NEW.TX_CONTA_CORRENTE,
      :NEW.TX_CONTATO,
      :NEW.TX_EMAIL,
      :NEW.NB_PCD
    );
END;
/
ALTER TRIGGER "SEMAD"."T_GEST_I_I_V_ESTAGIARIO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger T_GEST_I_U_V_ESTAGIARIO
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_GEST_I_U_V_ESTAGIARIO" 
  INSTEAD OF
  UPDATE
    ON SEMAD.V_ESTAGIARIO REFERENCING OLD AS OLD NEW AS NEW DECLARE
    Pid_pessoa_estagiario estagiario.id_pessoa_estagiario%type;
  BEGIN
    Pid_pessoa_estagiario := :OLD.id_pessoa_estagiario;
    -- UPDATE TABLE Pessoa
    UPDATE
      Pessoa
    SET
      tx_Nome = :NEW.tx_Nome
    WHERE
      ID_Pessoa = Pid_pessoa_estagiario;
    -- UPDATE TABLE Pessoa_Fisica
    UPDATE
      Pessoa_Fisica
    SET
      nb_cpf              = :NEW.nb_cpf,
      nb_rg               = :NEW.nb_rg,
      cs_sexo             = :NEW.cs_sexo,
      dt_atualizacao      = :NEW.dt_atualizacao,
      dt_nascimento       = :NEW.dt_nascimento
    WHERE
      ID_Pessoa = Pid_pessoa_estagiario;
    -- UPDATE TABLE Estagiario
    UPDATE
      Estagiario
    SET
      ID_PESSOA_FUNCIONARIO = :NEW.ID_PESSOA_FUNCIONARIO,
      NB_FUNCIONARIO        = :NEW.NB_FUNCIONARIO,
      TX_CEP                = :NEW.TX_CEP,
      TX_ENDERECO           = :NEW.TX_ENDERECO,
      NB_NUMERO             = :NEW.NB_NUMERO,
      TX_COMPLEMENTO        = :NEW.TX_COMPLEMENTO,
      TX_BAIRRO             = :NEW.TX_BAIRRO,
      TX_AGENCIA            = :NEW.TX_AGENCIA,
      TX_CONTA_CORRENTE     = :NEW.TX_CONTA_CORRENTE,
      TX_CONTATO            = :NEW.TX_CONTATO,
      TX_EMAIL              = :NEW.TX_EMAIL,
      NB_PCD                = :NEW.NB_PCD
    WHERE
      ID_PESSOA_ESTAGIARIO = PID_PESSOA_ESTAGIARIO;
  END;
/
ALTER TRIGGER "SEMAD"."T_GEST_I_U_V_ESTAGIARIO" ENABLE;
