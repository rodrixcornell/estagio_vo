<div id="identificacaoTrocaSenha" style="width:220px;">
<form action="{$url}src/autenticacao/trocaSenha.php" method="post">
    <fieldset id="formulario">
    <legend>Alterar SENHA</legend>
    <span class="aviso">{$resultado}</span>
    <br />
      <label>Senha Atual:</label><br />
      <input type="password" name="senha_atual" /><br />
      
      <label>Nova Senha:</label><br />
      <input type="password" name="senha_nova" /><br />
      
      <label>Confirme Nova Senha:</label><br />
      <input type="password" name="senha_nova_cfm" /><br />
      
      <input type="button" name="voltar" value="Voltar" onclick="history.go(-1);" />
      <input type="submit" value="Enviar" name="altera" />
      
    </fieldset>
</form>
</div>
