<changeSet author="Rodrigo Cabral" id="1">
<createTable tableName="ORGAO_GESTOR_ESTAGIO">
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_ORGAO_GESTOR_ESTAGIO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="ID_UNIDADE_ORG" type="BIGINT" remarks="Identificador unico de uma unidade organizacional.">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CNPJ" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="2">
<addPrimaryKey tableName="ORGAO_GESTOR_ESTAGIO" constraintName="ORGAO_GESTOR_ESTAGIO_pk" columnNames="ID_ORGAO_GESTOR_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="3">
<createIndex tableName="ORGAO_GESTOR_ESTAGIO" indexName="XPKORGAO_GESTOR_ESTAGIO" unique="true">
  <column name="ID_ORGAO_GESTOR_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="4">
<createIndex tableName="ORGAO_GESTOR_ESTAGIO" indexName="XIF1ORGAO_GESTOR_ESTAGIO">
  <column name="ID_UNIDADE_ORG"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="5">
<createTable tableName="VAGAS_SOLICITACAO">
  <column name="ID_SOLICITACAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_QUADRO_VAGAS_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="CS_TIPO_VAGA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_QUANTIDADE" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_CURSO_ESTAGIO" type="BIGINT"/>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="6">
<createIndex tableName="VAGAS_SOLICITACAO" indexName="XIF1VAGAS_SOLICITACAO">
  <column name="ID_SOLICITACAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="7">
<createIndex tableName="VAGAS_SOLICITACAO" indexName="XIF2VAGAS_SOLICITACAO">
  <column name="ID_QUADRO_VAGAS_ESTAGIO"/>
  <column name="ID_ORGAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="8">
<createIndex tableName="VAGAS_SOLICITACAO" indexName="XIF3VAGAS_SOLICITACAO">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="9">
<createIndex tableName="VAGAS_SOLICITACAO" indexName="XIF4VAGAS_SOLICITACAO">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="10">
<createTable tableName="VAGAS_RECRUTAMENTO">
  <column name="ID_RECRUTAMENTO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_VAGAS_RECRUTAMENTO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_QUADRO_VAGAS_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_QUANTIDADE" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="CS_TIPO_VAGA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="11">
<createIndex tableName="VAGAS_RECRUTAMENTO" indexName="XIF1VAGAS_RECRUTAMENTO">
  <column name="ID_RECRUTAMENTO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="12">
<createIndex tableName="VAGAS_RECRUTAMENTO" indexName="XIF2VAGAS_RECRUTAMENTO">
  <column name="ID_QUADRO_VAGAS_ESTAGIO"/>
  <column name="ID_ORGAO_ESTAGIO"/>
  <column name="CS_TIPO_VAGA_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="13">
<createTable tableName="USUARIO">
  <column name="ID_USUARIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_LOGIN" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="CS_SITUACAO" type="BIGINT" defaultValueNumeric="0  ">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CONFIGURACAO" type="LONGVARCHAR(0)"/>
  <column name="ID_PESSOA_FUNCIONARIO" type="BIGINT"/>
  <column name="TX_MOTIVO_SITUACAO" type="VARCHAR(200)"/>
  <column name="ID_UNIDADE_GESTORA" type="BIGINT"/>
  <column name="DT_ULTIMO_ACESSO" type="DATE"/>
  <column name="TX_IP_ULTIMO_ACESSO" type="VARCHAR(15)"/>
  <column name="TX_EMAIL_PMM" type="VARCHAR(255)"/>
  <column name="TX_PASSWORD" type="VARCHAR(255)"/>
  <column name="TX_TOKEN" type="VARCHAR(255)"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="14">
<addPrimaryKey tableName="USUARIO" constraintName="IDX_PK_USUARIO" columnNames="ID_USUARIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="15">
<createIndex tableName="USUARIO" indexName="IDX_UK1_USUARIO" unique="true">
  <column name="TX_LOGIN"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="16">
<createTable tableName="UNIDADE_ORG" remarks="Representa as unidades operacionais da PMM. (org?os, departamentos, coordenadorias, assessorias, divis?es, sec?es, etc..)">
  <column name="ID_UNIDADE_ORG" type="BIGINT" remarks="Identificador unico de uma unidade organizacional.">
    <constraints nullable="false"/>
  </column>
  <column name="TX_UNIDADE_ORG" type="VARCHAR(120)" remarks="Denominac?o da unidade organizacional.">
    <constraints nullable="false"/>
  </column>
  <column name="TX_SIGLA_UNIDADE" type="VARCHAR(30)" remarks="Sigla da unidade organizacional.">
    <constraints nullable="false"/>
  </column>
  <column name="CS_TIPO_UNID_ORG" type="BIGINT" remarks="Identificador do tipo de unidade organizacional.">
    <constraints nullable="false"/>
  </column>
  <column name="CS_POSSUI_ORCAMENTO" type="BIGINT" remarks="Indica se a unidade possui orcamento proprio." defaultValueNumeric="1 ">
    <constraints nullable="false"/>
  </column>
  <column name="CS_ATIVA" type="BIGINT" defaultValueNumeric="0 ">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE" remarks="Data de cadastro da unidade organizacional.">
    <constraints nullable="false"/>
  </column>
  <column name="DT_COMPOSICAO" type="DATE" remarks="Data da composic?o da unidade organizacional. A composic?o identifica as unidades organizacionais que pertencem a hierarquia de uma determinada unidade organizacional."/>
  <column name="NB_CODIGO_UNIDADE" type="VARCHAR(50)" remarks="Codigo para identificac?o da unidade organizacional."/>
  <column name="CS_TIPO_AUTORIDADE" type="BIGINT" remarks="Indica o tipo de autoridade que a unidade organizacional possui."/>
  <column name="ID_SISTEMA_GESTAO" type="BIGINT" remarks="Identificador unico do sistema de gest?o de uma organizac?o."/>
  <column name="CS_NIVEL_ADMINISTRATIVO_ORG" type="BIGINT" remarks="Indica o nivel administrativo da unidade organizacional."/>
  <column name="FK_UNIDADE_ORG" type="BIGINT" remarks="Identificador unico de uma unidade organizacional."/>
  <column name="BL_LOGO" type="LONGVARBINARY(0)"/>
  <column name="TX_MISSAO" type="VARCHAR(4000)"/>
  <column name="CS_LOTACAO" type="BIGINT"/>
  <column name="CS_UNID_GEST_AQUISICAO" type="BIGINT"/>
  <column name="CS_UNID_GEST_PATRIMONIO" type="BIGINT"/>
  <column name="CS_UNID_GEST_CELULAR" type="BIGINT"/>
  <column name="CS_ESCOLA" type="BIGINT"/>
  <column name="CS_TIPO_ADM" type="BIGINT"/>
  <column name="NB_COD_UNID_PAT" type="BIGINT"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="17">
<addPrimaryKey tableName="UNIDADE_ORG" constraintName="IDX_PK_UNIDADE_ORG" columnNames="ID_UNIDADE_ORG"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="18">
<createIndex tableName="UNIDADE_ORG" indexName="IDX_FK1_UNIDADE_ORG">
  <column name="ID_SISTEMA_GESTAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="19">
<createIndex tableName="UNIDADE_ORG" indexName="IDX_FK2_UNIDADE_ORG">
  <column name="CS_TIPO_AUTORIDADE"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="20">
<createIndex tableName="UNIDADE_ORG" indexName="IDX_FK3_UNIDADE_ORG">
  <column name="CS_TIPO_UNID_ORG"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="21">
<createIndex tableName="UNIDADE_ORG" indexName="IDX_FK4_UNIDADE_ORG">
  <column name="CS_NIVEL_ADMINISTRATIVO_ORG"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="22">
<createIndex tableName="UNIDADE_ORG" indexName="IDX_FK5_UNIDADE_ORG">
  <column name="FK_UNIDADE_ORG"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="23">
<createIndex tableName="UNIDADE_ORG" indexName="IDX_FK6_UNIDADE_ORG">
  <column name="NB_CODIGO_UNIDADE"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="24">
<createTable tableName="TIPO_VAGA_ESTAGIO">
  <column name="CS_TIPO_VAGA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_TIPO_VAGA_ESTAGIO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="CS_CARGA_HORARIA" type="BIGINT"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="25">
<addPrimaryKey tableName="TIPO_VAGA_ESTAGIO" constraintName="TIPO_VAGA_ESTAGIO_pk" columnNames="CS_TIPO_VAGA_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="26">
<createIndex tableName="TIPO_VAGA_ESTAGIO" indexName="XPKTIPO_VAGA_ESTAGIO" unique="true">
  <column name="CS_TIPO_VAGA_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="27">
<createTable tableName="TIPO_PAG_ESTAGIO">
  <column name="CS_TIPO_PAG_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_TIPO_PAG_ESTAGIO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="28">
<addPrimaryKey tableName="TIPO_PAG_ESTAGIO" constraintName="TIPO_PAG_ESTAGIO_pk" columnNames="CS_TIPO_PAG_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="29">
<createIndex tableName="TIPO_PAG_ESTAGIO" indexName="XPKTIPO_PAG_ESTAGIO" unique="true">
  <column name="CS_TIPO_PAG_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="30">
<createTable tableName="TABELA_RECESSO">
  <column name="ID_TABELA_RECESSO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE"/>
  <column name="DT_ATUALIZACAO" type="DATE"/>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD."/>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD."/>
  <column name="TX_TABELA" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_INICIO_VIGENCIA" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_FIM_VIGENCIA" type="DATE"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="31">
<addPrimaryKey tableName="TABELA_RECESSO" constraintName="XPKTABELA_RECESSO" columnNames="ID_TABELA_RECESSO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="32">
<createIndex tableName="TABELA_RECESSO" indexName="XIF1TABELA_RECESSO">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="33">
<createIndex tableName="TABELA_RECESSO" indexName="XIF2TABELA_RECESSO">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="34">
<createIndex tableName="TABELA_RECESSO" indexName="XIF3TABELA_RECESSO">
  <column name="ID_ORGAO_GESTOR_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="35">
<createTable tableName="SOLICITACAO_TA_CP">
  <column name="ID_SOLICITACAO_TA_CP" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CODIGO" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="DT_SOLICITACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE"/>
  <column name="DT_ATUALIZACAO" type="DATE"/>
  <column name="TX_ASSUNTO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="NB_TOTAL_VAGAS" type="BIGINT"/>
  <column name="ID_CONTRATO_CP" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ADITIVO_CONTRATO_CP" type="BIGINT"/>
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="CS_SITUACAO" type="BIGINT" remarks="1 - Aberta
2 - Fechada
3 - Efetivada">
    <constraints nullable="false"/>
  </column>
  <column name="TX_SOLICITACAO" type="VARCHAR(2000)"/>
  <column name="ID_UNID_ORIGEM" type="BIGINT"/>
  <column name="ID_UNID_DESTINO" type="BIGINT"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="36">
<addPrimaryKey tableName="SOLICITACAO_TA_CP" constraintName="XPKSOLICITACAO_TA_CP" columnNames="ID_SOLICITACAO_TA_CP"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="37">
<createIndex tableName="SOLICITACAO_TA_CP" indexName="XIF1SOLICITACAO_TA_CP">
  <column name="ID_CONTRATO_CP"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="38">
<createIndex tableName="SOLICITACAO_TA_CP" indexName="XIF2SOLICITACAO_TA_CP">
  <column name="ID_ADITIVO_CONTRATO_CP"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="39">
<createIndex tableName="SOLICITACAO_TA_CP" indexName="XIF3SOLICITACAO_TA_CP">
  <column name="ID_ORGAO_GESTOR_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="40">
