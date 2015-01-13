<div id="identificacao">
<br /><br />
   <div id='formLogin'>

        <form method='post' action='{$url}src/autenticacao/index.php?url={$urlGet}'>

            <div id="boxAltenticacao">
                <div id='msgLogin'  class='aviso'>{if !$validou} {$obrigatorio.geral} {/if}</div>
                <div id="leftBox"></div>
                <div id="mainBox">
                    <div id="imgTitleBoxAut"></div>
                    <div class="legendaInputBoxAut">Usu&aacute;rio</div>
                    <input class="inputBoxAut" id="inputUser" type='text' name='USU_LOGIN' />
                    <div class="legendaInputBoxAut">Senha</div>
                    <input class="inputBoxAut" id="inputPass" type='password' name='USU_SENHA' />
                    <input type='submit' name='entrar' class='buttonLogin' value='' onMouseOver="this.className='overButtonOn'" onMouseOut="this.className='overButtonOff'" />
                    <input name="validaLogin" type="hidden" value="1">
                </div>
                <div id="rightBox"></div>
            </div>
        </form>
<br />
    </div>
   
</div>
