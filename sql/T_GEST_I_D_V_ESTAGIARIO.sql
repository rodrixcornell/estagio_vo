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