<createIndex tableName="SOLICITACAO_TA_CP" indexName="XIF4SOLICITACAO_TA_CP">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="41">
<createIndex tableName="SOLICITACAO_TA_CP" indexName="XIF5SOLICITACAO_TA_CP">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="42">
<createTable tableName="PESSOA_FISICA">
  <column name="ID_PESSOA" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_CPF" type="VARCHAR(80)" defaultValue="00000000000000 "/>
  <column name="NB_RG" type="VARCHAR(80)"/>
  <column name="CS_SEXO" type="BIGINT"/>
  <column name="DT_ATUALIZACAO" type="DATE"/>
  <column name="CS_TIPO" type="BIGINT"/>
  <column name="TX_ORGAO_EMISSOR" type="VARCHAR(80)"/>
  <column name="ID_UF_RG" type="VARCHAR(80)"/>
  <column name="DT_NASCIMENTO" type="DATE"/>
  <column name="NB_REG_NASCIMENTO" type="VARCHAR(80)"/>
  <column name="TX_CARTORIO_REG_NASC" type="VARCHAR(80)"/>
  <column name="TX_LIVRO_CARTORIO" type="VARCHAR(20)"/>
  <column name="TX_FOLHA_LIV_CART" type="VARCHAR(20)"/>
  <column name="ID_UF_REG_NASCIMENTO" type="VARCHAR(80)"/>
  <column name="ID_LOCALIDADE_NATAL" type="BIGINT"/>
  <column name="NB_COD_CERT_MILITAR" type="VARCHAR(80)"/>
  <column name="NB_CERT_MILITAR" type="VARCHAR(80)"/>
  <column name="NB_PISPASEP" type="VARCHAR(80)"/>
  <column name="NB_TITULO_ELEITOR" type="VARCHAR(80)"/>
  <column name="NB_ZONA_TITULO" type="VARCHAR(80)"/>
  <column name="NB_SECAO_TITULO" type="VARCHAR(80)"/>
  <column name="LR_FOTO" type="LONGVARBINARY(0)"/>
  <column name="ID_LOCALIDADE_CARTORIO" type="BIGINT"/>
  <column name="DT_EMISSAO_CERTIDAO" type="DATE"/>
  <column name="CS_TIPO_CERTIDAO" type="BIGINT"/>
  <column name="DT_EMISSAO" type="DATE"/>
  <column name="CS_ETNIA" type="BIGINT"/>
  <column name="ID_MAE" type="BIGINT"/>
  <column name="ID_PAI" type="BIGINT"/>
  <column name="NB_CODIGO_INEP" type="BIGINT"/>
  <column name="NB_CODIGO_CENTRAL" type="BIGINT"/>
  <column name="LR_FOTO_PNG" type="BLOB(0)"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="43">
<addPrimaryKey tableName="PESSOA_FISICA" constraintName="IDX_PK_PESSOA_FISICA" columnNames="ID_PESSOA"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="44">
<createIndex tableName="PESSOA_FISICA" indexName="IDX_FK1_PESSOA_FISICA">
  <column name="ID_LOCALIDADE_NATAL"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="45">
<createIndex tableName="PESSOA_FISICA" indexName="IDX_FK2_PESSOA_FISICA">
  <column name="ID_UF_REG_NASCIMENTO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="46">
<createIndex tableName="PESSOA_FISICA" indexName="IDX_FK3_PESSOA_FISICA">
  <column name="ID_UF_RG"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="47">
<createTable tableName="ORGAO_ESTAGIO">
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_ORGAO_ESTAGIO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CNPJ" type="VARCHAR(20)"/>
  <column name="CS_STATUS" type="BIGINT" remarks="1 - Ativado
2 - Desativado">
    <constraints nullable="false"/>
  </column>
  <column name="ID_UNIDADE_ORG" type="BIGINT" remarks="Identificador unico de uma unidade organizacional."/>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="48">
<addPrimaryKey tableName="ORGAO_ESTAGIO" constraintName="ORGAO_ESTAGIO_pk" columnNames="ID_ORGAO_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="49">
<createIndex tableName="ORGAO_ESTAGIO" indexName="XPKORGAO_ESTAGIO" unique="true">
  <column name="ID_ORGAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="50">
<createIndex tableName="ORGAO_ESTAGIO" indexName="XIF1ORGAO_ESTAGIO">
  <column name="ID_UNIDADE_ORG"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="51">
<createIndex tableName="ORGAO_ESTAGIO" indexName="XIF2ORGAO_ESTAGIO">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="52">
<createIndex tableName="ORGAO_ESTAGIO" indexName="XIF3ORGAO_ESTAGIO">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="53">
<createTable tableName="ORGAO_GESTOR_EMAIL">
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_ORGAO_GESTOR_EMAIL" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_EMAIL" type="VARCHAR(100)">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="54">
<createTable tableName="ORGAO_AGENTE_SETORIAL">
  <column name="ID_SETORIAL_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="55">
<createIndex tableName="ORGAO_AGENTE_SETORIAL" indexName="XPKORGAO_AGENTE_SETORIAL" unique="true">
  <column name="ID_SETORIAL_ESTAGIO"/>
  <column name="ID_ORGAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="56">
<createIndex tableName="ORGAO_AGENTE_SETORIAL" indexName="XIF1ORGAO_AGENTE_SETORIAL">
  <column name="ID_SETORIAL_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="57">
<createIndex tableName="ORGAO_AGENTE_SETORIAL" indexName="XIF2ORGAO_AGENTE_SETORIAL">
  <column name="ID_ORGAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="58">
<createTable tableName="ITEM_TAB_RECESSO">
  <column name="ID_TABELA_RECESSO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_ITEM_TAB_RECESSO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="TX_DURACAO_ESTAGIO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="NB_DURACAO_RECESSO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_FORMULA_RECESSO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD."/>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD."/>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="59">
<createIndex tableName="ITEM_TAB_RECESSO" indexName="XIF1ITEM_TAB_RECESSO">
  <column name="ID_TABELA_RECESSO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="60">
<createIndex tableName="ITEM_TAB_RECESSO" indexName="XIF2ITEM_TAB_RECESSO">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="61">
<createIndex tableName="ITEM_TAB_RECESSO" indexName="XIF3ITEM_TAB_RECESSO">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="62">
<createTable tableName="ITEM_PAGAMENTO_ESTAGIO">
  <column name="ID_ITEM_PAGAMENTO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CODIGO" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_DESCRICAO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_SIGLA" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="CS_TIPO" type="BIGINT" remarks="1 - Credito
2 - Debito
3 - Informativo">
    <constraints nullable="false"/>
  </column>
  <column name="CS_SITUACAO" type="BIGINT" remarks="1 - Ativo
2 - Desativado">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="63">
<addPrimaryKey tableName="ITEM_PAGAMENTO_ESTAGIO" constraintName="ITEM_PAGAMENTO_ESTAGIO_pk" columnNames="ID_ITEM_PAGAMENTO_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="64">
<createIndex tableName="ITEM_PAGAMENTO_ESTAGIO" indexName="XPKITEM_PAGAMENTO_ESTAGIO" unique="true">
  <column name="ID_ITEM_PAGAMENTO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="65">
<createTable tableName="VALOR_BASE_ITEM_PAG">
  <column name="ID_ITEM_PAGAMENTO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_VALOR_BASE_ITEM_PAG" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_INICIO_VIGENCIA" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_FIM_VIGENCIA" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="NB_VALOR_BASE" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_DESCRICAO_BASE" type="VARCHAR(255)"/>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="66">
<createIndex tableName="VALOR_BASE_ITEM_PAG" indexName="XPKVALOR_BASE_ITEM_PAG" unique="true">
  <column name="ID_ITEM_PAGAMENTO_ESTAGIO"/>
  <column name="NB_VALOR_BASE_ITEM_PAG"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="67">
<createIndex tableName="VALOR_BASE_ITEM_PAG" indexName="XIF1VALOR_BASE_ITEM_PAG">
  <column name="ID_ITEM_PAGAMENTO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="68">
<createTable tableName="INSTITUICAO_ENSINO">
  <column name="ID_INSTITUICAO_ENSINO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_INSTITUICAO_ENSINO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_SIGLA" type="VARCHAR(20)"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="69">
<addPrimaryKey tableName="INSTITUICAO_ENSINO" constraintName="INSTITUICAO_ENSINO_pk" columnNames="ID_INSTITUICAO_ENSINO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="70">
<createIndex tableName="INSTITUICAO_ENSINO" indexName="XPKINSTITUICAO_ENSINO" unique="true">
  <column name="ID_INSTITUICAO_ENSINO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="71">
<createTable tableName="GRUPO_PAGAMENTO">
  <column name="ID_GRUPO_PAGAMENTO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_GRUPO_PAGAMENTO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="72">
<addPrimaryKey tableName="GRUPO_PAGAMENTO" constraintName="XPKGRUPO_PAGAMENTO" columnNames="ID_GRUPO_PAGAMENTO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="73">
<createTable tableName="GESTOR_ESTAGIO">
  <column name="NB_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_EMAIL" type="VARCHAR(100)"/>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="74">
<createIndex tableName="GESTOR_ESTAGIO" indexName="GESTOR_ESTAGIO_INDEX1">
  <column name="NB_GESTOR_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="75">
<createTable tableName="FUNCIONARIO_PE">
  <column name="ID_PESSOA_FUNCIONARIO" type="BIGINT" remarks="E o identificador unico das pessoa fisicas.">
    <constraints nullable="false"/>
  </column>
  <column name="NB_FUNCIONARIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_UNIDADE_GESTORA" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE" remarks="Data de cadastro do funcionario.">
    <constraints nullable="false"/>
  </column>
  <column name="TX_NOME_GUERRA" type="VARCHAR(80)">
    <constraints nullable="false"/>
  </column>
  <column name="BL_FOTO" type="BLOB(0)"/>
  <column name="BL_DIGITAL" type="BLOB(0)"/>
  <column name="CS_SITUACAO_FUNCIONARIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="CS_TIPO_FUNCIONARIO_PE" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="TX_FIR" type="VARCHAR(2000)"/>
  <column name="CS_TIPO_REG_PONTO" type="BIGINT"/>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="76">
<createIndex tableName="FUNCIONARIO_PE" indexName="XPKFUNCIONARIO_PE" unique="true">
  <column name="ID_PESSOA_FUNCIONARIO"/>
  <column name="NB_FUNCIONARIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="77">
<createIndex tableName="FUNCIONARIO_PE" indexName="XIF1FUNCIONARIO_PE">
  <column name="ID_UNIDADE_GESTORA"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="78">
<createIndex tableName="FUNCIONARIO_PE" indexName="XIF2FUNCIONARIO_PE">
  <column name="ID_PESSOA_FUNCIONARIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="79">
<createIndex tableName="FUNCIONARIO_PE" indexName="XIF3FUNCIONARIO_PE">
  <column name="CS_SITUACAO_FUNCIONARIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="80">
<createIndex tableName="FUNCIONARIO_PE" indexName="XIF4FUNCIONARIO_PE">
  <column name="CS_TIPO_FUNCIONARIO_PE"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="81">
<createTable tableName="ESTAGIARIO_VAGA">
  <column name="ID_RECRUTAMENTO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_VAGAS_RECRUTAMENTO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_CANDIDATO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="CS_SITUACAO" type="BIGINT" remarks="1 - Em Analise
2 - Aprovado
3 - Reprovado
4 - Cancelado">
    <constraints nullable="false"/>
  </column>
  <column name="TX_MOTIVO_SITUACAO" type="VARCHAR(255)"/>
  <column name="ID_PESSOA_ESTAGIARIO" type="BIGINT" remarks="E o identificador unico das pessoa fisicas.">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="82">
<createIndex tableName="ESTAGIARIO_VAGA" indexName="XIF1ESTAGIARIO_VAGA">
  <column name="ID_RECRUTAMENTO_ESTAGIO"/>
  <column name="NB_VAGAS_RECRUTAMENTO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="83">
<createIndex tableName="ESTAGIARIO_VAGA" indexName="XIF2ESTAGIARIO_VAGA">
  <column name="ID_PESSOA_ESTAGIARIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="84">
<createTable tableName="ESTAGIARIO_CONTRATO">
  <column name="ID_CONTRATO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_ESTAGIARIO_CONTRATO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_VIGENCIA" type="BIGINT"/>
  <column name="DT_INICIO_PRORROGACAO" type="DATE"/>
  <column name="DT_FIM_PRORROGACAO" type="DATE"/>
  <column name="DT_INICIO_RECESSO" type="DATE"/>
  <column name="DT_FIM_RECESSO" type="DATE"/>
  <column name="NB_JORNADA" type="BIGINT"/>
  <column name="DT_INICIO_JORNADA" type="DATE"/>
  <column name="TX_INICIO_HORARIO" type="VARCHAR(20)"/>
  <column name="TX_FIM_HORARIO" type="VARCHAR(20)"/>
  <column name="NB_BOLSA" type="BIGINT"/>
  <column name="DT_INICIO_PAG_BOLSA" type="DATE"/>
  <column name="NB_VALOR_BOLSA" type="BIGINT"/>
  <column name="NB_SUPERVISOR" type="BIGINT"/>
  <column name="ID_PESSOA_SUPERVISOR" type="VARCHAR(20)"/>
  <column name="NB_ALTERACOES" type="BIGINT"/>
  <column name="TX_OUTRAS_ALTERACOES" type="VARCHAR(4000)"/>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="85">
