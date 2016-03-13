--------------------------------------------------------
--  Arquivo criado - Sexta-feira-Março-21-2014   
--------------------------------------------------------
DROP TABLE "SEMAD"."ADITIVO_CONTRATO_CP" cascade constraints;
DROP TABLE "SEMAD"."CONTRATO_CP" cascade constraints;
DROP TABLE "SEMAD"."ORGAO_GESTOR_ESTAGIO" cascade constraints;
DROP TABLE "SEMAD"."USUARIO" cascade constraints;
DROP TABLE "SEMAD"."CAMPO" cascade constraints;
DROP TABLE "SEMAD"."TABELA" cascade constraints;
DROP TABLE "SEMAD"."VALOR_HISTORICO" cascade constraints;
--------------------------------------------------------
--  DDL for Table ADITIVO_CONTRATO_CP
--------------------------------------------------------

  CREATE TABLE "SEMAD"."ADITIVO_CONTRATO_CP" 
   (	"ID_ADITIVO_CONTRATO_CP" NUMBER(*,0), 
	"DT_CADASTRO" DATE, 
	"DT_ATUALIZACAO" DATE, 
	"NB_CODIGO" VARCHAR2(20 BYTE), 
	"DT_ADITIVO" DATE, 
	"TX_OBJETO" VARCHAR2(2000 BYTE), 
	"ID_CONTRATO_CP" NUMBER(*,0), 
	"ID_USUARIO_CADASTRO" NUMBER, 
	"ID_USUARIO_ATUALIZACAO" NUMBER, 
	"DT_INICIO_VIGENCIA" DATE, 
	"DT_FIM_VIGENCIA" DATE, 
	"NB_VALOR_ESTIMADO" NUMBER(12,2), 
	"ID_ORGAO_GESTOR_ESTAGIO" NUMBER(*,0), 
	"TX_TERMO_ADITIVO" VARCHAR2(80 BYTE), 
	"ID_AGENCIA_ESTAGIO" NUMBER(*,0)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
 

   COMMENT ON COLUMN "SEMAD"."ADITIVO_CONTRATO_CP"."ID_USUARIO_CADASTRO" IS 'Código do usuário do BD.';
 
   COMMENT ON COLUMN "SEMAD"."ADITIVO_CONTRATO_CP"."ID_USUARIO_ATUALIZACAO" IS 'Código do usuário do BD.';
--------------------------------------------------------
--  DDL for Table CONTRATO_CP
--------------------------------------------------------

  CREATE TABLE "SEMAD"."CONTRATO_CP" 
   (	"ID_CONTRATO_CP" NUMBER(*,0), 
	"NB_CODIGO" VARCHAR2(20 BYTE), 
	"DT_INICIO_VALIDADE" DATE, 
	"DT_FIM_VALIDADE" DATE, 
	"CS_TIPO_PRAZO" NUMBER(*,0), 
	"NB_PROC_ADMIN" VARCHAR2(50 BYTE), 
	"NB_VALOR_GLOBAL" NUMBER(12,2), 
	"TX_OBJETO" VARCHAR2(2000 BYTE), 
	"DT_CADASTRO" DATE, 
	"DT_ALTERACAO" DATE, 
	"NB_PRAZO" NUMBER(*,0), 
	"ID_UNID_GEST_RESP" NUMBER(*,0), 
	"ID_UNID_GEST_CADASTRO" NUMBER(*,0), 
	"ID_PESSOA_RESP" NUMBER(*,0), 
	"ID_PESSOA_CADASTRO" NUMBER(*,0), 
	"ID_UNID_GEST_ALTERACAO" NUMBER(*,0), 
	"ID_PESSOA_ALTERACAO" NUMBER(*,0), 
	"TX_OBSERVACAO" VARCHAR2(2000 BYTE), 
	"ID_UNIDADE_ORC" NUMBER, 
	"CS_TIPO_CONTRATO_CP" NUMBER, 
	"ID_MODALIDADE_CP" NUMBER, 
	"ID_PESSOA" NUMBER
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
 

   COMMENT ON COLUMN "SEMAD"."CONTRATO_CP"."ID_PESSOA_RESP" IS 'É o identificador único das pessoa físicas que são funcionários da PMM.';
 
   COMMENT ON COLUMN "SEMAD"."CONTRATO_CP"."ID_PESSOA_CADASTRO" IS 'É o identificador único das pessoa físicas que são funcionários da PMM.';
 
   COMMENT ON COLUMN "SEMAD"."CONTRATO_CP"."ID_PESSOA_ALTERACAO" IS 'É o identificador único das pessoa físicas que são funcionários da PMM.';
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."CONTRATO_CP" TO "GESTAOCONTASPUBLICAS";
 
  GRANT ALTER, DELETE, INDEX, INSERT, SELECT, UPDATE, REFERENCES, ON COMMIT REFRESH, QUERY REWRITE, DEBUG, FLASHBACK ON "SEMAD"."CONTRATO_CP" TO "THIAGOQUEIROZ";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."CONTRATO_CP" TO "GESTAOCONTASPUBLICAS_AGUA";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."CONTRATO_CP" TO "GESTAOCONTASPUBLICAS_ENERGIA";
 
  GRANT DELETE, INSERT, SELECT, UPDATE ON "SEMAD"."CONTRATO_CP" TO "GESTAOCONTASPUBLICAS_CONTRAT";
 
  GRANT SELECT ON "SEMAD"."CONTRATO_CP" TO "GESTAOCONTASPUBLICAS_CONS";
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
REM INSERTING into SEMAD.ADITIVO_CONTRATO_CP
SET DEFINE OFF;
Insert into SEMAD.ADITIVO_CONTRATO_CP (ID_ADITIVO_CONTRATO_CP,DT_CADASTRO,DT_ATUALIZACAO,NB_CODIGO,DT_ADITIVO,TX_OBJETO,ID_CONTRATO_CP,ID_USUARIO_CADASTRO,ID_USUARIO_ATUALIZACAO,DT_INICIO_VIGENCIA,DT_FIM_VIGENCIA,NB_VALOR_ESTIMADO,ID_ORGAO_GESTOR_ESTAGIO,TX_TERMO_ADITIVO,ID_AGENCIA_ESTAGIO) values ('14',to_date('26/07/13','DD/MM/RR'),to_date('26/07/13','DD/MM/RR'),'00002/2013',to_date('01/05/13','DD/MM/RR'),'Testando objeto!!!','322','143','143',to_date('02/05/13','DD/MM/RR'),to_date('31/07/13','DD/MM/RR'),'500','2','Testando termo aditivo','2');
--------------------------------------------------------
--  DDL for Index XPKADITIVO_CONTRATO_CP
--------------------------------------------------------

  CREATE UNIQUE INDEX "SEMAD"."XPKADITIVO_CONTRATO_CP" ON "SEMAD"."ADITIVO_CONTRATO_CP" ("ID_ADITIVO_CONTRATO_CP") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
--------------------------------------------------------
--  DDL for Index XIF1ADITIVO_CONTRATO_CP
--------------------------------------------------------

  CREATE INDEX "SEMAD"."XIF1ADITIVO_CONTRATO_CP" ON "SEMAD"."ADITIVO_CONTRATO_CP" ("ID_CONTRATO_CP") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
--------------------------------------------------------
--  DDL for Index XIF2ADITIVO_CONTRATO_CP
--------------------------------------------------------

  CREATE INDEX "SEMAD"."XIF2ADITIVO_CONTRATO_CP" ON "SEMAD"."ADITIVO_CONTRATO_CP" ("ID_USUARIO_CADASTRO") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
--------------------------------------------------------
--  DDL for Index XIF3ADITIVO_CONTRATO_CP
--------------------------------------------------------

  CREATE INDEX "SEMAD"."XIF3ADITIVO_CONTRATO_CP" ON "SEMAD"."ADITIVO_CONTRATO_CP" ("ID_USUARIO_ATUALIZACAO") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
--------------------------------------------------------
--  DDL for Index XIF4ADITIVO_CONTRATO_CP
--------------------------------------------------------

  CREATE INDEX "SEMAD"."XIF4ADITIVO_CONTRATO_CP" ON "SEMAD"."ADITIVO_CONTRATO_CP" ("ID_ORGAO_GESTOR_ESTAGIO") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA" ;
--------------------------------------------------------
--  Constraints for Table ADITIVO_CONTRATO_CP
--------------------------------------------------------

  ALTER TABLE "SEMAD"."ADITIVO_CONTRATO_CP" MODIFY ("ID_ADITIVO_CONTRATO_CP" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."ADITIVO_CONTRATO_CP" MODIFY ("DT_CADASTRO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."ADITIVO_CONTRATO_CP" MODIFY ("DT_ATUALIZACAO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."ADITIVO_CONTRATO_CP" MODIFY ("NB_CODIGO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."ADITIVO_CONTRATO_CP" MODIFY ("DT_ADITIVO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."ADITIVO_CONTRATO_CP" MODIFY ("ID_CONTRATO_CP" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."ADITIVO_CONTRATO_CP" MODIFY ("ID_USUARIO_CADASTRO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."ADITIVO_CONTRATO_CP" MODIFY ("ID_USUARIO_ATUALIZACAO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."ADITIVO_CONTRATO_CP" MODIFY ("ID_ORGAO_GESTOR_ESTAGIO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."ADITIVO_CONTRATO_CP" MODIFY ("TX_TERMO_ADITIVO" NOT NULL ENABLE);
 
  ALTER TABLE "SEMAD"."ADITIVO_CONTRATO_CP" ADD CONSTRAINT "XPKADITIVO_CONTRATO_CP" PRIMARY KEY ("ID_ADITIVO_CONTRATO_CP")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "PMM_DATA"  ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table ADITIVO_CONTRATO_CP
--------------------------------------------------------

  ALTER TABLE "SEMAD"."ADITIVO_CONTRATO_CP" ADD CONSTRAINT "R_3007" FOREIGN KEY ("ID_CONTRATO_CP")
	  REFERENCES "SEMAD"."CONTRATO_CP" ("ID_CONTRATO_CP") ENABLE;
 
  ALTER TABLE "SEMAD"."ADITIVO_CONTRATO_CP" ADD CONSTRAINT "R_3008" FOREIGN KEY ("ID_USUARIO_CADASTRO")
	  REFERENCES "SEMAD"."USUARIO" ("ID_USUARIO") ENABLE;
 
  ALTER TABLE "SEMAD"."ADITIVO_CONTRATO_CP" ADD CONSTRAINT "R_3009" FOREIGN KEY ("ID_USUARIO_ATUALIZACAO")
	  REFERENCES "SEMAD"."USUARIO" ("ID_USUARIO") ENABLE;
 
  ALTER TABLE "SEMAD"."ADITIVO_CONTRATO_CP" ADD CONSTRAINT "R_3026" FOREIGN KEY ("ID_ORGAO_GESTOR_ESTAGIO")
	  REFERENCES "SEMAD"."ORGAO_GESTOR_ESTAGIO" ("ID_ORGAO_GESTOR_ESTAGIO") ENABLE;
--------------------------------------------------------
--  DDL for Trigger T_AVS_IUD_ADITIVO_CONTRATO_CP
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "SEMAD"."T_AVS_IUD_ADITIVO_CONTRATO_CP" 
  AFTER
  INSERT OR DELETE OR UPDATE
  on SEMAD.Aditivo_Contrato_CP
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
  pID_Tabela := F_AVS_Busca_Tabela('ADITIVO_CONTRATO_CP');
  pnb_Transacao := F_AVS_Cadastra_Transacao(pID_Tabela,pID_usuario,pcs_evento );
  -- insere valor do campo ID_Aditivo_Contrato_CP --
  pnb_Campo := F_AVS_Busca_Campo('ID_ADITIVO_CONTRATO_CP',pID_Tabela,'INTEGER');
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
          :new.ID_Aditivo_Contrato_CP,
          :old.ID_Aditivo_Contrato_CP);

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

-- insere valor do campo nb_Codigo --
  pnb_Campo := F_AVS_Busca_Campo('NB_CODIGO',pID_Tabela,'VARCHAR2(20)');
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
          :new.nb_Codigo,
          :old.nb_Codigo);

-- insere valor do campo dt_Aditivo --
  pnb_Campo := F_AVS_Busca_Campo('DT_ADITIVO',pID_Tabela,'DATE');
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
          :new.dt_Aditivo,
          :old.dt_Aditivo);

-- insere valor do campo tx_Objeto --
  pnb_Campo := F_AVS_Busca_Campo('TX_OBJETO',pID_Tabela,'VARCHAR2(2000)');
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
          :new.tx_Objeto,
          :old.tx_Objeto);

-- insere valor do campo ID_Contrato_CP --
  pnb_Campo := F_AVS_Busca_Campo('ID_CONTRATO_CP',pID_Tabela,'INTEGER');
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
          :new.ID_Contrato_CP,
          :old.ID_Contrato_CP);

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

-- insere valor do campo nb_Valor_Estimado --
  pnb_Campo := F_AVS_Busca_Campo('NB_VALOR_ESTIMADO',pID_Tabela,'NUMBER(12,2)');
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
          :new.nb_Valor_Estimado,
          :old.nb_Valor_Estimado);

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
ALTER TRIGGER "SEMAD"."T_AVS_IUD_ADITIVO_CONTRATO_CP" ENABLE;
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
