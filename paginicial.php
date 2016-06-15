
<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "user";
$conexao = mysql_connect($host, $user, $pass) or die (mysql_error());
mysql_select_db($banco) or die (mysql_error());
?>

<?php 
    session_start();
    if(!isset($_SESSION["user"]) || !isset($_SESSION["password"])){
        header("Location: login.php");
        exit;
    } else {
        $NomeUser=$_SESSION["user"];


    }
?>

<!DOCTYPE html PUBLIC ".//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1//DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PARAE - Redes de Estacionamento</title>
    <link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
    <link href="css/formulario.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/fonte"/>
</head>
<body background="css/imagens/vaga.png.jpg">
<div id="pagini" class="form bradius">
    <div class="message"></div>
    <div class="logo2"><a href="<?php echo $home;?>" title="<?php echo $title;?>"><img src="css/imagens/parae.png" alt="<?php echo $title;?>" title="<?php echo $title;?>" width="200" height="78"/> </a> </div>
    <div id="sair">Olá , <?php echo $NomeUser ?> | <a href="logout.php">Sair</a></div>
       <input type="submit" class="sb bradius2" value="Cadastrar Usuário" onclick="location.href='FormularioCadastroUsuario.php'" />
        <input type="submit" class="sb bradius2" value="Cadastrar Cliente" onclick="location.href='FormularioCadastroCliente.php'"/>
        <input type="submit" class="sb bradius2" value="Cadastrar Vaga" onclick="location.href='FormularioCadastroVaga.php'"/>
        <input type="submit" class="sb bradius2" value="Cadastrar Convênio" onclick="location.href='FormularioCadastroConvenio.php'"/>
</div>
        <input type="submit" class="sb bradius3" value="Consultar Usuário" onclick="location.href='FormularioBuscaUsuario.php'"/>
        <input type="submit" class="sb bradius4" value="Consultar Cliente" onclick="location.href='FormularioBuscaCliente.php'"/>
        <input type="submit" class="sb bradius4" value="Consultar Vaga" onclick="location.href='ConsultaVaga.php'"/>
        <input type="submit" class="sb bradius4" value="Consultar Convênio" onclick="location.href='ConsultaConvenio.php'"/><br>
        <input type="submit" class="sb bradius5" value="Atendimento" value="Cadastrar Convênio" onclick="location.href='Painel.php'"/>
        <input type="submit" class="sb bradius5" value="Relatório"/>

</body>
</html>