<createTable tableName="ESTAGIARIO">
  <column name="ID_PESSOA_ESTAGIARIO" type="BIGINT" remarks="E o identificador unico das pessoa fisicas.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_PESSOA_FUNCIONARIO" type="BIGINT" remarks="E o identificador unico das pessoa fisicas."/>
  <column name="NB_FUNCIONARIO" type="BIGINT"/>
  <column name="TX_CEP" type="VARCHAR(20)"/>
  <column name="TX_ENDERECO" type="VARCHAR(255)"/>
  <column name="NB_NUMERO" type="BIGINT"/>
  <column name="TX_COMPLEMENTO" type="VARCHAR(255)"/>
  <column name="TX_BAIRRO" type="VARCHAR(100)"/>
  <column name="TX_AGENCIA" type="VARCHAR(20)"/>
  <column name="TX_CONTA_CORRENTE" type="VARCHAR(20)"/>
  <column name="TX_CONTATO" type="VARCHAR(180)"/>
  <column name="TX_EMAIL" type="VARCHAR(255)"/>
  <column name="NB_PCD" type="BIGINT"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="86">
<addPrimaryKey tableName="ESTAGIARIO" constraintName="ESTAGIARIO_pk" columnNames="ID_PESSOA_ESTAGIARIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="87">
<createIndex tableName="ESTAGIARIO" indexName="XPKESTAGIARIO" unique="true">
  <column name="ID_PESSOA_ESTAGIARIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="88">
<createIndex tableName="ESTAGIARIO" indexName="XIF2ESTAGIARIO">
  <column name="ID_PESSOA_FUNCIONARIO"/>
  <column name="NB_FUNCIONARIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="89">
<createTable tableName="EMAIL_GESTOR_ESTAGIO">
  <column name="NB_EMAIL_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_EMAIL" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="90">
<createTable tableName="CONTRATO_GC">
  <column name="ID_CONTRATO_GC" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="TX_PROC_PROTOCOLO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_FORMA_AQUISICAO_GC" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="TX_NOME_CONTATO" type="VARCHAR(255)"/>
  <column name="TX_TELEF_CONTATO" type="VARCHAR(255)"/>
  <column name="TX_CELULAR_CONTATO" type="VARCHAR(255)"/>
  <column name="TX_EMAIL_CONTATO" type="VARCHAR(255)"/>
  <column name="ID_MODALIDADE_GC" type="BIGINT"/>
  <column name="DT_PUBLIC_PORTARIA" type="DATE"/>
  <column name="TX_FUNDAMENTACAO" type="VARCHAR(255)"/>
  <column name="TX_OBSERVACAO" type="VARCHAR(2000)"/>
  <column name="ID_UNID_GESTORA_GC" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_MOEDA" type="BIGINT"/>
  <column name="NB_VALOR_MENSAL" type="BIGINT"/>
  <column name="NB_VALOR_TOTAL" type="BIGINT"/>
  <column name="TX_EXTRATO_DOM" type="VARCHAR(255)"/>
  <column name="TX_EDICAO_DOM" type="VARCHAR(255)"/>
  <column name="DT_PUBLICACAO_DOM" type="DATE"/>
  <column name="DT_PROPOSTA" type="DATE"/>
  <column name="DT_HOMOLOGACAO" type="DATE"/>
  <column name="DT_ASSINATURA_AJUSTE" type="DATE"/>
  <column name="CS_VIGENCIA" type="BIGINT"/>
  <column name="TX_VIGENCIA_OUTRO" type="VARCHAR(20)"/>
  <column name="DT_INICIO_VIGENCIA" type="DATE"/>
  <column name="DT_FIM_VIGENCIA" type="DATE"/>
  <column name="NB_DURACAO" type="BIGINT"/>
  <column name="CS_UNIDADE_TEMPO" type="BIGINT" remarks="Classificador dos diversos tipos de unidade de tempo."/>
  <column name="TX_PROC_COMPRA" type="VARCHAR(50)"/>
  <column name="ID_FORNECEDOR_GC" type="BIGINT"/>
  <column name="CS_ARTIGO" type="BIGINT" remarks="1-Checkado"/>
  <column name="CS_SITUACAO" type="BIGINT" remarks="1-Gravado">
    <constraints nullable="false"/>
  </column>
  <column name="DT_EXPEDICAO_OS" type="DATE"/>
  <column name="DT_RECEPCAO_OS" type="DATE"/>
  <column name="CS_VINGENTE" type="BIGINT" remarks="1-Assinatura; 2-Recepc?o da Ordem de Servico; 3-Publicac?o do Extrato; 4-Outros"/>
  <column name="DT_OUTROS" type="DATE"/>
  <column name="TX_URL_PDF" type="VARCHAR(255)"/>
  <column name="TX_LINK_DOM" type="VARCHAR(255)"/>
  <column name="TX_PAGINA_DOM" type="VARCHAR(20)"/>
  <column name="NB_EMPENHO" type="VARCHAR(20)"/>
  <column name="DT_EMPENHO" type="DATE"/>
  <column name="CS_ARQUIVO" type="BIGINT"/>
  <column name="NB_ORDENADOR_GC" type="BIGINT"/>
  <column name="TX_DOM_DESPACHO" type="VARCHAR(255)"/>
  <column name="CS_ESTIMATIVO" type="BIGINT" remarks="1-SIM   2-N&#195;O"/>
  <column name="ID_IMOVEL_PAT" type="BIGINT"/>
  <column name="ID_MIGRACAO_UNID_GC" type="BIGINT"/>
  <column name="ID_CONTRATO_GC_ORIG" type="BIGINT"/>
  <column name="TX_OBSERVACAO_GESTOR" type="VARCHAR(4000)"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="91">
<addPrimaryKey tableName="CONTRATO_GC" constraintName="XPKCONTRATO_GC" columnNames="ID_CONTRATO_GC"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="92">
<createIndex tableName="CONTRATO_GC" indexName="XIF11CONTRATO_GC">
  <column name="CS_UNIDADE_TEMPO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="93">
<createIndex tableName="CONTRATO_GC" indexName="XIF12CONTRATO_GC">
  <column name="ID_FORNECEDOR_GC"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="94">
<createIndex tableName="CONTRATO_GC" indexName="XIF2CONTRATO_GC">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="95">
<createIndex tableName="CONTRATO_GC" indexName="XIF3CONTRATO_GC">
  <column name="ID_FORMA_AQUISICAO_GC"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="96">
<createIndex tableName="CONTRATO_GC" indexName="XIF4CONTRATO_GC">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="97">
<createIndex tableName="CONTRATO_GC" indexName="XIF6CONTRATO_GC">
  <column name="ID_MODALIDADE_GC"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="98">
<createIndex tableName="CONTRATO_GC" indexName="XIF8CONTRATO_GC">
  <column name="ID_UNID_GESTORA_GC"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="99">
<createIndex tableName="CONTRATO_GC" indexName="XIF9CONTRATO_GC">
  <column name="ID_MOEDA"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="100">
<createTable tableName="QUADRO_VAGAS_ESTAGIO">
  <column name="ID_QUADRO_VAGAS_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="CS_SITUACAO" type="BIGINT" remarks="1 - Ativo
2 - Desativado">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CODIGO" type="VARCHAR(20)"/>
  <column name="ID_CONTRATO_CP" type="BIGINT"/>
  <column name="ID_CONTRATO_GC" type="BIGINT"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="101">
<addPrimaryKey tableName="QUADRO_VAGAS_ESTAGIO" constraintName="QUADRO_VAGAS_ESTAGIO_pk" columnNames="ID_QUADRO_VAGAS_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="102">
<createIndex tableName="QUADRO_VAGAS_ESTAGIO" indexName="XPKQUADRO_VAGAS_ESTAGIO" unique="true">
  <column name="ID_QUADRO_VAGAS_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="103">
<createIndex tableName="QUADRO_VAGAS_ESTAGIO" indexName="XIF2QUADRO_VAGAS_ESTAGIO">
  <column name="ID_ORGAO_GESTOR_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="104">
<createIndex tableName="QUADRO_VAGAS_ESTAGIO" indexName="XIF3QUADRO_VAGAS_ESTAGIO">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="105">
<createIndex tableName="QUADRO_VAGAS_ESTAGIO" indexName="XIF4QUADRO_VAGAS_ESTAGIO">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="106">
<createIndex tableName="QUADRO_VAGAS_ESTAGIO" indexName="XIF7QUADRO_VAGAS_ESTAGIO">
  <column name="ID_CONTRATO_GC"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="107">
<createTable tableName="TRANSFERENCIA_VAGAS">
  <column name="ID_TRANSFERENCIA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="CS_SITUACAO" type="BIGINT" remarks="1 - Aberta
2 - Fechada
3 - Cancelada">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="TX_COD_TRANSFERENCIA" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_MOTIVO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_SOLICITANTE" type="BIGINT"/>
  <column name="ID_QUADRO_VAGAS_ESTAGIO" type="BIGINT"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="108">
<addPrimaryKey tableName="TRANSFERENCIA_VAGAS" constraintName="TRANSFERENCIA_VAGAS_pk" columnNames="ID_TRANSFERENCIA_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="109">
<createIndex tableName="TRANSFERENCIA_VAGAS" indexName="XPKTRANSFERENCIA_VAGAS" unique="true">
  <column name="ID_TRANSFERENCIA_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="110">
<createIndex tableName="TRANSFERENCIA_VAGAS" indexName="XIF1TRANSFERENCIA_VAGAS">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="111">
<createIndex tableName="TRANSFERENCIA_VAGAS" indexName="XIF2TRANSFERENCIA_VAGAS">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="112">
<createIndex tableName="TRANSFERENCIA_VAGAS" indexName="XIF3TRANSFERENCIA_VAGAS">
  <column name="ID_ORGAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="113">
<createIndex tableName="TRANSFERENCIA_VAGAS" indexName="XIF4TRANSFERENCIA_VAGAS">
  <column name="ID_ORGAO_GESTOR_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="114">
<createIndex tableName="TRANSFERENCIA_VAGAS" indexName="XIF5TRANSFERENCIA_VAGAS">
  <column name="ID_ORGAO_SOLICITANTE"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="115">
<createIndex tableName="TRANSFERENCIA_VAGAS" indexName="XIF6TRANSFERENCIA_VAGAS">
  <column name="ID_QUADRO_VAGAS_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="116">
<createTable tableName="VAGAS_TRANSFERIDAS">
  <column name="ID_TRANSFERENCIA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_VAGAS_TRANSFERIDAS" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_QUADRO_VAGAS_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_EST_ORIGEM" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="CS_TIPO_VAGA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_EST_DESTINO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_QUANTIDADE" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_DOC_AUTORIZACAO" type="VARCHAR(255)"/>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="117">
<addPrimaryKey tableName="VAGAS_TRANSFERIDAS" constraintName="XPKVAGAS_TRANSFERIDAS" columnNames="ID_TRANSFERENCIA_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="118">
<createIndex tableName="VAGAS_TRANSFERIDAS" indexName="XIF1VAGAS_TRANSFERIDAS">
  <column name="ID_TRANSFERENCIA_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="119">
<createIndex tableName="VAGAS_TRANSFERIDAS" indexName="XIF2VAGAS_TRANSFERIDAS">
  <column name="ID_QUADRO_VAGAS_ESTAGIO"/>
  <column name="ID_ORGAO_EST_ORIGEM"/>
  <column name="CS_TIPO_VAGA_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="120">
<createIndex tableName="VAGAS_TRANSFERIDAS" indexName="XIF3VAGAS_TRANSFERIDAS">
  <column name="ID_QUADRO_VAGAS_ESTAGIO"/>
  <column name="ID_ORGAO_EST_DESTINO"/>
  <column name="CS_TIPO_VAGA_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="121">
<createIndex tableName="VAGAS_TRANSFERIDAS" indexName="XIF4VAGAS_TRANSFERIDAS">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="122">
<createIndex tableName="VAGAS_TRANSFERIDAS" indexName="XIF5VAGAS_TRANSFERIDAS">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="123">
<createTable tableName="SOLICITACAO_ESTAGIO">
  <column name="ID_SOLICITACAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE"/>
  <column name="DT_ATUALIZACAO" type="DATE"/>
  <column name="TX_COD_SOLICITACAO" type="VARCHAR(20)"/>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD."/>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD."/>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_JUSTIFICATIVA" type="VARCHAR(255)"/>
  <column name="CS_SITUACAO" type="BIGINT" remarks="1 - Aberta
