--------------------------------------------------------
--  Arquivo criado - Sexta-feira-Março-21-2014   
--------------------------------------------------------
DROP TABLE "SEMAD"."PAGAMENTO_ESTAGIO" cascade constraints;
DROP TABLE "SEMAD"."AGENCIA_ESTAGIO" cascade constraints;
DROP TABLE "SEMAD"."ORGAO_ESTAGIO" cascade constraints;
DROP TABLE "SEMAD"."ORGAO_GESTOR_ESTAGIO" cascade constraints;
DROP TABLE "SEMAD"."TIPO_PAG_ESTAGIO" cascade constraints;
DROP TABLE "SEMAD"."USUARIO" cascade constraints;
DROP TABLE "SEMAD"."CAMPO" cascade constraints;
DROP TABLE "SEMAD"."TABELA" cascade constraints;
DROP TABLE "SEMAD"."VALOR_HISTORICO" cascade constraints;
--------------------------------------------------------
--  DDL for Table PAGAMENTO_ESTAGIO
--------------------------------------------------------

  CREATE TABLE "SEMAD"."PAGAMENTO_ESTAGIO" 
   (	"ID_PAGAMENTO_ESTAGIO" NUMBER(*,0), 
	"DT_CADASTRO" DATE, 
	"DT_ATUALIZACAO" DATE, 
	"NB_ANO" NUMBER(*,0), 
	"NB_MES" NUMBER(*,0), 
	"CS_SITUACAO" NUMBER(*,0), 
	"NB_DIAS_UTEIS" NUMBER(*,0), 
	"ID_ORGAO_ESTAGIO" NUMBER(*,0), 
	"ID_ORGAO_GESTOR_ESTAGIO" NUMBER(*,0), 
	"ID_AGENCIA_ESTAGIO" NUMBER(*,0), 
	"ID_USUARIO_CADASTRO" NUMBER, 
	"ID_USUARIO_ATUALIZACAO" NUMBER, 
	"CS_TIPO_PAG_ESTAGIO" NUMBER(*,0), 
	"DT_INICIO_COMPETENCIA" DATE, 
	"DT_FIM_COMPETENCIA" DATE, 
	"DT_INICIO_FREQUENCIA" DATE, 
	"DT_FIM_FREQUENCIA" DATE
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
 

   COMMENT ON COLUMN "SEMAD"."PAGAMENTO_ESTAGIO"."CS_SITUACAO" IS '1 - Aberto
2 - Fechado
3 - Cancelado';
 
   COMMENT ON COLUMN "SEMAD"."PAGAMENTO_ESTAGIO"."ID_USUARIO_CADASTRO" IS 'Código do usuário do BD.';
 
   COMMENT ON COLUMN "SEMAD"."PAGAMENTO_ESTAGIO"."ID_USUARIO_ATUALIZACAO" IS 'Código do usuário do BD.';
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
	"TX_EMAIL" VARCHAR2(100 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
 

   COMMENT ON COLUMN "SEMAD"."AGENCIA_ESTAGIO"."ID_USUARIO_CADASTRO" IS 'Código do usuário do BD.';
 
   COMMENT ON COLUMN "SEMAD"."AGENCIA_ESTAGIO"."ID_USUARIO_ATUALIZACAO" IS 'Código do usuário do BD.';
--------------------------------------------------------
--  DDL for Table ORGAO_ESTAGIO
--------------------------------------------------------

  CREATE TABLE "SEMAD"."ORGAO_ESTAGIO" 
   (	"ID_ORGAO_ESTAGIO" NUMBER(*,0), 
	"TX_ORGAO_ESTAGIO" VARCHAR2(255 BYTE), 
	"DT_CADASTRO" DATE, 
	"DT_ATUALIZACAO" DATE, 
	"ID_UNIDADE_ORG" NUMBER(*,0), 
	"ID_USUARIO_CADASTRO" NUMBER, 
	"ID_USUARIO_ATUALIZACAO" NUMBER, 
	"CS_STATUS" NUMBER, 
	"TX_CNPJ" VARCHAR2(20 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
 

   COMMENT ON COLUMN "SEMAD"."ORGAO_ESTAGIO"."ID_UNIDADE_ORG" IS 'Identificador único de uma unidade organizacional.';
 
   COMMENT ON COLUMN "SEMAD"."ORGAO_ESTAGIO"."ID_USUARIO_CADASTRO" IS 'Código do usuário do BD.';
 
   COMMENT ON COLUMN "SEMAD"."ORGAO_ESTAGIO"."ID_USUARIO_ATUALIZACAO" IS 'Código do usuário do BD.';
 
   COMMENT ON COLUMN "SEMAD"."ORGAO_ESTAGIO"."CS_STATUS" IS '1 - Ativado
2 - Desativado';
--------------------------------------------------------
--  DDL for Table ORGAO_GESTOR_ESTAGIO
--------------------------------------------------------

  CREATE TABLE "SEMAD"."ORGAO_GESTOR_ESTAGIO" 
   (	"ID_ORGAO_GESTOR_ESTAGIO" NUMBER(*,0), 
	"TX_ORGAO_GESTOR_ESTAGIO" VARCHAR2(255 BYTE), 
	"DT_CADASTRO" DATE, 
	"DT_ATUALIZACAO" DATE, 
	"ID_UNIDADE_ORG" NUMBER(*,0), 
	"TX_CNPJ" VARCHAR2(20 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
 

   COMMENT ON COLUMN "SEMAD"."ORGAO_GESTOR_ESTAGIO"."ID_UNIDADE_ORG" IS 'Identificador único de uma unidade organizacional.';
--------------------------------------------------------
--  DDL for Table TIPO_PAG_ESTAGIO
--------------------------------------------------------

  CREATE TABLE "SEMAD"."TIPO_PAG_ESTAGIO" 
   (	"CS_TIPO_PAG_ESTAGIO" NUMBER(*,0), 
	"TX_TIPO_PAG_ESTAGIO" VARCHAR2(255 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
--------------------------------------------------------
--  DDL for Table USUARIO
--------------------------------------------------------

  CREATE TABLE "SEMAD"."USUARIO" 
   (	"ID_USUARIO" NUMBER(5,0), 
	"TX_LOGIN" VARCHAR2(20 BYTE), 
	"CS_SITUACAO" NUMBER DEFAULT 0, 
	"TX_CONFIGURACAO" LONG, 
	"ID_PESSOA_FUNCIONARIO" NUMBER, 
	"TX_MOTIVO_SITUACAO" VARCHAR2(200 BYTE), 
	"ID_UNIDADE_GESTORA" NUMBER, 
	"DT_ULTIMO_ACESSO" DATE, 
	"TX_IP_ULTIMO_ACESSO" VARCHAR2(15 BYTE), 
	"TX_EMAIL_PMM" VARCHAR2(255 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 131072 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SCA_DATA" ;
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "BANCOPRECO";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "BP_FINALIZADORES";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "AUDITORIA";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "XPTO_CONNECT";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "ADMINISTRADORES";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "LICITAC?O";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "ESTOQUE";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "Q_BANCO_PRECOS";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "BP_CADASTRO";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "PROT_SEMSA";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "PROT_LICITACAO";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "BP_CONSULTA";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "APLICAR_PESSOAS";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "PROT_CONSULTORES";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "PROT_TRAMITE";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "CONTAS_PUBLICAS";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "BP_MATERIAL";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "WORKFLOW";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "PROT_CONS_EXT";
 
  GRANT ALTER, DELETE, INSERT, SELECT, UPDATE, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "PATRIMONIO";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "COLETORDEPONTO";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "PROT_TRAM_SEMSA";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "PONTO_ELETRONICO";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "PROT_IMPLURB";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "PROT_CONS_IMPL";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "PROT_TRAM_IMPL";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "WOKF_EXTERNO";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "ESTOQUE_CONSULTA";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "PROT_CML";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "PRE_CADASTRO";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "PONTO_SEMEF";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "ESTOQUE_KITS";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "REGISTROPRECOS";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "USUARIO_ADMIN";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "ESTOQUE_ADMIN";
 
  GRANT ALTER, DELETE, INSERT, SELECT, UPDATE, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "GESTAOCONTASPUBLICAS";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "GESTAOESCOLAR";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "EST_OPERADOR";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "EST_ATENDENTE";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "EST_AUTORIZACAO";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "EST_GESTOR";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "GE_OPERADOR";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "R_BANCOPRECOS";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "EST_RECEBIMENTO";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "GE_GESTOR";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "SEMAD_LNK";
 
  GRANT ALTER, DELETE, INDEX, INSERT, SELECT, UPDATE, REFERENCES, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "THIAGO";
 
  GRANT ALTER, DELETE, INDEX, INSERT, SELECT, UPDATE, REFERENCES, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "VALERIA";
 
  GRANT ALTER, DELETE, INDEX, INSERT, SELECT, UPDATE, REFERENCES, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "ROSANA";
 
  GRANT ALTER, DELETE, INDEX, INSERT, SELECT, UPDATE, REFERENCES, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "TACIANA";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "MAYCON";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "JUSSARA";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "VALDERI";
 
  GRANT ALTER, DELETE, INDEX, INSERT, SELECT, UPDATE, REFERENCES, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "SARYTA_GARCEZ";
 
  GRANT ALTER, DELETE, INDEX, INSERT, SELECT, UPDATE, REFERENCES, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "IWAMOTO";
 
  GRANT ALTER, DELETE, INDEX, INSERT, SELECT, UPDATE, REFERENCES, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "BERNARDO";
 
  GRANT ALTER, DELETE, INDEX, INSERT, SELECT, UPDATE, REFERENCES, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "ANDRE_PINHEIRO";
 
  GRANT ALTER, DELETE, INDEX, INSERT, SELECT, UPDATE, REFERENCES, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "IVY_SA";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "VOYAGE_SOLICITANTE";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "VOYAGE_GESTOR";
 
  GRANT ALTER, DELETE, INSERT, SELECT, UPDATE, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "EST_RM";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "VOYAGE_GESTOR_PASSAGEM";
 
  GRANT ALTER, DELETE, INDEX, INSERT, SELECT, UPDATE, REFERENCES, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "ROBSON";
 
  GRANT ALTER, DELETE, INDEX, INSERT, SELECT, UPDATE, REFERENCES, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "NEILA_SEMAD";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "JURIDICO";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "PGM";
 
  GRANT ALTER, DELETE, INDEX, INSERT, SELECT, UPDATE, REFERENCES, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "KEYCE_MARQUES";
 
  GRANT ALTER, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "JURIDICO_CONSULTA";
 
  GRANT ALTER, SELECT, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "JURIDICO_OPERACIONAL";
 
  GRANT ALTER, SELECT, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "JURIDICO_GESTORAUXILIAR";
 
  GRANT ALTER, SELECT, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "JURIDICO_GESTOR";
 
  GRANT ALTER, SELECT, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "JURIDICO_OPERACIONALTCE";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "EST_ALMOXPEQUENOS";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "HABITACAO_CADASTRO";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "PATRIMONIO_IMOVEL";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "PATRIMONIO_IMOVEL_REL";
 
  GRANT ALTER, DELETE, INSERT, SELECT, UPDATE, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "PATRIMONIO_MOVEL_CAD";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "PATRIMONIO_MOVEL_REL";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "GESTAOCONTASPUBLICAS_CEL";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "GESTAOCONTASPUBLICAS_TEL";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "GESTAOCONTASPUBLICAS_AGUA";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "GESTAOCONTASPUBLICAS_ENERGIA";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "GESTAOESCOLAR_CONSULTA";
 
  GRANT ALTER, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "JUR_DISTRIBUICAO";
 
  GRANT ALTER, DELETE, INDEX, INSERT, SELECT, UPDATE, REFERENCES, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "EMANUELLE_ALVES";
 
  GRANT ALTER, DELETE, INDEX, INSERT, SELECT, UPDATE, REFERENCES, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "JAMILE_BREVAL";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "PATRIMONIO_MOVEL_MOV_IND";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "PATRIMONIO_CONS";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "VOYAGE_CONS";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "GESTAOCONTASPUBLICAS_CONS";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "IRP";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "TESTES";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "PONTOELETRONICOV2_RH";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "EST_CONTABIL";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "IRP_GESTOR_RP";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "IRP_GESTOR_BP";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "IRP_GESTOR_CATALOGACAO";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."USUARIO" TO "IRP_SOLICITANTE";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "EST_INVENTARIO";
 
  GRANT SELECT ON "SEMAD"."USUARIO" TO "HABITACAO";
 
  GRANT ALTER, DELETE, INSERT, SELECT, UPDATE, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."USUARIO" TO "PATRIMONIO_MOVEL_MOVI";
--------------------------------------------------------
--  DDL for Table CAMPO
--------------------------------------------------------

  CREATE TABLE "SEMAD"."CAMPO" 
   (	"NB_CAMPO" NUMBER, 
	"ID_TABELA" NUMBER, 
	"TX_CAMPO" VARCHAR2(80 BYTE), 
	"CS_TIPO_CAMPO" NUMBER, 
	"TX_TITULO" VARCHAR2(80 BYTE), 
	"TX_DESCRICAO" VARCHAR2(80 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 10 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 131072 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
  GRANT SELECT ON "SEMAD"."CAMPO" TO "AUDITORIA";
 
  GRANT SELECT ON "SEMAD"."CAMPO" TO "USUARIO_ADMIN";
 
  GRANT SELECT ON "SEMAD"."CAMPO" TO "SEMAD_LNK";
--------------------------------------------------------
--  DDL for Table TABELA
--------------------------------------------------------

  CREATE TABLE "SEMAD"."TABELA" 
   (	"TX_NOME" VARCHAR2(80 BYTE), 
	"ID_TABELA" NUMBER, 
	"ID_SERVIDOR" NUMBER, 
	"CS_ATUALIZACAO" NUMBER
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 10 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
  GRANT SELECT ON "SEMAD"."TABELA" TO "AUDITORIA";
 
  GRANT SELECT ON "SEMAD"."TABELA" TO "USUARIO_ADMIN";
 
  GRANT SELECT ON "SEMAD"."TABELA" TO "SEMAD_LNK";
-- Não é possível renderizar a DLL TABLE para o objeto SEMAD.VALOR_HISTORICO com o DBMS_METADATA tentando um gerador interno.
ALTER TABLE SEMAD.VALOR_HISTORICO
ADD CONSTRAINT IDX_FK1_VALOR_HISTORICO FOREIGN KEY
(
  ID_USUARIO 
, NB_TRANSACAO_HISTORICO 
, ID_TABELA 
)
REFERENCES SEMAD.TRANSACAO_HISTORICO
(
  ID_USUARIO 
, NB_TRANSACAO_HISTORICO 
, ID_TABELA 
)
ENABLE
ALTER TABLE SEMAD.VALOR_HISTORICO
ADD CONSTRAINT IDX_FK2_VALOR_HISTORICO FOREIGN KEY
(
  ID_TABELA 
, NB_CAMPO 
)
REFERENCES SEMAD.CAMPO
(
  ID_TABELA 
, NB_CAMPO 
)
ENABLECREATE TABLE SEMAD.VALOR_HISTORICO 
(
  ID_TABELA NUMBER NOT NULL 
, NB_TRANSACAO_HISTORICO NUMBER NOT NULL 
, NB_CAMPO NUMBER NOT NULL 
, ID_USUARIO NUMBER NOT NULL 
, NB_VALOR_HISTORICO NUMBER NOT NULL 
, NB_VALOR_VARCHAR2000 VARCHAR2(4000 BYTE) 
, NB_OLD_VARCHAR2000 VARCHAR2(4000 BYTE) 
, NB_OLD_LONG_RAW BLOB 
, CONSTRAINT IDX_PK_VALOR_HISTORICO PRIMARY KEY 
  (
    NB_CAMPO 
  , ID_TABELA 
  , ID_USUARIO 
  , NB_TRANSACAO_HISTORICO 
  , NB_VALOR_HISTORICO 
  )
  ENABLE 
) 
LOGGING 
TABLESPACE "PMM_DATA" 
PCTFREE 10 
INITRANS 10 
STORAGE 
( 
  INITIAL 1109393408 
  NEXT 1048576 
  MINEXTENTS 1 
  MAXEXTENTS 2147483645 
  BUFFER_POOL DEFAULT 
) 
LOB (NB_OLD_LONG_RAW) STORE AS SYS_LOB0000098230C00008$$ 
( 
  ENABLE STORAGE IN ROW 
  CHUNK 8192 
  PCTVERSION 10 
  NOCACHE 
  LOGGING  
)CREATE INDEX SEMAD.IDX_FK3_VALOR_HISTORICO ON SEMAD.VALOR_HISTORICO (ID_TABELA ASC) 
LOGGING 
TABLESPACE "PMM_INDEX" 
PCTFREE 10 
INITRANS 2 
STORAGE 
( 
  INITIAL 570425344 
  NEXT 1048576 
  MINEXTENTS 1 
  MAXEXTENTS 2147483645 
  BUFFER_POOL DEFAULT 
)
CREATE INDEX SEMAD.IDX_FK5_VALOR_HISTORICO ON SEMAD.VALOR_HISTORICO (ID_TABELA ASC, NB_TRANSACAO_HISTORICO ASC, NB_CAMPO ASC, ID_USUARIO ASC) 
LOGGING 
TABLESPACE "PMM_INDEX" 
PCTFREE 10 
INITRANS 2 
STORAGE 
( 
  INITIAL 995098624 
  NEXT 1048576 
  MINEXTENTS 1 
  MAXEXTENTS 2147483645 
  BUFFER_POOL DEFAULT 
)
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."VALOR_HISTORICO" TO "AUDITORIA";
 
  GRANT SELECT ON "SEMAD"."VALOR_HISTORICO" TO "USUARIO_ADMIN";
 
  GRANT SELECT ON "SEMAD"."VALOR_HISTORICO" TO "SEMAD_LNK";
REM INSERTING into SEMAD.PAGAMENTO_ESTAGIO
SET DEFINE OFF;
--------------------------------------------------------
--  DDL for Index XPKPAGAMENTO_ESTAGIO
--------------------------------------------------------

  CREATE UNIQUE INDEX "SEMAD"."XPKPAGAMENTO_ESTAGIO" ON "SEMAD"."PAGAMENTO_ESTAGIO" ("ID_PAGAMENTO_ESTAGIO") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
--------------------------------------------------------
--  DDL for Index XIF1PAGAMENTO_ESTAGIO
--------------------------------------------------------

  CREATE INDEX "SEMAD"."XIF1PAGAMENTO_ESTAGIO" ON "SEMAD"."PAGAMENTO_ESTAGIO" ("ID_ORGAO_ESTAGIO") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
--------------------------------------------------------
--  DDL for Index XIF2PAGAMENTO_ESTAGIO
--------------------------------------------------------

  CREATE INDEX "SEMAD"."XIF2PAGAMENTO_ESTAGIO" ON "SEMAD"."PAGAMENTO_ESTAGIO" ("ID_ORGAO_GESTOR_ESTAGIO") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
--------------------------------------------------------
--  DDL for Index XIF3PAGAMENTO_ESTAGIO
--------------------------------------------------------

  CREATE INDEX "SEMAD"."XIF3PAGAMENTO_ESTAGIO" ON "SEMAD"."PAGAMENTO_ESTAGIO" ("ID_AGENCIA_ESTAGIO") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
--------------------------------------------------------
--  DDL for Index XIF4PAGAMENTO_ESTAGIO
--------------------------------------------------------

  CREATE INDEX "SEMAD"."XIF4PAGAMENTO_ESTAGIO" ON "SEMAD"."PAGAMENTO_ESTAGIO" ("ID_USUARIO_CADASTRO") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
--------------------------------------------------------
--  DDL for Index XIF5PAGAMENTO_ESTAGIO
--------------------------------------------------------

  CREATE INDEX "SEMAD"."XIF5PAGAMENTO_ESTAGIO" ON "SEMAD"."PAGAMENTO_ESTAGIO" ("ID_USUARIO_ATUALIZACAO") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
--------------------------------------------------------
--  DDL for Index XIF6PAGAMENTO_ESTAGIO
--------------------------------------------------------

  CREATE INDEX "SEMAD"."XIF6PAGAMENTO_ESTAGIO" ON "SEMAD"."PAGAMENTO_ESTAGIO" ("CS_TIPO_PAG_ESTAGIO") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
--------------------------------------------------------
--  Constraints for Table PAGAMENTO_ESTAGIO
--------------------------------------------------------

  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("ID_PAGAMENTO_ESTAGIO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("DT_CADASTRO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("DT_ATUALIZACAO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("NB_ANO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("NB_MES" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("CS_SITUACAO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("NB_DIAS_UTEIS" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("ID_ORGAO_ESTAGIO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("ID_ORGAO_GESTOR_ESTAGIO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("ID_AGENCIA_ESTAGIO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("ID_USUARIO_CADASTRO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("ID_USUARIO_ATUALIZACAO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("CS_TIPO_PAG_ESTAGIO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("DT_INICIO_COMPETENCIA" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("DT_FIM_COMPETENCIA" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("DT_INICIO_FREQUENCIA" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" MODIFY ("DT_FIM_FREQUENCIA" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" ADD PRIMARY KEY ("ID_PAGAMENTO_ESTAGIO")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA"  ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table PAGAMENTO_ESTAGIO
--------------------------------------------------------

  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" ADD FOREIGN KEY ("CS_TIPO_PAG_ESTAGIO")
	  REFERENCES "SEMAD"."TIPO_PAG_ESTAGIO" ("CS_TIPO_PAG_ESTAGIO") ENABLE;
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" ADD FOREIGN KEY ("ID_USUARIO_ATUALIZACAO")
	  REFERENCES "SEMAD"."USUARIO" ("ID_USUARIO") ENABLE;
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" ADD FOREIGN KEY ("ID_USUARIO_CADASTRO")
	  REFERENCES "SEMAD"."USUARIO" ("ID_USUARIO") ENABLE;
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" ADD FOREIGN KEY ("ID_AGENCIA_ESTAGIO")
	  REFERENCES "SEMAD"."AGENCIA_ESTAGIO" ("ID_AGENCIA_ESTAGIO") ENABLE;
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" ADD FOREIGN KEY ("ID_ORGAO_GESTOR_ESTAGIO")
	  REFERENCES "SEMAD"."ORGAO_GESTOR_ESTAGIO" ("ID_ORGAO_GESTOR_ESTAGIO") ENABLE;
 
  ALTER TABLE "SEMAD"."PAGAMENTO_ESTAGIO" ADD FOREIGN KEY ("ID_ORGAO_ESTAGIO")
	  REFERENCES "SEMAD"."ORGAO_ESTAGIO" ("ID_ORGAO_ESTAGIO") ENABLE;
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
--  DDL for Function F_AVS_BUSCA_CAMPO
--------------------------------------------------------

  CREATE OR REPLACE FUNCTION "SEMAD"."F_AVS_BUSCA_CAMPO" 
  (ptx_campo IN campo.tx_campo%type,
   pid_tabela IN tabela.id_tabela%type,
   ptx_tipo_campo IN tipo_campo.tx_tipo_campo%type)
RETURN  campo.nb_campo%type IS pnb_campo campo.nb_campo%type;

   pid_servidor   number;
   numregs        number;
   pcs_tipo_campo number;
BEGIN
    pnb_campo := 0;
    numregs := 0;
    
    select max(nb_campo) into numregs
    from campo
    where tx_campo = ptx_campo and
          id_tabela = pid_tabela;
     
    if numregs > 0 then
      select nb_campo into pnb_campo
      from campo
      where tx_campo = ptx_campo and
            id_tabela = pid_tabela;
    else
      select max(id_servidor) into pid_servidor
      from parametros_default;
      pcs_tipo_campo := F_Busca_Tipo_Campo(ptx_tipo_campo,pid_servidor);
      pnb_campo := F_G_PK_campo(pid_tabela);
      insert into campo (id_tabela, nb_campo, tx_campo,cs_tipo_campo)
             values (pid_tabela, pnb_campo, ptx_campo,pcs_tipo_campo);
    end if;

    RETURN pnb_campo;
END;


-- End of DDL script for F_AVS_BUSCA_CAMPO

/
--------------------------------------------------------
--  DDL for Function F_AVS_BUSCA_TABELA
--------------------------------------------------------

  CREATE OR REPLACE FUNCTION "SEMAD"."F_AVS_BUSCA_TABELA" 
  (ptx_tabela IN Tabela.tx_nome%type)
RETURN  Tabela.ID_Tabela%type IS Pid_Tabela Tabela.ID_Tabela%type;
   pid_servidor number;
   numregs number;
BEGIN
    numregs := 0;
    select count(id_tabela) into numregs
    from tabela
    where tx_nome = ptx_tabela;
    if numregs <> 0 then
       select id_tabela into Pid_Tabela
       from tabela
       where tx_nome = ptx_tabela;
    else
      pid_tabela := F_G_PK_Tabela();
      select max(id_servidor) into pid_servidor
           from parametros_default;
      insert into tabela (id_tabela, tx_nome, id_servidor, cs_atualizacao)
             values (pid_tabela, ptx_tabela, pid_servidor,2);
    end if;
    RETURN Pid_Tabela;
END;


-- End of DDL script for F_AVS_BUSCA_TABELA

/
--------------------------------------------------------
--  DDL for Function F_AVS_CADASTRA_TRANSACAO
--------------------------------------------------------

  CREATE OR REPLACE FUNCTION "SEMAD"."F_AVS_CADASTRA_TRANSACAO" 
  ( pID_Tabela IN Tabela.ID_Tabela%type,
    pID_Usuario IN Usuario.ID_Usuario%type,
    pcs_evento IN number)
  RETURN  number IS pnb_Transacao number;
BEGIN
  pnb_transacao := F_G_PK_transacao_historico(pid_usuario,pid_tabela);
  insert into transacao_historico (id_tabela, id_usuario, nb_transacao_historico, dt_transacao_historico, cs_evento)
  values (pid_tabela, pid_usuario, pnb_transacao, sysdate, pcs_evento);
  RETURN pnb_transacao;
END; -- F_AVS_CADASTRA_TRANSACAO

-- End of DDL script for F_AVS_CADASTRA_TRANSACAO

/
--------------------------------------------------------
--  DDL for Function F_G_PK_VALOR_HISTORICO
--------------------------------------------------------

  CREATE OR REPLACE FUNCTION "SEMAD"."F_G_PK_VALOR_HISTORICO" 
(PID_TABELA NUMBER,PNB_TRANSACAO_HISTORICO NUMBER,PNB_CAMPO NUMBER,PID_USUARIO NUMBER)
RETURN NUMBER IS V_N_VALOR_HISTORICO NUMBER;
BEGIN
   SELECT COUNT (*) INTO  V_N_VALOR_HISTORICO
   FROM VALOR_HISTORICO
   WHERE(ID_TABELA = PID_TABELA AND NB_TRANSACAO_HISTORICO = PNB_TRANSACAO_HISTORICO AND NB_CAMPO = PNB_CAMPO AND ID_USUARIO = PID_USUARIO );
    IF V_N_VALOR_HISTORICO = 0 THEN
        V_N_VALOR_HISTORICO := 1;
    ELSE
        SELECT MAX(NB_VALOR_HISTORICO) + 1
        INTO V_N_VALOR_HISTORICO
        FROM VALOR_HISTORICO
        WHERE (ID_TABELA = PID_TABELA AND NB_TRANSACAO_HISTORICO = PNB_TRANSACAO_HISTORICO AND NB_CAMPO = PNB_CAMPO AND ID_USUARIO = PID_USUARIO );
     END IF;
     RETURN V_N_VALOR_HISTORICO;
END; -- F_G_PK_VALOR_HISTORICO

/
