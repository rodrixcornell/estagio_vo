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