2 - Efetivada
3 - Cancelada"/>
  <column name="ID_QUADRO_VAGAS_ESTAGIO" type="BIGINT"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="124">
<addPrimaryKey tableName="SOLICITACAO_ESTAGIO" constraintName="SOLICITACAO_ESTAGIO_pk" columnNames="ID_SOLICITACAO_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="125">
<createIndex tableName="SOLICITACAO_ESTAGIO" indexName="XPKSOLICITACAO_ESTAGIO" unique="true">
  <column name="ID_SOLICITACAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="126">
<createIndex tableName="SOLICITACAO_ESTAGIO" indexName="XIF1SOLICITACAO_ESTAGIO">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="127">
<createIndex tableName="SOLICITACAO_ESTAGIO" indexName="XIF2SOLICITACAO_ESTAGIO">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="128">
<createIndex tableName="SOLICITACAO_ESTAGIO" indexName="XIF3SOLICITACAO_ESTAGIO">
  <column name="ID_ORGAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="129">
<createIndex tableName="SOLICITACAO_ESTAGIO" indexName="XIF4SOLICITACAO_ESTAGIO">
  <column name="ID_ORGAO_GESTOR_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="130">
<createIndex tableName="SOLICITACAO_ESTAGIO" indexName="XIF5SEMADSOLICITACAO_ESTAGIO">
  <column name="ID_QUADRO_VAGAS_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="131">
<createTable tableName="RECRUTAMENTO_ESTAGIO">
  <column name="ID_RECRUTAMENTO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="ID_QUADRO_VAGAS_ESTAGIO" type="BIGINT"/>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="TX_DOC_AUTORIZACAO" type="VARCHAR(20)"/>
  <column name="TX_MOTIVO" type="VARCHAR(255)"/>
  <column name="TX_COD_RECRUTAMENTO" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="CS_SITUACAO" type="BIGINT" remarks="1 - Aberto  2 - Fechado">
    <constraints nullable="false"/>
  </column>
  <column name="ID_SOLICITACAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="132">
<addPrimaryKey tableName="RECRUTAMENTO_ESTAGIO" constraintName="RECRUTAMENTO_ESTAGIO_pk" columnNames="ID_RECRUTAMENTO_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="133">
<createIndex tableName="RECRUTAMENTO_ESTAGIO" indexName="XPKRECRUTAMENTO_ESTAGIO" unique="true">
  <column name="ID_RECRUTAMENTO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="134">
<createIndex tableName="RECRUTAMENTO_ESTAGIO" indexName="XIF1RECRUTAMENTO_ESTAGIO">
  <column name="ID_QUADRO_VAGAS_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="135">
<createIndex tableName="RECRUTAMENTO_ESTAGIO" indexName="XIF2RECRUTAMENTO_ESTAGIO">
  <column name="ID_ORGAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="136">
<createIndex tableName="RECRUTAMENTO_ESTAGIO" indexName="XIF3RECRUTAMENTO_ESTAGIO">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="137">
<createIndex tableName="RECRUTAMENTO_ESTAGIO" indexName="XIF4RECRUTAMENTO_ESTAGIO">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="138">
<createTable tableName="EVENTO_CONTRATO_GC">
  <column name="ID_EVENTO_CONTRATO_GC" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="TX_PROC_PROTOCOLO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_NUM_TERMO_ADITIVO" type="VARCHAR(255)"/>
  <column name="TX_OBJETO" type="VARCHAR(2000)"/>
  <column name="TX_JUSTIFICATIVA" type="VARCHAR(2000)"/>
  <column name="TX_FUNDAMENTACAO" type="VARCHAR(2000)"/>
  <column name="ID_CONTRATO_GC" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="CS_TIPO_EVENTO_GC" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_DETALHE_EVENTO_GC" type="BIGINT"/>
  <column name="TX_PROC_COMPRA" type="VARCHAR(255)"/>
  <column name="NB_VALOR_DIFERENCA" type="BIGINT"/>
  <column name="NB_VALOR_MENSAL" type="BIGINT"/>
  <column name="NB_VALOR_TOTAL" type="BIGINT"/>
  <column name="TX_INDICE_REAL" type="VARCHAR(255)"/>
  <column name="TX_VAL_PERC_INDICE" type="BIGINT"/>
  <column name="TX_EXTRATO_DOM" type="VARCHAR(255)"/>
  <column name="TX_EDICAO_DOM" type="VARCHAR(255)"/>
  <column name="DT_PUBLICACAO_DOM" type="DATE"/>
  <column name="ID_MOEDA" type="BIGINT"/>
  <column name="DT_PROPOSTA" type="DATE"/>
  <column name="DT_HOMOLOGACAO" type="DATE"/>
  <column name="DT_EXPEDICAO_OS" type="DATE"/>
  <column name="DT_RECEPCAO_OS" type="DATE"/>
  <column name="CS_VIGENCIA" type="BIGINT"/>
  <column name="TX_OUTRA_VIGENCIA" type="VARCHAR(255)"/>
  <column name="DT_INICIO_VIGENCIA" type="DATE"/>
  <column name="DT_FIM_VIGENCIA" type="DATE"/>
  <column name="NB_DURACAO_VIGENCIA" type="BIGINT"/>
  <column name="CS_UNIDADE_TEMPO" type="BIGINT" remarks="Classificador dos diversos tipos de unidade de tempo."/>
  <column name="TX_URL_PDF" type="VARCHAR(255)"/>
  <column name="TX_LINK_DOM" type="VARCHAR(255)"/>
  <column name="TX_PAGINA_DOM" type="VARCHAR(255)"/>
  <column name="NB_EMPENHO" type="VARCHAR(20)"/>
  <column name="DT_EMPENHO" type="DATE"/>
  <column name="CS_ARQUIVO" type="BIGINT"/>
  <column name="CS_SITUACAO" type="BIGINT"/>
  <column name="DT_OUTROS" type="DATE"/>
  <column name="DT_ASSINATURA_AJUSTE" type="DATE"/>
  <column name="NB_ORDENADOR_GC" type="BIGINT"/>
  <column name="ID_UNID_GESTORA_GC" type="BIGINT"/>
  <column name="TX_NOME_REP_LEGAL1" type="VARCHAR(255)"/>
  <column name="TX_CPF_REP_LEGAL1" type="VARCHAR(20)"/>
  <column name="TX_CARGO_REP_LEGAL1" type="VARCHAR(255)"/>
  <column name="TX_NOME_REP_LEGAL2" type="VARCHAR(255)"/>
  <column name="TX_CPF_REP_LEGAL2" type="VARCHAR(20)"/>
  <column name="TX_CARGO_REP_LEGAL2" type="VARCHAR(255)"/>
  <column name="TX_GARANTIA" type="VARCHAR(255)"/>
  <column name="TX_LOCALIZACAO_PROC" type="VARCHAR(255)"/>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT"/>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT"/>
  <column name="TX_OBSERVACAO_GESTOR" type="VARCHAR(4000)"/>
  <column name="NB_PERCENTUAL" type="BIGINT"/>
  <column name="CS_TIPO_VALORES" type="BIGINT"/>
  <column name="NB_VAL_DIFERENCA" type="BIGINT"/>
  <column name="NB_VALOR_PREVISTO" type="BIGINT"/>
  <column name="NB_VALOR_GLOBAL" type="BIGINT"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="139">
<addPrimaryKey tableName="EVENTO_CONTRATO_GC" constraintName="XPKEVENTO_CONTRATO_GC" columnNames="ID_EVENTO_CONTRATO_GC"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="140">
<createIndex tableName="EVENTO_CONTRATO_GC" indexName="XIF1EVENTO_CONTRATO_GC">
  <column name="ID_CONTRATO_GC"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="141">
<createIndex tableName="EVENTO_CONTRATO_GC" indexName="XIF2EVENTO_CONTRATO_GC">
  <column name="CS_TIPO_EVENTO_GC"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="142">
<createIndex tableName="EVENTO_CONTRATO_GC" indexName="XIF3EVENTO_CONTRATO_GC">
  <column name="CS_TIPO_EVENTO_GC"/>
  <column name="NB_DETALHE_EVENTO_GC"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="143">
<createIndex tableName="EVENTO_CONTRATO_GC" indexName="XIF4EVENTO_CONTRATO_GC">
  <column name="ID_MOEDA"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="144">
<createIndex tableName="EVENTO_CONTRATO_GC" indexName="XIF5EVENTO_CONTRATO_GC">
  <column name="CS_UNIDADE_TEMPO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="145">
<createIndex tableName="EVENTO_CONTRATO_GC" indexName="XIF6EVENTO_CONTRATO_GC">
  <column name="ID_UNID_GESTORA_GC"/>
  <column name="NB_ORDENADOR_GC"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="146">
<createTable tableName="DADOS_COMP_CONT_GC">
  <column name="ID_CONTRATO_GC" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_TIPO_TERMO_GC" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_NUMERO_CONTRATO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_ANO_CONTRATO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_NUM_EMPREGADOS" type="BIGINT"/>
  <column name="TX_NOME_REP_LEGAL1" type="VARCHAR(255)"/>
  <column name="TX_CPF_REP_LEGAL1" type="VARCHAR(20)"/>
  <column name="TX_CARGO_REP_LEGAL1" type="VARCHAR(255)"/>
  <column name="TX_NOME_REP_LEGAL2" type="VARCHAR(255)"/>
  <column name="TX_CPF_REP_LEGAL2" type="VARCHAR(20)"/>
  <column name="TX_CARGO_REP_LEGAL2" type="VARCHAR(255)"/>
  <column name="TX_OBJETO_CONTRATADO" type="VARCHAR(2000)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_GARANTIA" type="VARCHAR(255)"/>
  <column name="TX_LOCALIZACAO_PROC" type="VARCHAR(255)"/>
  <column name="CS_NATUREZA_CONTINUADA" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="CS_CAT_ECONOMICA" type="BIGINT"/>
  <column name="ID_GRUPO_CONTABIL_GC" type="VARCHAR(20)"/>
  <column name="CS_TIPO_GARANTIA" type="BIGINT"/>
  <column name="NB_VALOR_GARANTIA" type="BIGINT"/>
  <column name="NB_PERCENTUAL_GARANTIA" type="BIGINT"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="147">
<addPrimaryKey tableName="DADOS_COMP_CONT_GC" constraintName="XPKDADOS_COMP_CONT_GC" columnNames="ID_CONTRATO_GC"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="148">
<createIndex tableName="DADOS_COMP_CONT_GC" indexName="XIF3DADOS_COMP_CONT_GC">
  <column name="ID_TIPO_TERMO_GC"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="149">
<createIndex tableName="DADOS_COMP_CONT_GC" indexName="XIF4DADOS_COMP_CONT_GC">
  <column name="ID_USUARIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="150">
<createIndex tableName="DADOS_COMP_CONT_GC" indexName="XIF7DADOS_COMP_CONT_GC">
  <column name="ID_GRUPO_CONTABIL_GC"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="151">
<createTable tableName="CONTRATO_CP">
  <column name="ID_CONTRATO_CP" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_CODIGO" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="DT_INICIO_VALIDADE" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_FIM_VALIDADE" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="CS_TIPO_PRAZO" type="BIGINT"/>
  <column name="NB_PROC_ADMIN" type="VARCHAR(50)"/>
  <column name="NB_VALOR_GLOBAL" type="BIGINT"/>
  <column name="TX_OBJETO" type="VARCHAR(2000)"/>
  <column name="DT_CADASTRO" type="DATE"/>
  <column name="DT_ALTERACAO" type="DATE"/>
  <column name="NB_PRAZO" type="BIGINT"/>
  <column name="ID_UNID_GEST_RESP" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_UNID_GEST_CADASTRO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_PESSOA_RESP" type="BIGINT" remarks="E o identificador unico das pessoa fisicas que s?o funcionarios da PMM.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_PESSOA_CADASTRO" type="BIGINT" remarks="E o identificador unico das pessoa fisicas que s?o funcionarios da PMM.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_UNID_GEST_ALTERACAO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_PESSOA_ALTERACAO" type="BIGINT" remarks="E o identificador unico das pessoa fisicas que s?o funcionarios da PMM.">
    <constraints nullable="false"/>
  </column>
  <column name="TX_OBSERVACAO" type="VARCHAR(2000)"/>
  <column name="ID_UNIDADE_ORC" type="BIGINT"/>
  <column name="CS_TIPO_CONTRATO_CP" type="BIGINT"/>
  <column name="ID_MODALIDADE_CP" type="BIGINT"/>
  <column name="ID_PESSOA" type="BIGINT"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="152">
