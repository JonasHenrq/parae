
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
}
$NomeUser=$_SESSION["user"];

?>

<!DOCTYPE html PUBLIC ".//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1//DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PARAE - Redes de Estacionamento</title>
    <link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
    <link href="css/formulario.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/fonte"/>
    <div class="logo2"><a title="<?php echo $title;?>"><img src="css/imagens/paraefinal.png" onclick="location.href='paginicial.php'" alt="<?php echo $title;?>" title="<?php echo $title;?>" width="200" height="78"/> </a> </div>
    <div id="sair">Olá , <?php echo $NomeUser ?> | <a href="logout.php">Sair</a></div><br>
</head>
<body background="css/imagens/vaga.png.jpg">
<center></center><div class="row-fluid">
    <div class="span3"></div>
    <div class="span3">
        <center><h2><em><strong>ATENDIMENTO:</strong></em></h2>

    </div>
    <div class="span3">
        <center><button class="sb bradius 2 btn-primary" onclick="location.href='IniciaAtendimento.php?ia='">Entrada Veículo</button>
    </div><br>
    <div class="span3">
        <center><button class="sb bradius 2 btn-primary" onclick="location.href='PainelS.php?passo='">Saída Veículo</button>
    </div><br>
    <div class="span3">
        <center><button class="sb bradius 2 btn-primary" onclick="location.href='FormularioCadastroCliente.php'">Cadastrar Cliente</button>
    </div><br>
    <div class="span3">
        <center><button class="sb bradius 2 btn-primary" onclick="location.href='FormularioBuscaCliente.php'">Consultar Cliente</button>
    </div><br>
</div>
</body>
</html>