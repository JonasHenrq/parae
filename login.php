<!DOCTYPE html PUBLIC ".//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1//DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>PARAE - Redes de Estacionamento</title>
<link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="css/fonte"/>
</head>

<body background="css/imagens/vaga.png.jpg">
    <div id="login" class="form bradius">
        <div class="message"></div>
        <div class="logo"><a href="<?php echo $home;?>" title="<?php echo $title;?>"><img src="css/imagens/paraefinal.png" alt="<?php echo $title;?>" title="<?php echo $title;?>" width="200" height="78"/> </a> </div>
        <div class="acomodar">
            <form action="autenticacaoUsuario.php" method="post">
                <label for="email">Usuario:</label><input id="usuario" type="text" class="txt bradius" name="usuario" value=""/>
                <label for="senha">Senha:</label><input id="senha" type="password" class="txt bradius" name="senha" value=""/>
                <center><input type="submit" class="sb bradius" value="Entrar"/></center>
            </form>
        </div>
    </div>
</body>
</html>