<addPrimaryKey tableName="CONTRATO_CP" constraintName="CONTRATO_CP_pk" columnNames="ID_CONTRATO_CP"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="153">
<createIndex tableName="CONTRATO_CP" indexName="XPKCONTRATO_CP" unique="true">
  <column name="ID_CONTRATO_CP"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="154">
<createIndex tableName="CONTRATO_CP" indexName="XIF3CONTRATO_CP">
  <column name="ID_UNID_GEST_RESP"/>
  <column name="ID_PESSOA_RESP"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="155">
<createIndex tableName="CONTRATO_CP" indexName="XIF4CONTRATO_CP">
  <column name="ID_UNID_GEST_CADASTRO"/>
  <column name="ID_PESSOA_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="156">
<createIndex tableName="CONTRATO_CP" indexName="XIF5CONTRATO_CP">
  <column name="ID_UNID_GEST_ALTERACAO"/>
  <column name="ID_PESSOA_ALTERACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="157">
<createIndex tableName="CONTRATO_CP" indexName="XIF8CONTRATO_CP">
  <column name="ID_UNIDADE_ORC"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="158">
<createTable tableName="CONSELHO_PROFISSIONAL">
  <column name="ID_CONSELHO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CONSELHO" type="VARCHAR(80)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_SIGLA_CONSELHO" type="VARCHAR(20)"/>
  <column name="TX_REGIAO" type="VARCHAR(20)"/>
  <column name="ID_UF" type="VARCHAR(2)">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="159">
<addPrimaryKey tableName="CONSELHO_PROFISSIONAL" constraintName="IDX_PK_CONSELHO_PROFISSIONAL" columnNames="ID_CONSELHO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="160">
<createIndex tableName="CONSELHO_PROFISSIONAL" indexName="IDX_AK1_CONSELHO_PROFISSIONAL" unique="true">
  <column name="TX_CONSELHO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="161">
<createIndex tableName="CONSELHO_PROFISSIONAL" indexName="IDX_FK1_CONSELHO_PROFISSIONAL">
  <column name="ID_UF"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="162">
<createTable tableName="SUPERVISOR_ESTAGIO">
  <column name="ID_PESSOA_SUPERVISOR" type="BIGINT" remarks="E o identificador unico das pessoa fisicas.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_PESSOA_FUNCIONARIO" type="BIGINT" remarks="E o identificador unico das pessoa fisicas.">
    <constraints nullable="false"/>
  </column>
  <column name="NB_FUNCIONARIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CURRICULO" type="VARCHAR(2000)"/>
  <column name="ID_CONSELHO" type="BIGINT"/>
  <column name="NB_INSCRICAO_CONSELHO" type="VARCHAR(80)"/>
  <column name="TX_FORMACAO" type="VARCHAR(255)"/>
  <column name="TX_CARGO" type="VARCHAR(255)"/>
  <column name="TX_TEMPO_EXPERIENCIA" type="VARCHAR(20)"/>
  <column name="TX_EMAIL" type="VARCHAR(100)"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="163">
<addPrimaryKey tableName="SUPERVISOR_ESTAGIO" constraintName="SUPERVISOR_ESTAGIO_pk" columnNames="ID_PESSOA_SUPERVISOR"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="164">
<createIndex tableName="SUPERVISOR_ESTAGIO" indexName="XPKSUPERVISOR_ESTAGIO" unique="true">
  <column name="ID_PESSOA_SUPERVISOR"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="165">
<createIndex tableName="SUPERVISOR_ESTAGIO" indexName="XIF2SUPERVISOR_ESTAGIO">
  <column name="ID_PESSOA_FUNCIONARIO"/>
  <column name="NB_FUNCIONARIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="166">
<createIndex tableName="SUPERVISOR_ESTAGIO" indexName="XIF3SUPERVISOR_ESTAGIO">
  <column name="ID_CONSELHO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="167">
<createTable tableName="CALENDARIO_FOLHA_PAG">
  <column name="ID_CALENDARIO_FOLHA_PAG" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_ANO_REFERENCIA" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_MES_REFERENCIA" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="168">
<addPrimaryKey tableName="CALENDARIO_FOLHA_PAG" constraintName="XPKCALENDARIO_FOLHA_PAG" columnNames="ID_CALENDARIO_FOLHA_PAG"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="169">
<createIndex tableName="CALENDARIO_FOLHA_PAG" indexName="XIF1CALENDARIO_FOLHA_PAG">
  <column name="ID_ORGAO_GESTOR_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="170">
<createTable tableName="ITEM_CALENDARIO">
  <column name="ID_CALENDARIO_FOLHA_PAG" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_GRUPO_PAGAMENTO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_FECHAMENTO" type="DATE"/>
  <column name="DT_ENCAM_DOC" type="DATE"/>
  <column name="DT_TRANSF_BANCO" type="DATE"/>
  <column name="DT_PAGAMENTO" type="DATE"/>
  <column name="DT_INICIO_TRANSF_ESTAG" type="DATE"/>
  <column name="DT_FIM_TRANSF_ESTAG" type="DATE"/>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="171">
<createIndex tableName="ITEM_CALENDARIO" indexName="XIF1ITEM_CALENDARIO">
  <column name="ID_CALENDARIO_FOLHA_PAG"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="172">
<createIndex tableName="ITEM_CALENDARIO" indexName="XIF2ITEM_CALENDARIO">
  <column name="ID_GRUPO_PAGAMENTO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="173">
<createTable tableName="CALENDARIO_ESCOLAR_GE">
  <column name="NB_CALENDARIO_ESCOLAR" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_INICIO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_FIM" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CALENDARIO_ESCOLAR" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="NB_ANO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_ANO_ESCOLAR" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="174">
<addPrimaryKey tableName="CALENDARIO_ESCOLAR_GE" constraintName="IDX_PK_CALENDARIO_ESCOLAR_GE" columnNames="NB_CALENDARIO_ESCOLAR"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="175">
<createTable tableName="BOLSA_ESTAGIO">
  <column name="NB_BOLSA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="CS_TIPO_VAGA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_VALOR" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_BOLSA_ESTAGIO" type="VARCHAR(100)"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="176">
<addPrimaryKey tableName="BOLSA_ESTAGIO" constraintName="BOLSA_ESTAGIO_pk" columnNames="NB_BOLSA_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="177">
<createIndex tableName="BOLSA_ESTAGIO" indexName="XPKBOLSA_ESTAGIO" unique="true">
  <column name="NB_BOLSA_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="178">
<createTable tableName="AREA_CONHECIMENTO_GE">
  <column name="CS_AREA_CONHECIMENTO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_AREA_CONHECIMENTO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="179">
<addPrimaryKey tableName="AREA_CONHECIMENTO_GE" constraintName="IDX_PK_AREA_CONHECIMENTO_GE" columnNames="CS_AREA_CONHECIMENTO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="180">
<createTable tableName="CURSO_ESTAGIO">
  <column name="ID_CURSO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CURSO_ESTAGIO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="CS_AREA_CONHECIMENTO" type="BIGINT"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="181">
<addPrimaryKey tableName="CURSO_ESTAGIO" constraintName="CURSO_ESTAGIO_pk" columnNames="ID_CURSO_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="182">
<createIndex tableName="CURSO_ESTAGIO" indexName="XPKCURSO_ESTAGIO" unique="true">
  <column name="ID_CURSO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="183">
<createIndex tableName="CURSO_ESTAGIO" indexName="XIF1CURSO_ESTAGIO">
  <column name="CS_AREA_CONHECIMENTO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="184">
<createTable tableName="AGENTE_SETORIAL_ESTAGIO">
  <column name="ID_SETORIAL_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATULIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CARGO_FUNCAO" type="VARCHAR(100)"/>
  <column name="TX_CONTATO" type="VARCHAR(200)"/>
  <column name="TX_EMAIL" type="VARCHAR(100)"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="185">
<addPrimaryKey tableName="AGENTE_SETORIAL_ESTAGIO" constraintName="AGENTE_SETORIAL_ESTAGIO_pk" columnNames="ID_SETORIAL_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="186">
<createIndex tableName="AGENTE_SETORIAL_ESTAGIO" indexName="XPKAGENTE_SETORIAL_ESTAGIO" unique="true">
  <column name="ID_SETORIAL_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="187">
<createIndex tableName="AGENTE_SETORIAL_ESTAGIO" indexName="XIF1AGENTE_SETORIAL_ESTAGIO">
  <column name="ID_USUARIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="188">
<createTable tableName="AGENTE_SETORIAL_EMAIL">
  <column name="NB_AGENTE_SETORIAL_EMAIL" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_SETORIAL_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_EMAIL" type="VARCHAR(100)">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="189">
<createIndex tableName="AGENTE_SETORIAL_EMAIL" indexName="AGENTE_SETORIAL_EMAIL_INDEX1">
  <column name="ID_SETORIAL_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="190">
<createTable tableName="AGENCIA_ESTAGIO_EMAIL">
  <column name="ID_AGENCIA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_AGENCIA_ESTAGIO_EMAIL" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_EMAIL" type="VARCHAR(100)">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="191">
<createTable tableName="AGENCIA_ESTAGIO">
  <column name="ID_AGENCIA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_AGENCIA_ESTAGIO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="TX_SIGLA" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CNPJ" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="TX_EMAIL" type="VARCHAR(100)"/>
  <column name="CS_SITUACAO" type="BIGINT"/>
  <column name="TX_COORDENADOR" type="VARCHAR(255)"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="192">
<addPrimaryKey tableName="AGENCIA_ESTAGIO" constraintName="AGENCIA_ESTAGIO_pk" columnNames="ID_AGENCIA_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="193">
<createIndex tableName="AGENCIA_ESTAGIO" indexName="XPKAGENCIA_ESTAGIO" unique="true">
  <column name="ID_AGENCIA_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="194">
<createIndex tableName="AGENCIA_ESTAGIO" indexName="XIF1AGENCIA_ESTAGIO">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="195">
<createIndex tableName="AGENCIA_ESTAGIO" indexName="XIF2AGENCIA_ESTAGIO">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="196">
<createTable tableName="VAGAS_ESTAGIO">
  <column name="ID_QUADRO_VAGAS_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="CS_TIPO_VAGA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_AGENCIA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_QUANTIDADE" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_CURSO_ESTAGIO" type="BIGINT"/>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="197">
<createIndex tableName="VAGAS_ESTAGIO" indexName="XIF1VAGAS_ESTAGIO">
  <column name="ID_QUADRO_VAGAS_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="198">
<createIndex tableName="VAGAS_ESTAGIO" indexName="XIF2VAGAS_ESTAGIO">
  <column name="ID_ORGAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="199">
<createIndex tableName="VAGAS_ESTAGIO" indexName="XIF3VAGAS_ESTAGIO">
  <column name="CS_TIPO_VAGA_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="200">
<createIndex tableName="VAGAS_ESTAGIO" indexName="XIF4VAGAS_ESTAGIO">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="201">
<createIndex tableName="VAGAS_ESTAGIO" indexName="XIF5VAGAS_ESTAGIO">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="202">
<createIndex tableName="VAGAS_ESTAGIO" indexName="XIF6VAGAS_ESTAGIO">
  <column name="ID_CURSO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="203">
