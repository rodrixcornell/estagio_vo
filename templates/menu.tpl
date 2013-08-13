<div id="menu">
    <ul class="menu">
        <li {if !$current}class="current"{/if}><a href="{$url}" ><span>Início</span></a></li>
       <li {if $current == 1}class="current"{/if}><a href="#"><span>Cadastro</span></a>
            <div><ul>
                    <li><a href="{$url}src/orgao_gestor/?s=1" ><span>1-Órgão Gestor</span></a></li>
                    <li><a href="{$url}src/orgao_solicitante/?s=1"><span>2-Órgão Solicitante</span></a></li>
                    <li><a href="{$url}src/agente_setorial/?s=1"><span>3-Agente Setorial</span></a></li>
                    <li><a href="{$url}src/tipo_estagio/?s=1"><span>4-Tipo de Vaga de Estágio</span></a></li>
                    <li><a href="{$url}src/curso/?s=1"><span>5-Curso</span></a></li>
                    <li><a href="{$url}src/instituicao/?s=1"><span>6-Instituição de Ensino</span></a></li>
                    <li><a href="{$url}src/agencia/?s=1"><span>7-Agência de Estágio</span></a></li>
                    <li><a href="{$url}src/supervisor/?s=1"><span>8-Supervisor de Estágio</span></a></li>
                 </ul>
            </div>
        </li>

        <li {if $current == 2}class="current"{/if}><a href="#"><span>Gestão de Estagiário</span></a>
            <div><ul>
                    <li><a href="{$url}src/quadro_vagas/?s=1" ><span>1-Quadro de Vagas</span></a></li>
                    <li><a href="{$url}src/estagiario/?s=1"><span>2-Estagiário</span></a></li>
                    <li><a href="{$url}src/solicitacao/?s=1"><span>3-Solicitação de Estagiário</span></a></li>
                    <li><a href="{$url}src/transferencia/?s=1"><span>4-Transferência de Vagas</span></a></li>
                    <li><a href="{$url}src/recrutamento/?s=1"><span>5-Recrutamento de Estagiário</span></a></li>
                    <li><a href="{$url}src/selecao/?s=1"><span>6-Seleção de Estagiário</span></a></li>
                    <li><a href="{$url}src/contrato/?s=1"><span>7-Contrato de Estágio</span></a></li>
                    <li><a href="{$url}src/tr/?s=1"><span>8-Solicitação de TR</span></a></li>
                    <li><a href="{$url}src/recesso/?s=1"><span>9-Recesso de Estágio</span></a></li>
                    <li><a href="{$url}src/desligamento/?s=1"><span>10-Solicitação de Desligamento</span></a></li>
                    <li><a href="{$url}src/s_ta/?s=1"><span>11-Solicitação TA</span></a></li>
                 </ul>
            </div>
        </li>

        <li {if $current == 3}class="current"{/if}><a href="#"><span>Financeiro</span></a>
            <div><ul>
                    <li><a href="{$url}src/bolsa/?s=1" ><span>1-Bolsa de Estágio</span></a></li>
                    <li><a href="{$url}src/eventos/?s=1"><span>2-Eventos de Pagamento</span></a></li>
                    <li><a href="{$url}src/pagamento/?s=1"><span>3-Pagamento de Estagiário</span></a></li>
                    <li><a href="{$url}src/tipo_pagamento/?s=1"><span>4-Tipo de Pagamento</span></a></li>
                    <li><a href="{$url}src/termo_aditivo/?s=1"><span>5-Termo Aditivo de Contrato</span></a></li>
                    <li><a href="{$url}src/tbl_calc_recesso/?s=1"><span>6-Tabela de Cálculo do Recesso</span></a></li>
                    <li><a href="{$url}src/ta_contrato/?s=1"><span>7-Solicitação de Termo de Aditivo de Contrato</span></a></li>
                    <li><a href="{$url}src/grupo_pagamento/?s=1"><span>8-Grupo de Pagamento</span></a></li>
                    <li><a href="{$url}src/calendario/?s=1"><span>9-Calendário da Folha de Pagamento</span></a></li>
                 </ul>
            </div>
        </li>

        <li {if $current == 4}class="current"{/if}><a href="#"><span>Relatórios</span></a>
            <div><ul>
                    <li><a href="{$url}src/relatorios/quadro_vagas/?s=1" ><span>1-Quadro de Vagas</span></a></li>
                    <li><a href="{$url}src/relatorios/solicitacao/?s=1"><span>2-Solicitação de Estagiário</span></a></li>
                    <li><a href="{$url}src/relatorios/transferencia/?s=1"><span>3-Transferência de Vagas</span></a></li>
                    <li><a href="{$url}src/relatorios/selecao/?s=1"><span>4-Seleção de Estagiário</span></a></li>
                    <li><a href="{$url}src/relatorios/contrato/?s=1"><span>5-Contrato de Estágio</span></a></li>
                    <li><a href="{$url}src/relatorios/resumo/?s=1"><span>6-Resumo de Pagamento</span></a></li>
                 </ul>
            </div>
        </li>
    </ul>
</div>