<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>{$titulo}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="{$urlcss}layout.css?trick={1|mt_rand:10000}" rel="stylesheet" type="text/css">
        <link href="{$urlcss}menu.css" rel="stylesheet" type="text/css">
        <link href="{$urlcss}simpleAutoComplete.css" rel="stylesheet" type="text/css"> 
        <link href="{$urlcss}jquery-ui.css" rel="stylesheet" type="text/css">
        {if $arquivoCSS}<link href="{$urlcss}{$arquivoCSS}.css?trick={1|mt_rand:10000}" rel="stylesheet" type="text/css">{/if}
        <link rel="shortcut icon" type="image/x-icon" href="{$urlimg}favicon.ico">
        
		<script charset="UTF-8" type="text/javascript" language="JavaScript">
            var url           = "{$url}";
			var urlimg        = "{$urlimg}";
        </script>
        <script type="text/javascript" src="{$url}js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="{$url}js/jquery.meio.mask.js"></script>
        <script type="text/javascript" src="{$url}js/jquery.maskMoney.js"></script>       
        <script type="text/javascript" src="{$url}js/jquery.alphanumeric.js"></script>     
        <script type="text/javascript" src="{$url}js/jquery-ui.js"></script>
        <script type="text/javascript" src="{$url}js/jquery-ui-timepicker-addon.js"></script>
        <script type="text/javascript" src="{$url}js/scripts.js"></script>
        <script type="text/javascript" src="{$url}js/simpleAutoComplete.js"></script>
        <script type="text/javascript" src="{$url}js/menu.js"></script>
        {if $arquivoJS}<script type="text/javascript" src="{$url}js/{$arquivoJS}.js?trick={1|mt_rand:10000}"></script>{/if}

    </head>
    <body>
        <div id="centraliza">
        	{include file="topo.tpl"}
            {if $nomeArquivo != 'autenticacao/index.tpl'}{include file="menu.tpl"}{/if}
            
        <div id="mainContent"><a href="http://apycom.com/"></a>
            {if $nomeArquivo}{include file=$nomeArquivo}{/if}
        </div>
        
            {include file="rodape.tpl"}
        </div>
    </body>
</html>