<createTable tableName="OFERTA_VAGA">
  <column name="ID_OFERTA_VAGA" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CODIGO_OFERTA_VAGA" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_QUADRO_VAGAS_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_AGENCIA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="CS_TIPO_VAGA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_PESSOA_CONTATO" type="VARCHAR(100)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_TELEFONE" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CARGO_FUNCAO" type="VARCHAR(100)"/>
  <column name="TX_EMAIL" type="VARCHAR(100)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_ENDERECO" type="VARCHAR(200)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_PONTO_REFERENCIA" type="VARCHAR(100)"/>
  <column name="TX_NUM_ONIBUS" type="VARCHAR(20)"/>
  <column name="NB_QUANTIDADE" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_QTDE_EMCAMINHADO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ENTREVISTA" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="TX_HORARIO" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="NB_DURACAO_ESTAGIO" type="BIGINT"/>
  <column name="NB_BOLSA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_VALOR_TRANSPORTE" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="CS_ESCOLARIDADE" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_CURSO_ESTAGIO" type="BIGINT"/>
  <column name="NB_SEMESTRE" type="BIGINT"/>
  <column name="TX_HORA_INICIO" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_HORA_FINAL" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_OUTROS_HORARIOS" type="VARCHAR(100)"/>
  <column name="CS_WINDOWS" type="BIGINT"/>
  <column name="CS_WORD" type="BIGINT"/>
  <column name="CS_EXCEL" type="BIGINT"/>
  <column name="CS_POWERPOINT" type="BIGINT"/>
  <column name="CS_INTERNET" type="BIGINT"/>
  <column name="CS_CORELDRAW" type="BIGINT"/>
  <column name="CS_PHOTOSHOP" type="BIGINT"/>
  <column name="CS_WEBDESIGN" type="BIGINT"/>
  <column name="CS_AUTOCAD" type="BIGINT"/>
  <column name="CS_INGLES" type="BIGINT"/>
  <column name="CS_ESPANHOL" type="BIGINT"/>
  <column name="CS_FRANCES" type="BIGINT"/>
  <column name="CS_ALEMAO" type="BIGINT"/>
  <column name="TX_OUTRAS_LINGUAS" type="VARCHAR(100)"/>
  <column name="TX_OUTROS_REQUISITOS" type="VARCHAR(100)"/>
  <column name="CS_SEXO" type="BIGINT"/>
  <column name="TX_ATIVIDADES" type="VARCHAR(400)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_OBSERVACAO" type="VARCHAR(200)"/>
  <column name="CS_SITUACAO" type="BIGINT" remarks="1-Aberta
2-Efetivada
3-Oferta Encaminhada
4-Cancelada"/>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="204">
<addPrimaryKey tableName="OFERTA_VAGA" constraintName="OFERTA_VAGA_PK" columnNames="ID_OFERTA_VAGA"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="205">
<createTable tableName="SELECAO_ESTAGIO">
  <column name="ID_SELECAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="TX_COD_SELECAO" type="VARCHAR(20)"/>
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="CS_SITUACAO" type="BIGINT" remarks="1-Aberta; 
2-Efetivada; 
3-Selec?o Encaminhada; 
4-Cancelada.">
    <constraints nullable="false"/>
  </column>
  <column name="CS_SELECAO" type="BIGINT" remarks="1 - com oferta, 2 - sem oferta"/>
  <column name="ID_OFERTA_VAGA" type="BIGINT"/>
  <column name="ID_AGENCIA_ESTAGIO" type="BIGINT"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="206">
<addPrimaryKey tableName="SELECAO_ESTAGIO" constraintName="SELECAO_ESTAGIO_pk" columnNames="ID_SELECAO_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="207">
<createIndex tableName="SELECAO_ESTAGIO" indexName="XPKSELECAO_ESTAGIO" unique="true">
  <column name="ID_SELECAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="208">
<createIndex tableName="SELECAO_ESTAGIO" indexName="XIF1SELECAO_ESTAGIO">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="209">
<createIndex tableName="SELECAO_ESTAGIO" indexName="XIF3SELECAO_ESTAGIO">
  <column name="ID_ORGAO_GESTOR_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="210">
<createIndex tableName="SELECAO_ESTAGIO" indexName="XIF4SELECAO_ESTAGIO">
  <column name="ID_ORGAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="211">
<createIndex tableName="SELECAO_ESTAGIO" indexName="XIF5SELECAO_ESTAGIO">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="212">
<createTable tableName="ESTAGIARIO_SELECAO">
  <column name="ID_SELECAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_PESSOA_ESTAGIARIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="CS_SITUACAO" type="BIGINT" remarks="1 - Em Analise; 
2 - Aprovado; 
3 - Reprovado; 
4 - Cancelado; 
5 - Autorizado.">
    <constraints nullable="false"/>
  </column>
  <column name="TX_MOTIVO_SITUACAO" type="VARCHAR(255)"/>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="CS_ESCOLARIDADE" type="BIGINT"/>
  <column name="ID_CURSO_ESTAGIO" type="BIGINT"/>
  <column name="NB_PERIODO_ANO" type="BIGINT"/>
  <column name="CS_TURNO" type="BIGINT"/>
  <column name="ID_INSTITUICAO_ENSINO" type="BIGINT"/>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT"/>
  <column name="CS_TIPO_VAGA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_HORA_INICIO" type="VARCHAR(20)"/>
  <column name="TX_HORA_FINAL" type="VARCHAR(20)"/>
  <column name="ID_BOLSA_ESTAGIO" type="BIGINT"/>
  <column name="ID_PESSOA_SUPERVISOR" type="BIGINT"/>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="CS_CARGA_HORARIA" type="BIGINT"/>
  <column name="TX_ATIVIDADES" type="VARCHAR(400)"/>
  <column name="NB_VALOR_TRANSPORTE" type="BIGINT"/>
  <column name="TX_LOCAL_ESTAGIO" type="VARCHAR(255)"/>
  <column name="DT_INICIO" type="DATE"/>
  <column name="DT_FINAL" type="DATE"/>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="213">
<createIndex tableName="ESTAGIARIO_SELECAO" indexName="ESTAGIARIO_SELECAO_INDEX1">
  <column name="ID_SELECAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="214">
<createIndex tableName="ESTAGIARIO_SELECAO" indexName="XIF4ESTAGIARIO_SELECAO">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="215">
<createTable tableName="PAGAMENTO_ESTAGIO">
  <column name="ID_PAGAMENTO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="NB_ANO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_MES" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="CS_SITUACAO" type="BIGINT" remarks="1 - Aberto
2 - Fechado
3 - Cancelado">
    <constraints nullable="false"/>
  </column>
  <column name="NB_DIAS_UTEIS" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_AGENCIA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="CS_TIPO_PAG_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_INICIO_COMPETENCIA" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_FIM_COMPETENCIA" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_INICIO_FREQUENCIA" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_FIM_FREQUENCIA" type="DATE">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="216">
<addPrimaryKey tableName="PAGAMENTO_ESTAGIO" constraintName="PAGAMENTO_ESTAGIO_pk" columnNames="ID_PAGAMENTO_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="217">
<createIndex tableName="PAGAMENTO_ESTAGIO" indexName="XPKPAGAMENTO_ESTAGIO" unique="true">
  <column name="ID_PAGAMENTO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="218">
<createIndex tableName="PAGAMENTO_ESTAGIO" indexName="XIF1PAGAMENTO_ESTAGIO">
  <column name="ID_ORGAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="219">
<createIndex tableName="PAGAMENTO_ESTAGIO" indexName="XIF2PAGAMENTO_ESTAGIO">
  <column name="ID_ORGAO_GESTOR_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="220">
<createIndex tableName="PAGAMENTO_ESTAGIO" indexName="XIF3PAGAMENTO_ESTAGIO">
  <column name="ID_AGENCIA_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="221">
<createIndex tableName="PAGAMENTO_ESTAGIO" indexName="XIF4PAGAMENTO_ESTAGIO">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="222">
<createIndex tableName="PAGAMENTO_ESTAGIO" indexName="XIF5PAGAMENTO_ESTAGIO">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="223">
<createIndex tableName="PAGAMENTO_ESTAGIO" indexName="XIF6PAGAMENTO_ESTAGIO">
  <column name="CS_TIPO_PAG_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="224">
<createTable tableName="ITEM_PAG_ESTAGIO">
  <column name="ID_PAGAMENTO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ITEM_PAGAMENTO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_CONTRATO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_PROCESSAMENTO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="NB_VALOR_BASE" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_VALOR_CALCULADO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_VALOR_UNITARIO" type="BIGINT"/>
  <column name="NB_QUANTIDADE" type="BIGINT"/>
  <column name="ID_USUARIO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="225">
<createIndex tableName="ITEM_PAG_ESTAGIO" indexName="XPKITEM_PAG_ESTAGIO" unique="true">
  <column name="ID_PAGAMENTO_ESTAGIO"/>
  <column name="ID_ITEM_PAGAMENTO_ESTAGIO"/>
  <column name="ID_CONTRATO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="226">
<createIndex tableName="ITEM_PAG_ESTAGIO" indexName="XIF1ITEM_PAG_ESTAGIO">
  <column name="ID_PAGAMENTO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="227">
<createIndex tableName="ITEM_PAG_ESTAGIO" indexName="XIF2ITEM_PAG_ESTAGIO">
  <column name="ID_ITEM_PAGAMENTO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="228">
<createIndex tableName="ITEM_PAG_ESTAGIO" indexName="XIF3ITEM_PAG_ESTAGIO">
  <column name="ID_USUARIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="229">
<createIndex tableName="ITEM_PAG_ESTAGIO" indexName="XIF4ITEM_PAG_ESTAGIO">
  <column name="ID_CONTRATO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="230">
<createTable tableName="CONTRATO_ESTAGIO">
  <column name="ID_CONTRATO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_PESSOA_ESTAGIARIO" type="BIGINT" remarks="E o identificador unico das pessoa fisicas.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_QUADRO_VAGAS_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_CURSO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_PESSOA_SUPERVISOR" type="BIGINT" remarks="E o identificador unico das pessoa fisicas.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_INSTITUICAO_ENSINO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_BOLSA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_INICIO_VIGENCIA" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_DESLIGAMENTO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_FIM_VIGENCIA" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="NB_INICIO_HORARIO" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="NB_FIM_HORARIO" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_PLANO_ATIVIDADE" type="VARCHAR(2000)">
    <constraints nullable="false"/>
  </column>
  <column name="CS_TIPO" type="BIGINT" remarks="1 - Contrato Inicial
2 - Aditivo Contratual">
    <constraints nullable="false"/>
  </column>
  <column name="TX_TCE" type="VARCHAR(20)"/>
  <column name="ID_UNIDADE_ORG" type="BIGINT" remarks="Identificador unico de uma unidade organizacional.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_SELECAO_ESTAGIO" type="BIGINT"/>
  <column name="ID_RECRUTAMENTO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_VAGAS_RECRUTAMENTO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_CANDIDATO" type="BIGINT"/>
  <column name="CS_TIPO_VAGA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="CS_PERIODO" type="BIGINT" remarks="1 - 1 ano
2 - 2 ano
3 - 3 ano
4 - 4 ano
5 - 5 ano
6 - 1 periodo
7 - 2 periodo
8 - 3 periodo
9 - 4 periodo
10 - 5 periodo
11 - 6 periodo
12 - 7 periodo
13 - 8 periodo
14 - 9 periodo
15 - 10 periodo">
    <constraints nullable="false"/>
  </column>
  <column name="CS_HORARIO_CURSO" type="BIGINT" remarks="1 - Manh?
2 - Tarde
3 - Noite">
    <constraints nullable="false"/>
  </column>
  <column name="ID_AGENCIA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_EMAIL" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_TELEFONE" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_ENDERECO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CODIGO" type="VARCHAR(20)"/>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="CS_SELECAO" type="BIGINT" remarks="1 - Com selec?o 2 - Sem selec?o">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>

<changeSet author="Rodrigo Cabral" id="231">
<createIndex tableName="CONTRATO_ESTAGIO" indexName="XPKCONTRATO_ESTAGIO" unique="true">
  <column name="ID_CONTRATO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="232">
<createIndex tableName="CONTRATO_ESTAGIO" indexName="XIF1CONTRATO_ESTAGIO">
  <column name="ID_PESSOA_ESTAGIARIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="233">
<createIndex tableName="CONTRATO_ESTAGIO" indexName="XIF10CONTRATO_ESTAGIO">
  <column name="ID_UNIDADE_ORG"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="234">
<createIndex tableName="CONTRATO_ESTAGIO" indexName="XIF11CONTRATO_ESTAGIO">
  <column name="ID_SELECAO_ESTAGIO"/>
  <column name="ID_RECRUTAMENTO_ESTAGIO"/>
  <column name="NB_VAGAS_RECRUTAMENTO"/>
  <column name="NB_CANDIDATO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="235">
<createIndex tableName="CONTRATO_ESTAGIO" indexName="XIF12CONTRATO_ESTAGIO">
  <column name="ID_AGENCIA_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="236">
<createIndex tableName="CONTRATO_ESTAGIO" indexName="XIF2CONTRATO_ESTAGIO">
  <column name="ID_ORGAO_GESTOR_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="237">
<createIndex tableName="CONTRATO_ESTAGIO" indexName="XIF3CONTRATO_ESTAGIO">
  <column name="ID_ORGAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="238">
