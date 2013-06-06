<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioSupervisor extends Repositorio {
    
function pesquisarConselho($VO){
        $query =" SELECT 
                         ID_CONSELHO CODIGO,
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

        return $this->sqlVetor($query);
    }
    
function pesquisar($VO){

        $query = "
        SELECT 
              SUPERVISOR_ESTAGIO.ID_PESSOA_SUPERVISOR ID_PESSOA_SUPERVISOR,
              SUPERVISOR_ESTAGIO.ID_PESSOA_FUNCIONARIO ID_PESSOA_FUNCIONARIO,
              SUPERVISOR_ESTAGIO.NB_FUNCIONARIO NB_FUNCIONARIO,
              SUPERVISOR_ESTAGIO.TX_CURRICULO TX_CURRICULO,
              SUPERVISOR_ESTAGIO.ID_CONSELHO ID_CONSELHO,
              SUPERVISOR_ESTAGIO.NB_INSCRICAO_CONSELHO,
              SUPERVISOR_ESTAGIO.TX_FORMACAO TX_FORMACAO,
              SUPERVISOR_ESTAGIO.TX_CARGO TX_CARGO,
              PESSOA.ID_PESSOA,
              PESSOA.TX_NOME TX_NOME,
              CONSELHO_PROFISSIONAL.TX_CONSELHO TX_CONSELHO
              
         FROM SUPERVISOR_ESTAGIO,
              PESSOA,
              FUNCIONARIO_PE,
              PESSOA_FISICA,
              CONSELHO_PROFISSIONAL
              
        WHERE FUNCIONARIO_PE.ID_PESSOA_FUNCIONARIO = PESSOA_FISICA.ID_PESSOA
              AND PESSOA_FISICA.ID_PESSOA = PESSOA.ID_PESSOA
              AND SUPERVISOR_ESTAGIO.ID_PESSOA_FUNCIONARIO = FUNCIONARIO_PE.ID_PESSOA_FUNCIONARIO
              AND SUPERVISOR_ESTAGIO.ID_CONSELHO = CONSELHO_PROFISSIONAL.ID_CONSELHO
  ";
        $cond = " AND ";
        if ($VO->TX_CARGO){
            $query .= $cond ." upper(TX_CARGO) like upper('%".$VO->TX_CARGO."%')";
            $cond = " AND ";
        }
       
         $cond = " AND ";
         if ($VO->ID_PESSOA_FUNCIONARIO){
            $query .= $cond . " SUPERVISOR_ESTAGIO.ID_PESSOA_SUPERVISOR = '".$VO->ID_PESSOA_FUNCIONARIO."' ";
            $cond = " AND ";
        }
        $query .= " ORDER BY SUPERVISOR_ESTAGIO.ID_PESSOA_SUPERVISOR";
       
      
        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }
     
        return $this->sqlVetor($query);    
    }

function inserir($VO){
       
       $codigo = explode('_', $VO->NB_FUNCIONARIO);
       $VO->ID_PESSOA_FUNCIONARIO = $codigo[0];
       $VO->NB_FUNCIONARIO = $codigo[1];

       $query = "
            INSERT INTO SUPERVISOR_ESTAGIO(ID_PESSOA_SUPERVISOR,ID_PESSOA_FUNCIONARIO,NB_FUNCIONARIO,TX_CURRICULO,TX_FORMACAO,ID_CONSELHO,NB_INSCRICAO_CONSELHO,TX_CARGO) 
            VALUES
            (".$VO->ID_PESSOA_FUNCIONARIO.",'".$VO->ID_PESSOA_FUNCIONARIO."','".$VO->NB_FUNCIONARIO."','".$VO->TX_CURRICULO."','".$VO->TX_FORMACAO."','".$VO->ID_CONSELHO."','".$VO->NB_INSCRICAO_CONSELHO."','".$VO->TX_CARGO."') ";
     	
        return $this->sql($query); 
   }
    
function alterar($VO) {
            
        $query = "UPDATE SUPERVISOR_ESTAGIO SET 
                                           ID_PESSOA_FUNCIONARIO = '".$VO->ID_PESSOA_FUNCIONARIO."',
                                           NB_FUNCIONARIO = '".$VO->NB_FUNCIONARIO."',
                                           TX_CURRICULO = '".$VO->TX_CURRICULO."',
                                           TX_FORMACAO = '".$VO->TX_FORMACAO."',
                                           ID_CONSELHO = '".$VO->ID_CONSELHO."',
                                           NB_INSCRICAO_CONSELHO = '".$VO->NB_INSCRICAO_CONSELHO."',
                                           TX_CARGO = '".$VO->TX_CARGO."'
                                          
			            WHERE  ID_PESSOA_SUPERVISOR = '".$VO->ID_PESSOA_FUNCIONARIO."'";
        return $this->sql($query);
    }

function excluir($VO){
        $query = "delete from  SUPERVISOR_ESTAGIO where ID_PESSOA_SUPERVISOR = '".$VO->ID_PESSOA_FUNCIONARIO."'";

        return $this->sql($query);
    }
 
function buscar($VO) {
$query ="SELECT 
                SUPERVISOR_ESTAGIO.ID_PESSOA_SUPERVISOR ID_PESSOA_SUPERVISOR,
                SUPERVISOR_ESTAGIO.ID_PESSOA_FUNCIONARIO ID_PESSOA_FUNCIONARIO,
                SUPERVISOR_ESTAGIO.NB_FUNCIONARIO NB_FUNCIONARIO,
                SUPERVISOR_ESTAGIO.TX_CURRICULO TX_CURRICULO,
                SUPERVISOR_ESTAGIO.ID_CONSELHO ID_CONSELHO,
                SUPERVISOR_ESTAGIO.NB_INSCRICAO_CONSELHO,
                SUPERVISOR_ESTAGIO.TX_FORMACAO TX_FORMACAO,
                SUPERVISOR_ESTAGIO.TX_CARGO TX_CARGO,
                PESSOA.ID_PESSOA,
                PESSOA.TX_NOME TX_NOME,
                CONSELHO_PROFISSIONAL.TX_CONSELHO TX_CONSELHO
              
         FROM   SUPERVISOR_ESTAGIO,
                PESSOA,
                FUNCIONARIO_PE,
                PESSOA_FISICA,
                CONSELHO_PROFISSIONAL
              
        WHERE   FUNCIONARIO_PE.ID_PESSOA_FUNCIONARIO = PESSOA_FISICA.ID_PESSOA
          AND   PESSOA_FISICA.ID_PESSOA = PESSOA.ID_PESSOA
          AND   SUPERVISOR_ESTAGIO.ID_PESSOA_FUNCIONARIO = FUNCIONARIO_PE.ID_PESSOA_FUNCIONARIO
          AND   SUPERVISOR_ESTAGIO.ID_CONSELHO = CONSELHO_PROFISSIONAL.ID_CONSELHO
  ";
   $VO->ID_PESSOA_FUNCIONARIO ? $query .= "where SUPERVISOR_ESTAGIO.ID_PESSOA_SUPERVISOR = '".$VO->ID_PESSOA_FUNCIONARIO."'" : false;
   
        $query .= " ORDER BY SUPERVISOR_ESTAGIO.ID_PESSOA_SUPERVISOR";
       
        return $this->sqlVetor($query);
    }
}
        
?>