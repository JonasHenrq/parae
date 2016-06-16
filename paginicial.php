
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
    if ($_SESSION["tuser"]==1) {
        header("Location: Painel.php?passo=");
    }
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
    <div class="logo2"><a title="<?php echo $title;?>"><img src="css/imagens/paraefinal.png" alt="<?php echo $title;?>" title="<?php echo $title;?>" width="200" height="78"/> </a> </div>
    <div id="sair">Olá , <?php echo $NomeUser ?> | <a href="logout.php">Sair</a></div>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <center><tr class="success">
            <button class="btn-default" onclick="location.href='FormularioCadastroUsuario.php'"><td>Cadastrar Usuário</td></button>
            <button class="btn-default" onclick="location.href='FormularioCadastroCliente.php'"><td>Cadastrar Cliente</td></button>
            <button class="btn-default" onclick="location.href='FormularioCadastroVaga.php'"><td>Cadastrar Vaga</td></button>
            <button class="btn-default" onclick="location.href='FormularioCadastroConvenio.php'"><td>Cadastrar Convênio</td></button>
        </tr></center>
    <center><tr class="success">
            <button class="btn-default" onclick="location.href='FormularioBuscaUsuario.php'"><td>Consultar Usuário</td></button>
            <button class="btn-default" onclick="location.href='FormularioBuscaCliente.php'"><td>Consultar Cliente</td></button>
            <button class="btn-default" onclick="location.href='ConsultaVaga.php'"><td>Consultar Vaga</td></button>
            <button class="btn-default" onclick="location.href='ConsultaConvenio.php'"><td>Consultar Convênio</td></button>
        </tr></center>
    <center><tr class="success">
            <button class="btn-default" onclick="location.href='Painel.php'"><td>Atendimento</td></button>
            <button class="btn-default" onclick="location.href='FormularioRelatorio.php'"><td>Relatórios</td></button>
        </tr></center>
</div>
</body>