<createIndex tableName="CONTRATO_ESTAGIO" indexName="XIF4CONTRATO_ESTAGIO">
  <column name="ID_QUADRO_VAGAS_ESTAGIO"/>
  <column name="ID_ORGAO_ESTAGIO"/>
  <column name="CS_TIPO_VAGA_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="239">
<createIndex tableName="CONTRATO_ESTAGIO" indexName="XIF5CONTRATO_ESTAGIO">
  <column name="ID_CURSO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="240">
<createIndex tableName="CONTRATO_ESTAGIO" indexName="XIF6CONTRATO_ESTAGIO">
  <column name="ID_PESSOA_SUPERVISOR"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="241">
<createIndex tableName="CONTRATO_ESTAGIO" indexName="XIF7CONTRATO_ESTAGIO">
  <column name="ID_INSTITUICAO_ENSINO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="242">
<createIndex tableName="CONTRATO_ESTAGIO" indexName="XIF8CONTRATO_ESTAGIO">
  <column name="ID_BOLSA_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="243">
<createTable tableName="SOLICITACAO_TR">
  <column name="ID_SOLICITACAO_TR" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CODIGO" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CARGO_AGENTE" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_EMAIL_AGENTE" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_TELEFONE_AGENTE" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="DT_TERMINO_ESTAGIO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="TX_MOTIVO" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_OBSERVACAO" type="VARCHAR(255)"/>
  <column name="ID_CONTRATO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_SETORIAL_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="CS_SITUACAO" type="BIGINT" remarks="1 - Aberta
2 - Fechada">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="244">
<addPrimaryKey tableName="SOLICITACAO_TR" constraintName="XPKSOLICITACAO_TR" columnNames="ID_SOLICITACAO_TR"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="245">
<createIndex tableName="SOLICITACAO_TR" indexName="XIF1SOLICITACAO_TR">
  <column name="ID_CONTRATO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="246">
<createIndex tableName="SOLICITACAO_TR" indexName="XIF2SOLICITACAO_TR">
  <column name="ID_SETORIAL_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="247">
<createIndex tableName="SOLICITACAO_TR" indexName="XIF4SOLICITACAO_TR">
  <column name="ID_ORGAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="248">
<createIndex tableName="SOLICITACAO_TR" indexName="XIF5SOLICITACAO_TR">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="249">
<createIndex tableName="SOLICITACAO_TR" indexName="XIF6SOLICITACAO_TR">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="250">
<createTable tableName="SOLICITACAO_TA">
  <column name="ID_SOLICITACAO_TA" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CODIGO" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="TX_FONE_AGENTE" type="VARCHAR(20)"/>
  <column name="TX_CARGO_AGENTE" type="VARCHAR(255)"/>
  <column name="TX_EMAIL_AGENTE" type="VARCHAR(255)"/>
  <column name="DT_INICIO_PRORROGACAO" type="DATE"/>
  <column name="DT_FIM_PRORROGACAO" type="DATE"/>
  <column name="DT_INICIO_RECESSO" type="DATE"/>
  <column name="DT_FIM_RECESSO" type="DATE"/>
  <column name="DT_INICIO_JORNADA" type="DATE"/>
  <column name="TX_HORAS_JORNADA" type="VARCHAR(20)"/>
  <column name="TX_INICIO_HORARIO" type="VARCHAR(20)"/>
  <column name="TX_FIM_HORARIO" type="VARCHAR(20)"/>
  <column name="NB_VALOR_BOLSA" type="BIGINT"/>
  <column name="DT_INICIO_PAG_BOLSA" type="DATE"/>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_CONTRATO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_AGENCIA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_SETORIAL_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="CS_SITUACAO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_MOTIVO_SITUACAO" type="VARCHAR(255)"/>
  <column name="TX_OUTRAS_ALTERACOES" type="VARCHAR(2000)"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="251">
<addPrimaryKey tableName="SOLICITACAO_TA" constraintName="XPKSOLICITACAO_TA" columnNames="ID_SOLICITACAO_TA"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="252">
<createIndex tableName="SOLICITACAO_TA" indexName="XIF14SOLICITACAO_TA">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="253">
<createIndex tableName="SOLICITACAO_TA" indexName="XIF15SOLICITACAO_TA">
  <column name="ID_CONTRATO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="254">
<createIndex tableName="SOLICITACAO_TA" indexName="XIF16SOLICITACAO_TA">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="255">
<createIndex tableName="SOLICITACAO_TA" indexName="XIF17SOLICITACAO_TA">
  <column name="ID_AGENCIA_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="256">
<createIndex tableName="SOLICITACAO_TA" indexName="XIF18SOLICITACAO_TA">
  <column name="ID_ORGAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="257">
<createIndex tableName="SOLICITACAO_TA" indexName="XIF19SOLICITACAO_TA">
  <column name="ID_ORGAO_GESTOR_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="258">
<createIndex tableName="SOLICITACAO_TA" indexName="XIF20SOLICITACAO_TA">
  <column name="ID_SETORIAL_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="259">
<createTable tableName="SOLICITACAO_DESLIG">
  <column name="ID_SOLICITACAO_DESLIG" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_SOLICITACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CODIGO" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_OFICIO" type="VARCHAR(20)"/>
  <column name="DT_DESLIGAMENTO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="ID_CONTRATO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="CS_SITUACAO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_SETORIAL_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="260">
<addPrimaryKey tableName="SOLICITACAO_DESLIG" constraintName="XPKSOLICITACAO_DESLIG" columnNames="ID_SOLICITACAO_DESLIG"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="261">
<createTable tableName="RECESSO_ESTAGIO">
  <column name="ID_RECESSO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CODIGO" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_CARGO_AGENTE" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_EMAIL_AGENTE" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="TX_TELEFONE_AGENTE" type="VARCHAR(255)">
    <constraints nullable="false"/>
  </column>
  <column name="DT_INICIO_VIG_ESTAGIO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="TX_JUSTIFICATIVA_ADIAMENTO" type="VARCHAR(255)"/>
  <column name="DT_ADIAMENTO" type="DATE"/>
  <column name="ID_CONTRATO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_SETORIAL_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_AGENCIA_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD."/>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD."/>
  <column name="CS_SITUACAO" type="BIGINT" remarks="1 - Aberta
2 - Fechada">
    <constraints nullable="false"/>
  </column>
  <column name="DT_FIM_VIGENCIA_ESTAGIO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_INICIO_RECESSO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_FIM_RECESSO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="NB_MES_REFERENCIA" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="NB_ANO_REFERENCIA" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ASSINATURA" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="TX_MATRICULA" type="VARCHAR(20)"/>
  <column name="NB_DIAS_RESTANTES" type="BIGINT"/>
  <column name="TX_CHEFIA_IMEDIATA" type="VARCHAR(255)"/>
  <column name="CS_REALIZACAO" type="BIGINT" remarks="1 - Realizado
2 - Postergado Totalmente
3 - Postergado Parcialmente">
    <constraints nullable="false"/>
  </column>
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="262">
<addPrimaryKey tableName="RECESSO_ESTAGIO" constraintName="XPKRECESSO_ESTAGIO" columnNames="ID_RECESSO_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="263">
<createIndex tableName="RECESSO_ESTAGIO" indexName="XIF1RECESSO_ESTAGIO">
  <column name="ID_CONTRATO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="264">
<createIndex tableName="RECESSO_ESTAGIO" indexName="XIF2RECESSO_ESTAGIO">
  <column name="ID_ORGAO_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="265">
<createIndex tableName="RECESSO_ESTAGIO" indexName="XIF3RECESSO_ESTAGIO">
  <column name="ID_AGENCIA_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="266">
<createIndex tableName="RECESSO_ESTAGIO" indexName="XIF6RECESSO_ESTAGIO">
  <column name="ID_SETORIAL_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="267">
<createIndex tableName="RECESSO_ESTAGIO" indexName="XIF7RECESSO_ESTAGIO">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="268">
<createIndex tableName="RECESSO_ESTAGIO" indexName="XIF8RECESSO_ESTAGIO">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="269">
<createTable tableName="ADITIVO_CONTRATO_CP">
  <column name="ID_ADITIVO_CONTRATO_CP" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="DT_CADASTRO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ATUALIZACAO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="NB_CODIGO" type="VARCHAR(20)">
    <constraints nullable="false"/>
  </column>
  <column name="DT_ADITIVO" type="DATE">
    <constraints nullable="false"/>
  </column>
  <column name="TX_OBJETO" type="VARCHAR(2000)"/>
  <column name="ID_CONTRATO_CP" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_CADASTRO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="ID_USUARIO_ATUALIZACAO" type="BIGINT" remarks="Codigo do usuario do BD.">
    <constraints nullable="false"/>
  </column>
  <column name="DT_INICIO_VIGENCIA" type="DATE"/>
  <column name="DT_FIM_VIGENCIA" type="DATE"/>
  <column name="NB_VALOR_ESTIMADO" type="BIGINT"/>
  <column name="ID_ORGAO_GESTOR_ESTAGIO" type="BIGINT">
    <constraints nullable="false"/>
  </column>
  <column name="TX_TERMO_ADITIVO" type="VARCHAR(80)">
    <constraints nullable="false"/>
  </column>
  <column name="ID_AGENCIA_ESTAGIO" type="BIGINT"/>
</createTable>
</changeSet>
<changeSet author="Rodrigo Cabral" id="270">
<addPrimaryKey tableName="ADITIVO_CONTRATO_CP" constraintName="XPKADITIVO_CONTRATO_CP" columnNames="ID_ADITIVO_CONTRATO_CP"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="271">
<createIndex tableName="ADITIVO_CONTRATO_CP" indexName="XIF1ADITIVO_CONTRATO_CP">
  <column name="ID_CONTRATO_CP"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="272">
<createIndex tableName="ADITIVO_CONTRATO_CP" indexName="XIF2ADITIVO_CONTRATO_CP">
  <column name="ID_USUARIO_CADASTRO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="273">
<createIndex tableName="ADITIVO_CONTRATO_CP" indexName="XIF3ADITIVO_CONTRATO_CP">
  <column name="ID_USUARIO_ATUALIZACAO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="274">
<createIndex tableName="ADITIVO_CONTRATO_CP" indexName="XIF4ADITIVO_CONTRATO_CP">
  <column name="ID_ORGAO_GESTOR_ESTAGIO"/>
</createIndex>
</changeSet>

