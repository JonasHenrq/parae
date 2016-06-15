<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "user";
$conexao = mysql_connect($host, $user, $pass);
mysql_select_db($banco) or die (mysql_error());
?>

<?php
session_start();
if(!isset($_SESSION["user"]) || !isset($_SESSION["password"])){
    header("Location: Login.php");
    exit;
} else {
    if ($_SESSION["tuser"]==1) {
        header("Location: Painel.php");
    } elseif ($_SESSION["tuser"]==2) {
        header("Location: FormularioCadastroAtendente.php");
    }
    $NomeUser=$_SESSION["user"];
}
?>
<!DOCTYPE html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <title>Cupom Fiscal</title>
    <link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
    <center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
    <div align="right"> Olá, <?php echo $NomeUser ?> | <a href="logout.php">Sair</a></div>
</head>
<body>
<div class="row-fluid">
            <div class="span3">
            	<h1><em><strong>CUPOM FISCAL:</strong></em></h1>
            	<h4>Nome:</h4>
            	<small>Nome do cliente</small>
            	<h4>Veículo:</h4>
            	<small>Modelo + placa</small>
            	<h4>Valor Integral:</h4>
            	<small>R$xx,00</small>
            	<h4>Desconto:</h4>
            	<small>R$yy,00</small>
            	<h4>Valor Total:</h4>
            	<small>R$zz,00</small>
            	<h5><a class="btn btn-small" href="#"><i class="icon-print"></i>Imprimir</a></h5>
            </div>
            <div class="span3"></div>
            <div class="span3">
            	<h2><em><strong>Crédito do Cliente:</strong></em></h2>
            	<h6>R$XX,00 (Valor Total):</h6>
            	<h6>R$YY,00 (Valor do crédito cliente)</h6>
            	<h1>R$ZZ,00 (valor atual do crédito do cliente)</h1>
            </div><br>
          </div>
</body>