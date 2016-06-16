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
}
    $NomeUser=$_SESSION["user"];
?>

<?php 
    $id = $_GET['id'];
    $consultaAtend = mysql_query("SELECT * FROM atendimento WHERE id = '$id'") or die(mysql_error());
    $row = mysql_num_rows($consultaAtend);
    if ($row > 0){
        while ($linha = mysql_fetch_array($consultaAtend)) {
            $clienteID= $linha['cliente'];
            $consultaNome = mysql_query("SELECT nome,saldo FROM cliente WHERE id = '$clienteID'") or die(mysql_error());
            $Nomevector = mysql_fetch_row($consultaNome);
            $cliente = $Nomevector[0];
            $credito = $Nomevector[1];
            $convenio= $linha['conv'];
            $consultaConv = mysql_query("SELECT nome FROM convenio WHERE id = '$convenio'") or die(mysql_error());
            $Convvector = mysql_fetch_row($consultaConv);
            $convenio = $Convvector[0];
            $horaE = $linha['horaE'];
            $minutoE = $linha['minutoE'];
            $horaS = $linha['horaS'];
            $minutoS = $linha['minutoS'];
            $veiculo = $linha['veiculo'];
            $consultaVeiculo = mysql_query("SELECT placa FROM veiculo WHERE id = '$veiculo'") or die(mysql_error());
            $Veiculovector = mysql_fetch_row($consultaVeiculo);
            $veiculo = $Veiculovector[0];
            $veiculo = mb_strtoupper($veiculo);
            $total = $linha['total'];
            $valor = $linha['valor'];
        }
    }
    $pagar = $credito - $valor;
    if($pagar>0){
        mysql_query("UPDATE cliente SET saldo = '$pagar' WHERE id ='$clienteID'");
        $pagar = 0;
    }else{
        mysql_query("UPDATE cliente SET saldo = 0 WHERE id ='$clienteID'");
        $pagar = $pagar*-1;
    }
?>

<!DOCTYPE html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <title>Cupom Fiscal</title>
    <link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
    <center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
     <div align="right"> Olá, <?php echo $NomeUser ?> | <a href="paginicial.php"><i class="icon-home"></i></a> | <a href="logout.php">Sair</a></div>
</head>
<body>
<center></center><div class="row-fluid">
            <div class="span3"></div>
            <div class="span3">
            	<center><h2><em><strong>DETALHAMENTO:</strong></em></h2>
            	<h4>Cliente:</h4>
            	<small><?php echo "$cliente"; ?></small>
            	<h4>Veículo:</h4>
            	<small><?php echo "$veiculo"; ?></small>
                <h4>Convênio:</h4>
                <small><?php echo "$convenio"; ?></small>
                <h4>Hora Entrada:</h4>
                <small><?php echo "$horaE:$minutoE"; ?></small>
                <h4>Hora Saída:</h4>
                <small><?php echo "$horaS:$minutoS"; ?></small>
            	<h4>Valor Integral:</h4>
            	<small><?php echo 'R$' . number_format($total, 2, ',', '.'); ?></small>
            	<h4>Desconto:</h4>
            	<small>-<?php echo 'R$' . number_format($total-$valor, 2, ',', '.'); ?></h4></small>
            	<h4>Valor Total:</h4>
            	<small><?php echo 'R$' . number_format($valor, 2, ',', '.');; ?></small>
            </div>
            <div class="span3">
            	<center><h2><em><strong>PAGAMENTO:</strong></em></h2>
                <h4>Valor Total:
                <?php echo 'R$' . number_format($valor, 2, ',', '.');; ?></h4>
            	<h4>Credito Disponivel: <?php 
                echo 'R$' . number_format($credito, 2, ',', '.'); ?></h4>
            	<h1>Valor a Pagar:</h1>
                <h2><?php echo 'R$' . number_format($pagar, 2, ',', '.'); ?></h2>
            </div><br>
          </div>
          <br><br><center> <button class="btn btn-default" type="button" onclick="location.href='painelE.php?passo='">CONCLUIR</button></center>
</body>