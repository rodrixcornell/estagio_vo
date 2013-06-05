<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioSupervisor extends Repositorio {
    
function pesquisarConselho($VO){
        $query =" SELECT ID_CONSELHO CODIGO,
                         TX_CONSELHO       
                  FROM CONSELHO_PROFISSIONAL 
        
          ";
        
        return $this->sqlVetor($query);
  }
         
function pesquisarFuncionario($VO){
$query ="SELECT 
                A.ID_PESSOA_FUNCIONARIO||'_'||A.NB_FUNCIONARIO CODIGO, C.TX_NOME 
           FROM FUNCIONARIO_PE A, PESSOA_FISICA B, PESSOA C
          WHERE A.ID_PESSOA_FUNCIONARIO = B.ID_PESSOA
            AND B.ID_PESSOA = C.ID_PESSOA
       ORDER BY TX_NOME          
";

                        
//print_r($query);
        return $this->sqlVetor($query);
    }
    

    function pesquisar($VO){

        $query = " 
                          SELECT 
                                   SUPERVISOR_ESTAGIO.ID_PESSOA_SUPERVISOR,
                                   SUPERVISOR_ESTAGIO.ID_PESSOA_FUNCIONARIO,
                                   SUPERVISOR_ESTAGIO.NB_FUNCIONARIO,
                                   SUPERVISOR_ESTAGIO.TX_CURRICULO,
                                   SUPERVISOR_ESTAGIO.ID_CONSELHO,
                                   SUPERVISOR_ESTAGIO.NB_INSCRICAO_CONSELHO,
                                   SUPERVISOR_ESTAGIO.TX_FORMACAO,
                                   SUPERVISOR_ESTAGIO.TX_CARGO TX_CARGO,
                                   CONSELHO_PROFISSIONAL.ID_CONSELHO CODIGO,
                                   CONSELHO_PROFISSIONAL.TX_CONSELHO TX_CONSELHO,
                                   USUARIO.ID_PESSOA_FUNCIONARIO,
                                   USUARIO.ID_USUARIO,
                                   USUARIO.TX_LOGIN,
                                   PESSOA.ID_PESSOA,
                                   PESSOA.TX_NOME TX_NOME,
                                   V_PERFIL_USUARIO.ID_USUARIO,
                                   V_PERFIL_USUARIO.ID_SISTEMA,
                                   FUNCIONARIO_PE.ID_PESSOA_FUNCIONARIO,
                                   FUNCIONARIO_PE.NB_INSCRICAO_CONSELHO
                                   
                              FROM SUPERVISOR_ESTAGIO,
                                   CONSELHO_PROFISSIONAL,
                                   PESSOA,
                                   V_PERFIL_USUARIO,
                                   USUARIO,
                                   FUNCIONARIO_PE 
                                   
                             WHERE SUPERVISOR_ESTAGIO.ID_CONSELHO = CONSELHO_PROFISSIONAL.ID_CONSELHO
                                   AND SUPERVISOR_ESTAGIO.ID_PESSOA_FUNCIONARIO = USUARIO.ID_PESSOA_FUNCIONARIO
                                   AND USUARIO.ID_PESSOA_FUNCIONARIO = PESSOA.ID_PESSOA
                                   AND PESSOA.ID_PESSOA = V_PERFIL_USUARIO.ID_USUARIO
                            
    
  ";
        $cond = " AND ";
        if ($VO->TX_CARGO) {
            $query .= $cond ." upper(TX_CARGO) like upper('%" .$VO->TX_CARGO. "%')";
            $cond = " AND ";
        }
       
         $cond = " AND ";
         if ($VO->NB_INSCRICAO_CONSELHO ) {
            $query .= $cond . " TX_NOME = '" . $VO->NB_INSCRICAO_CONSELHO . "' ";
            $cond = " AND ";
        }
        
    
        $query .= " ORDER BY  TX_NOME";
        //carregar
        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }
      //print_r($query);
        return $this->sqlVetor($query);
        
    }

//INSERIR 
  
   function inserir($VO){

        $query = "
            INSERT INTO SUPERVISOR_ESTAGIO(ID_PESSOA_SUPERVISOR,ID_PESSOA_FUNCIONARIO,NB_FUNCIONARIO,TX_CURRICULO,TX_FORMACAO,ID_CONSELHO,NB_INSCRICAO_CONSELHO,TX_CARGO) 
            VALUES
(SEMAD.F_G_PK_SUPERVISOR_ESTAGIO(),'".$VO->ID_PESSOA_FUNCIONARIO."','".$VO->NB_FUNCIONARIO."','".$VO->TX_CURRICULO."','".$VO->TX_FORMACAO."','".$VO->ID_CONSELHO."','".$VO->NB_INSCRICAO_CONSELHO."','".$VO->TX_CARGO."') ";
       print_r($query); 	
        return $this->sql($query);
      
   }
    
//ALTERAR 
    function alterar($VO) {
        $query = "UPDATE SUPERVISOR_ESTAGIO SET 
                                           ID_PESSOA_FUNCIONARIO = '".$VO->ID_PESSOA_FUNCIONARIO."',
                                           NB_FUNCIONARIO = '".$VO->NB_FUNCIONARIO."',
                                           TX_CURRICULO = '".$VO->TX_CURRICULO."',
                                           TX_FORMACAO = '".$VO->TX_FORMACAO."',
                                           ID_CONSELHO = '".$VO->ID_CONSELHO."',
                                           NB_INSCRICAO_CONSELHO = '".$VO->NB_INSCRICAO_CONSELHO."',
                                           TX_CARGO = '".$VO->TX_CARGO."'
                                          
			            WHERE  ID_PESSOA_SUPERVISOR = '".$VO->ID_PESSOA_SUPERVISOR."'";
        return $this->sql($query);
    }

    //EXCLUIR 
    function excluir($VO) {
        $query = "delete from  AGENCIA_ESTAGIO where TX_AGENCIA_ESTAGIO = '".$VO->TX_AGENCIA_ESTAGIO."'";

        return $this->sql($query);
    }

//BUSCAR 
    function buscar($VO) {
$query = "SELECT S.ID_PESSOA_SUPERVISOR,
                 S.ID_PESSOA_FUNCIONARIO,
                 S.NB_FUNCIONARIO,
                 S.TX_CURRICULO,
                 S.ID_CONSELHO,
                 S.NB_INSCRICAO_CONSELHO,
                 S.TX_FORMACAO,
                 S.TX_CARGO
            FROM SUPERVISOR_ESTAGIO S

  ";
  
       
        return $this->sqlVetor($query);
    }
}
        
?>