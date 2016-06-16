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
$setor=$_SESSION['setor'];
?>

<?php
$entrada= $_GET['e']; 
if($entrada==1){
	$cliente = $_POST['id'];
	$horaE = $_POST['horaE'];
	$minutoE = $_POST['minutoE'];
	$veiculo = $_POST['veiculo'];
	$consultaIDconv = mysql_query("SELECT convenio FROM cliente WHERE id = '$cliente'") or die(mysql_error());
	$IDvector = mysql_fetch_row($consultaIDconv);
	$convenio = $IDvector[0];
	$sql = mysql_query("INSERT INTO atendimento (cliente, conv, veiculo, horaE, minutoE)
		VALUES ('$cliente', '$convenio', '$veiculo', '$horaE', '$minutoE')");
	$consultaVaga = mysql_query("SELECT vcarro FROM vaga WHERE id = '$setor'") or die(mysql_error());
	$Valorvector = mysql_fetch_row($consultaVaga);
	$nvaga = $Valorvector[0];
	$nvaga = ($nvaga-1);
	mysql_query("UPDATE vaga SET vcarro = '$nvaga' WHERE id ='$setor'");
	header("Location: sucesso.php");
}
if ($entrada==2) {
	$cliente = $_POST['id'];
	$horaS = $_POST['horaS'];
	$minutoS = $_POST['minutoS'];
	$veiculo = $_POST['veiculo'];
	$consultaAtend = mysql_query("SELECT * FROM atendimento WHERE cliente = '$cliente' and status = 1 and veiculo = '$veiculo'") or die(mysql_error());
	$row = mysql_num_rows($consultaAtend);
	if ($row > 0){
		while ($linha = mysql_fetch_array($consultaAtend)) {
			$id = $linha['id'];
			$convenio= $linha['conv'];
			$horaE = $linha['horaE'];
			$minutoE = $linha['minutoE'];
			$consultaDesc = mysql_query("SELECT porc FROM convenio WHERE id = '$convenio'") or die(mysql_error());
			$Descvector = mysql_fetch_row($consultaDesc);
			$desconto = $Descvector[0];
			$consultaValor = mysql_query("SELECT valor FROM vaga WHERE id = '$setor'") or die(mysql_error());
			$Valorvector = mysql_fetch_row($consultaValor);
			$preco = $Valorvector[0];
			$x = (($horaE*60)+$minutoE);
			$y = (($horaS*60)+$minutoS);
			$total = (($y-$x)*($preco/60));
			$desconto = ($total*($desconto/100));
			$valor = ($total - $desconto);
			mysql_query("UPDATE atendimento SET status = 0, horaS = '$horaS', minutoS = '$minutoS',total = '$total', valor = '$valor' WHERE id ='$id'");
			$consultaVaga = mysql_query("SELECT vcarro FROM vaga WHERE id = '$setor'") or die(mysql_error());
			$Valorvector = mysql_fetch_row($consultaVaga);
			$nvaga = $Valorvector[0];
			$nvaga = ($nvaga+1);
			mysql_query("UPDATE vaga SET vcarro = '$nvaga' WHERE id ='$setor'");
			header("Location: Pagamento.php?id=$id");
		}
	}
}

?>