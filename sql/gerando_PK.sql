DROP SEQUENCE semad.S_Solicitacao_Estagio;

CREATE  SEQUENCE semad.S_Solicitacao_Estagio
minvalue 1
maxvalue 9999999999999999999999999999
start with 1
increment by 1
nocache;

DROP PUBLIC SYNONYM F_G_PK_Solicitacao_Estagio;

CREATE OR REPLACE FUNCTION semad.F_G_PK_Solicitacao_Estagio RETURN NUMBER IS
V_S_Solicitacao_Estagio NUMBER;
BEGIN
SELECT S_Solicitacao_Estagio.NEXTVAL
INTO V_S_Solicitacao_Estagio
FROM SYS.DUAL;
RETURN V_S_Solicitacao_Estagio;
END;

CREATE PUBLIC SYNONYM F_G_PK_Solicitacao_Estagio FOR semad.F_G_PK_Solicitacao_Estagio;