<changeSet author="Rodrigo Cabral" id="275">
<addForeignKeyConstraint baseTableName="ADITIVO_CONTRATO_CP" constraintName="R_3026" baseColumnNames="ID_ORGAO_GESTOR_ESTAGIO" referencedTableName="ORGAO_GESTOR_ESTAGIO" referencedColumnNames="ID_ORGAO_GESTOR_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="276">
<addForeignKeyConstraint baseTableName="ESTAGIARIO_VAGA" constraintName="R_2914" baseColumnNames="ID_RECRUTAMENTO_ESTAGIO, NB_VAGAS_RECRUTAMENTO" referencedTableName="VAGAS_RECRUTAMENTO" referencedColumnNames="ID_RECRUTAMENTO_ESTAGIO, NB_VAGAS_RECRUTAMENTO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="277">
<addForeignKeyConstraint baseTableName="ADITIVO_CONTRATO_CP" constraintName="R_3009" baseColumnNames="ID_USUARIO_ATUALIZACAO" referencedTableName="USUARIO" referencedColumnNames="ID_USUARIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="278">
<addForeignKeyConstraint baseTableName="ADITIVO_CONTRATO_CP" constraintName="R_3008" baseColumnNames="ID_USUARIO_CADASTRO" referencedTableName="USUARIO" referencedColumnNames="ID_USUARIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="279">
<addForeignKeyConstraint baseTableName="CONTRATO_ESTAGIO" constraintName="SYS_C0032063" baseColumnNames="ID_UNIDADE_ORG" referencedTableName="UNIDADE_ORG" referencedColumnNames="ID_UNIDADE_ORG" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="280">
<addForeignKeyConstraint baseTableName="ESTAGIARIO_SELECAO" constraintName="ESTAGIARIO_SELECAO_TIPO_V_FK1" baseColumnNames="CS_TIPO_VAGA_ESTAGIO" referencedTableName="TIPO_VAGA_ESTAGIO" referencedColumnNames="CS_TIPO_VAGA_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="281">
<addForeignKeyConstraint baseTableName="PAGAMENTO_ESTAGIO" constraintName="SYS_C0032846" baseColumnNames="CS_TIPO_PAG_ESTAGIO" referencedTableName="TIPO_PAG_ESTAGIO" referencedColumnNames="CS_TIPO_PAG_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="282">
<addForeignKeyConstraint baseTableName="ITEM_TAB_RECESSO" constraintName="R_2992" baseColumnNames="ID_TABELA_RECESSO" referencedTableName="TABELA_RECESSO" referencedColumnNames="ID_TABELA_RECESSO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="283">
<addForeignKeyConstraint baseTableName="ESTAGIARIO" constraintName="SYS_C0032282" baseColumnNames="ID_PESSOA_ESTAGIARIO" referencedTableName="PESSOA_FISICA" referencedColumnNames="ID_PESSOA" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="284">
<addForeignKeyConstraint baseTableName="EMAIL_GESTOR_ESTAGIO" constraintName="ORGAO_ESTAGIO_EMAIL_GESTOR_ESTAGIO_fk" baseColumnNames="ID_ORGAO_ESTAGIO" referencedTableName="ORGAO_ESTAGIO" referencedColumnNames="ID_ORGAO_ESTAGIO"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="285">
<addForeignKeyConstraint baseTableName="ITEM_PAG_ESTAGIO" constraintName="SYS_C0032597" baseColumnNames="ID_ITEM_PAGAMENTO_ESTAGIO" referencedTableName="ITEM_PAGAMENTO_ESTAGIO" referencedColumnNames="ID_ITEM_PAGAMENTO_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="286">
<addForeignKeyConstraint baseTableName="VALOR_BASE_ITEM_PAG" constraintName="SYS_C0033391" baseColumnNames="ID_ITEM_PAGAMENTO_ESTAGIO" referencedTableName="ITEM_PAGAMENTO_ESTAGIO" referencedColumnNames="ID_ITEM_PAGAMENTO_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="287">
<addForeignKeyConstraint baseTableName="CONTRATO_ESTAGIO" constraintName="SYS_C0032064" baseColumnNames="ID_INSTITUICAO_ENSINO" referencedTableName="INSTITUICAO_ENSINO" referencedColumnNames="ID_INSTITUICAO_ENSINO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="288">
<addForeignKeyConstraint baseTableName="ITEM_CALENDARIO" constraintName="R_3030" baseColumnNames="ID_GRUPO_PAGAMENTO" referencedTableName="GRUPO_PAGAMENTO" referencedColumnNames="ID_GRUPO_PAGAMENTO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="289">
<addForeignKeyConstraint baseTableName="ESTAGIARIO" constraintName="SYS_C0032281" baseColumnNames="ID_PESSOA_FUNCIONARIO, NB_FUNCIONARIO" referencedTableName="FUNCIONARIO_PE" referencedColumnNames="ID_PESSOA_FUNCIONARIO, NB_FUNCIONARIO" onDelete="SET NULL" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="290">
<addForeignKeyConstraint baseTableName="CONTRATO_ESTAGIO" constraintName="SYS_C0032067" baseColumnNames="ID_PESSOA_ESTAGIARIO" referencedTableName="ESTAGIARIO" referencedColumnNames="ID_PESSOA_ESTAGIARIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="291">
<addForeignKeyConstraint baseTableName="DADOS_COMP_CONT_GC" constraintName="R_3205" baseColumnNames="ID_CONTRATO_GC" referencedTableName="CONTRATO_GC" referencedColumnNames="ID_CONTRATO_GC" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="292">
<addForeignKeyConstraint baseTableName="EVENTO_CONTRATO_GC" constraintName="R_3236" baseColumnNames="ID_CONTRATO_GC" referencedTableName="CONTRATO_GC" referencedColumnNames="ID_CONTRATO_GC" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="293">
<addForeignKeyConstraint baseTableName="QUADRO_VAGAS_ESTAGIO" constraintName="R_3755" baseColumnNames="ID_CONTRATO_GC" referencedTableName="CONTRATO_GC" referencedColumnNames="ID_CONTRATO_GC" onDelete="SET NULL" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="294">
<addForeignKeyConstraint baseTableName="RECRUTAMENTO_ESTAGIO" constraintName="SYS_C0033026" baseColumnNames="ID_QUADRO_VAGAS_ESTAGIO" referencedTableName="QUADRO_VAGAS_ESTAGIO" referencedColumnNames="ID_QUADRO_VAGAS_ESTAGIO" onDelete="SET NULL" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="295">
<addForeignKeyConstraint baseTableName="SOLICITACAO_ESTAGIO" constraintName="SYS_C0033182" baseColumnNames="ID_QUADRO_VAGAS_ESTAGIO" referencedTableName="QUADRO_VAGAS_ESTAGIO" referencedColumnNames="ID_QUADRO_VAGAS_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="296">
<addForeignKeyConstraint baseTableName="TRANSFERENCIA_VAGAS" constraintName="R_3023" baseColumnNames="ID_QUADRO_VAGAS_ESTAGIO" referencedTableName="QUADRO_VAGAS_ESTAGIO" referencedColumnNames="ID_QUADRO_VAGAS_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="297">
<addForeignKeyConstraint baseTableName="VAGAS_ESTAGIO" constraintName="SYS_C0033382" baseColumnNames="ID_QUADRO_VAGAS_ESTAGIO" referencedTableName="QUADRO_VAGAS_ESTAGIO" referencedColumnNames="ID_QUADRO_VAGAS_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="298">
<addForeignKeyConstraint baseTableName="VAGAS_TRANSFERIDAS" constraintName="R_2903" baseColumnNames="ID_TRANSFERENCIA_ESTAGIO" referencedTableName="TRANSFERENCIA_VAGAS" referencedColumnNames="ID_TRANSFERENCIA_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="299">
<addForeignKeyConstraint baseTableName="RECRUTAMENTO_ESTAGIO" constraintName="RECRUTAMENTO_ESTAGIO_SOLI_FK1" baseColumnNames="ID_SOLICITACAO_ESTAGIO" referencedTableName="SOLICITACAO_ESTAGIO" referencedColumnNames="ID_SOLICITACAO_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="300">
<addForeignKeyConstraint baseTableName="ADITIVO_CONTRATO_CP" constraintName="R_3007" baseColumnNames="ID_CONTRATO_CP" referencedTableName="CONTRATO_CP" referencedColumnNames="ID_CONTRATO_CP" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="301">
<addForeignKeyConstraint baseTableName="SUPERVISOR_ESTAGIO" constraintName="SYS_C0033207" baseColumnNames="ID_CONSELHO" referencedTableName="CONSELHO_PROFISSIONAL" referencedColumnNames="ID_CONSELHO" onDelete="SET NULL" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="302">
<addForeignKeyConstraint baseTableName="CONTRATO_ESTAGIO" constraintName="SYS_C0032071" baseColumnNames="ID_PESSOA_SUPERVISOR" referencedTableName="SUPERVISOR_ESTAGIO" referencedColumnNames="ID_PESSOA_SUPERVISOR" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="303">
<addForeignKeyConstraint baseTableName="ITEM_CALENDARIO" constraintName="R_3029" baseColumnNames="ID_CALENDARIO_FOLHA_PAG" referencedTableName="CALENDARIO_FOLHA_PAG" referencedColumnNames="ID_CALENDARIO_FOLHA_PAG" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="304">
<addForeignKeyConstraint baseTableName="CURSO_ESTAGIO" constraintName="SYS_C0032109" baseColumnNames="CS_AREA_CONHECIMENTO" referencedTableName="AREA_CONHECIMENTO_GE" referencedColumnNames="CS_AREA_CONHECIMENTO" onDelete="SET NULL" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="305">
<addForeignKeyConstraint baseTableName="CONTRATO_ESTAGIO" constraintName="SYS_C0032065" baseColumnNames="ID_CURSO_ESTAGIO" referencedTableName="CURSO_ESTAGIO" referencedColumnNames="ID_CURSO_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="306">
<addForeignKeyConstraint baseTableName="AGENTE_SETORIAL_EMAIL" constraintName="AGENTE_SETORIAL_EMAIL_AGE_FK1" baseColumnNames="ID_SETORIAL_ESTAGIO" referencedTableName="AGENTE_SETORIAL_ESTAGIO" referencedColumnNames="ID_SETORIAL_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="307">
<addForeignKeyConstraint baseTableName="CONTRATO_ESTAGIO" constraintName="SYS_C0032068" baseColumnNames="ID_AGENCIA_ESTAGIO" referencedTableName="AGENCIA_ESTAGIO" referencedColumnNames="ID_AGENCIA_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="308">
<addForeignKeyConstraint baseTableName="PAGAMENTO_ESTAGIO" constraintName="SYS_C0032849" baseColumnNames="ID_AGENCIA_ESTAGIO" referencedTableName="AGENCIA_ESTAGIO" referencedColumnNames="ID_AGENCIA_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="309">
<addForeignKeyConstraint baseTableName="RECESSO_ESTAGIO" constraintName="R_2999" baseColumnNames="ID_AGENCIA_ESTAGIO" referencedTableName="AGENCIA_ESTAGIO" referencedColumnNames="ID_AGENCIA_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="310">
<addForeignKeyConstraint baseTableName="SOLICITACAO_TA" constraintName="R_2982" baseColumnNames="ID_AGENCIA_ESTAGIO" referencedTableName="AGENCIA_ESTAGIO" referencedColumnNames="ID_AGENCIA_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="311">
<addForeignKeyConstraint baseTableName="VAGAS_ESTAGIO" constraintName="VAGAS_ESTAGIO_AGENCIA_EST_FK1" baseColumnNames="ID_AGENCIA_ESTAGIO" referencedTableName="AGENCIA_ESTAGIO" referencedColumnNames="ID_AGENCIA_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="312">
<addForeignKeyConstraint baseTableName="OFERTA_VAGA" constraintName="OFERTA_VAGA_VAGAS_ESTAGIO_FK1" baseColumnNames="ID_QUADRO_VAGAS_ESTAGIO, ID_ORGAO_ESTAGIO, CS_TIPO_VAGA_ESTAGIO, ID_AGENCIA_ESTAGIO" referencedTableName="VAGAS_ESTAGIO" referencedColumnNames="ID_QUADRO_VAGAS_ESTAGIO, ID_ORGAO_ESTAGIO, CS_TIPO_VAGA_ESTAGIO, ID_AGENCIA_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="313">
<addForeignKeyConstraint baseTableName="SELECAO_ESTAGIO" constraintName="SELECAO_ESTAGIO_OFERTA_VA_FK1" baseColumnNames="ID_OFERTA_VAGA" referencedTableName="OFERTA_VAGA" referencedColumnNames="ID_OFERTA_VAGA" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="314">
<addForeignKeyConstraint baseTableName="ESTAGIARIO_SELECAO" constraintName="SYS_C0032284" baseColumnNames="ID_SELECAO_ESTAGIO" referencedTableName="SELECAO_ESTAGIO" referencedColumnNames="ID_SELECAO_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="315">
<addForeignKeyConstraint baseTableName="ITEM_PAG_ESTAGIO" constraintName="SYS_C0032598" baseColumnNames="ID_PAGAMENTO_ESTAGIO" referencedTableName="PAGAMENTO_ESTAGIO" referencedColumnNames="ID_PAGAMENTO_ESTAGIO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="316">
<addForeignKeyConstraint baseTableName="RECESSO_ESTAGIO" constraintName="R_2997" baseColumnNames="ID_CONTRATO" referencedTableName="CONTRATO_ESTAGIO" referencedColumnNames="ID_CONTRATO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="317">
<addForeignKeyConstraint baseTableName="SOLICITACAO_DESLIG" constraintName="R_3032" baseColumnNames="ID_CONTRATO" referencedTableName="CONTRATO_ESTAGIO" referencedColumnNames="ID_CONTRATO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="318">
<addForeignKeyConstraint baseTableName="SOLICITACAO_TA" constraintName="R_2980" baseColumnNames="ID_CONTRATO" referencedTableName="CONTRATO_ESTAGIO" referencedColumnNames="ID_CONTRATO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>

<changeSet author="Rodrigo Cabral" id="319">
<addForeignKeyConstraint baseTableName="SOLICITACAO_TR" constraintName="R_2986" baseColumnNames="ID_CONTRATO" referencedTableName="CONTRATO_ESTAGIO" referencedColumnNames="ID_CONTRATO" onDelete="RESTRICT" onUpdate="CASCADE"/>
</changeSet>
