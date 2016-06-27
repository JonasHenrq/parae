<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "user";
$conexao = mysql_connect($host, $user, $pass);
mysql_select_db($banco) or die (mysql_error());
?>

<?php
$codigo = $_POST['codigo'];
$cpf = $_POST['cpf'];
$consultaCliente = mysql_query("SELECT id FROM cliente WHERE codigo = '$codigo' AND cpf = '$cpf'") or die(mysql_error());
$Clientevector = mysql_fetch_row($consultaCliente);
$clienteID = $Clientevector[0];

function valida(){
$codigo = $_POST['codigo'];
$cpf = $_POST['cpf'];
$consultaCliente = mysql_query("SELECT id FROM cliente WHERE codigo = '$codigo' AND cpf = '$cpf'") or die(mysql_error());
$Clientevector = mysql_fetch_row($consultaCliente);
$cliente = $Clientevector[0];
if(!$cliente){
	echo '<br><br><center><img src="../css/imagens/erro.png" class="img-rounded" width="100" height="105"></center>';
	echo "<br><center><h1>CPF ou Código de Acesso Rapido Inválidos!</h1></center><br>";
	echo "<center><button ".'class="btn btn-default"'."onclick=".'"location.href=href='."'FormularioBuscaCliente.php'".'"'.">Voltar</button></center>";
	exit;
}
}

function gera(){
$codigo = $_POST['codigo'];
$cpf = $_POST['cpf'];
$consultaCliente = mysql_query("SELECT id FROM cliente WHERE codigo = '$codigo' AND cpf = '$cpf'") or die(mysql_error());
$Clientevector = mysql_fetch_row($consultaCliente);
$cliente = $Clientevector[0];
	$BD = "SELECT * FROM atendimento WHERE cliente = '$cliente'";
	$sql = mysql_query($BD) or die(mysql_error());
	$row = mysql_num_rows($sql);
	if ($row > 0){
		while ($linha = mysql_fetch_array($sql)) {
			if($row){
				$setor = $linha['setor'];
				$consultaNomeSetor = mysql_query("SELECT setor FROM vaga WHERE id = '$setor'") or die(mysql_error());
                $nomeSetor = mysql_fetch_row($consultaNomeSetor);
                $nomeSetor = $nomeSetor[0];

				$conv = $linha['conv'];
				$consultaNomeConvenio = mysql_query("SELECT nome FROM convenio WHERE id = '$conv'") or die(mysql_error());
                $nomeconv = mysql_fetch_row($consultaNomeConvenio);
                $nomeconv = $nomeconv[0];

				$veiculo = $linha['veiculo'];
				$consultaNomeVeiculo = mysql_query("SELECT placa FROM veiculo WHERE id = '$veiculo'") or die(mysql_error());
                $nomeveiculo = mysql_fetch_row($consultaNomeVeiculo);
                $nomeveiculo = $nomeveiculo[0];

				$horaE = $linha['horaE'];
				$minE = $linha['minutoE'];
				$horaS = $linha['horaS'];
				$minS = $linha['minutoS'];
				$data = $linha['data'];
				$integral = $linha['total'];
				$total = $linha['valor'];
				$integral = 'R$' . number_format($integral, 2, ',', '.');
				$total = 'R$' . number_format($total, 2, ',', '.');
				echo '<tr>';
				echo '<td>' .'<center>'. $nomeSetor. '</center>'.'</td>';
				echo '<td>' .'<center>';
				echo date('d/m/Y', strtotime($data));
				echo  '</center>'.'</td>';
				echo '<td>' .'<center>'. $nomeconv. '</center>'.'</td>';
				echo '<td>' .'<center>'. $nomeveiculo. '</center>'.'</td>';
				echo '<td>' .'<center>'. $horaE.':'.$minE. '</center>'.'</td>';
				echo '<td>' .'<center>'. $horaS.':'.$minS. '</center>'.'</td>';
				echo '<td>' .'<center>'. $integral. '</center>'.'</td>';
				echo '<td>' .'<center>'. $total. '</center>'.'</td>';
				echo '</tr>';
			}
		}
		echo "</table>";
	}
}
?>



<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<title>Histórico Cliente</title>
<link rel="shortcut icon" href="../css/imagens/parae.ico" type="image/x-icon" />
<center><img src="../css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='index.php'"></center>
<?php valida(); ?>
</html>
<body>
	<center><strong><h3><?php 
		$consultaCliente = mysql_query("SELECT nome FROM cliente WHERE codigo = '$codigo' AND cpf = '$cpf'") or die(mysql_error());
        $Clientevector = mysql_fetch_row($consultaCliente);
        $cliente = $Clientevector[0];
        echo $cliente;
	?></h3></strong></center>
	<br>
	<center><strong><h4>Convênio: <?php 
		$consultaCliente = mysql_query("SELECT convenio FROM cliente WHERE codigo = '$codigo' AND cpf = '$cpf'") or die(mysql_error());
        $Clientevector = mysql_fetch_row($consultaCliente);
        $cliente = $Clientevector[0];
        $consultaNomeConvenio = mysql_query("SELECT nome FROM convenio WHERE id = '$cliente'") or die(mysql_error());
        $nomeconv = mysql_fetch_row($consultaNomeConvenio);
        $nomeconv = $nomeconv[0];
        echo $nomeconv;
	?></h4></strong></center>
	<center><strong><h4>Saldo: <?php 
	$consultaCliente = mysql_query("SELECT saldo FROM cliente WHERE codigo = '$codigo' AND cpf = '$cpf'") or die(mysql_error());
        $Clientevector = mysql_fetch_row($consultaCliente);
        $cliente = $Clientevector[0];
        $saldo = 'R$' . number_format($cliente, 2, ',', '.');
        echo $saldo;
	?></h4></strong></center>
	<center><h4><a href="FormularioInsereCredito.php?acao=&id=<?php echo"$clienteID";?>">Inserir crédito pelo Paypal</a></h4></center>
	<br>
	<center><table class="table table-striped"></center>
	<thead><tr>
		<th>
			<center>Setor</center>
		</th>
		<th>
			<center>Data</center>
		</th>
		<th>
			<center>Convênio</center>
		</th>
		<th>
			<center>Veículo</center>
		</th>
		<th>
			<center>Hora de Entrada</center>
		</th>
		<th>
			<center>Hora de Saída</center>
		</th>
		<th>
			<center>Valor Integral</center>
		</th>
		<th>
			<center>Valor Total</center>
		</th>
	</tr></thead>
	<br>
	<?php
		gera();
	?>
	<br>
	<button class="btn btn-default" type="button" onclick="location.href='javascript:window.history.go(-1)'">Voltar</button>
</body>