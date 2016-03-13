--------------------------------------------------------
--  Arquivo criado - Quinta-feira-Março-10-2016   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Table AGENCIA_ESTAGIO
--------------------------------------------------------

  CREATE TABLE "SEMAD"."AGENCIA_ESTAGIO" 
   (	"ID_AGENCIA_ESTAGIO" NUMBER(*,0), 
	"TX_AGENCIA_ESTAGIO" VARCHAR2(255 BYTE), 
	"DT_CADASTRO" DATE, 
	"DT_ATUALIZACAO" DATE, 
	"TX_SIGLA" VARCHAR2(20 BYTE), 
	"TX_CNPJ" VARCHAR2(20 BYTE), 
	"ID_USUARIO_CADASTRO" NUMBER, 
	"ID_USUARIO_ATUALIZACAO" NUMBER, 
	"TX_EMAIL" VARCHAR2(100 BYTE), 
	"CS_SITUACAO" NUMBER(*,0)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 131072 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;

   COMMENT ON COLUMN "SEMAD"."AGENCIA_ESTAGIO"."ID_USUARIO_CADASTRO" IS 'Codigo do usuario do BD.';
   COMMENT ON COLUMN "SEMAD"."AGENCIA_ESTAGIO"."ID_USUARIO_ATUALIZACAO" IS 'Codigo do usuario do BD.';
--------------------------------------------------------
--  DDL for Index XPKAGENCIA_ESTAGIO
--------------------------------------------------------

  CREATE UNIQUE INDEX "SEMAD"."XPKAGENCIA_ESTAGIO" ON "SEMAD"."AGENCIA_ESTAGIO" ("ID_AGENCIA_ESTAGIO") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
--------------------------------------------------------
--  DDL for Index XIF1AGENCIA_ESTAGIO
--------------------------------------------------------

  CREATE INDEX "SEMAD"."XIF1AGENCIA_ESTAGIO" ON "SEMAD"."AGENCIA_ESTAGIO" ("ID_USUARIO_CADASTRO") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
--------------------------------------------------------
--  DDL for Index XIF2AGENCIA_ESTAGIO
--------------------------------------------------------

  CREATE INDEX "SEMAD"."XIF2AGENCIA_ESTAGIO" ON "SEMAD"."AGENCIA_ESTAGIO" ("ID_USUARIO_ATUALIZACAO") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
--------------------------------------------------------
--  Constraints for Table AGENCIA_ESTAGIO
--------------------------------------------------------

  ALTER TABLE "SEMAD"."AGENCIA_ESTAGIO" ADD PRIMARY KEY ("ID_AGENCIA_ESTAGIO")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA"  ENABLE;
  ALTER TABLE "SEMAD"."AGENCIA_ESTAGIO" MODIFY ("ID_USUARIO_ATUALIZACAO" NOT NULL ENABLE);
  ALTER TABLE "SEMAD"."AGENCIA_ESTAGIO" MODIFY ("ID_USUARIO_CADASTRO" NOT NULL ENABLE);
  ALTER TABLE "SEMAD"."AGENCIA_ESTAGIO" MODIFY ("TX_CNPJ" NOT NULL ENABLE);
  ALTER TABLE "SEMAD"."AGENCIA_ESTAGIO" MODIFY ("TX_SIGLA" NOT NULL ENABLE);
  ALTER TABLE "SEMAD"."AGENCIA_ESTAGIO" MODIFY ("DT_ATUALIZACAO" NOT NULL ENABLE);
  ALTER TABLE "SEMAD"."AGENCIA_ESTAGIO" MODIFY ("DT_CADASTRO" NOT NULL ENABLE);
  ALTER TABLE "SEMAD"."AGENCIA_ESTAGIO" MODIFY ("TX_AGENCIA_ESTAGIO" NOT NULL ENABLE);
  ALTER TABLE "SEMAD"."AGENCIA_ESTAGIO" MODIFY ("ID_AGENCIA_ESTAGIO" NOT NULL ENABLE);
--------------------------------------------------------
--  Ref Constraints for Table AGENCIA_ESTAGIO
--------------------------------------------------------

  ALTER TABLE "SEMAD"."AGENCIA_ESTAGIO" ADD FOREIGN KEY ("ID_USUARIO_ATUALIZACAO")
	  REFERENCES "SEMAD"."USUARIO" ("ID_USUARIO") ENABLE;
  ALTER TABLE "SEMAD"."AGENCIA_ESTAGIO" ADD FOREIGN KEY ("ID_USUARIO_CADASTRO")
	  REFERENCES "SEMAD"."USUARIO" ("ID_USUARIO") ENABLE;
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
