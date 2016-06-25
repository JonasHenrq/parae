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
	}
	$NomeUser=$_SESSION["user"];
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Consulta Usuário</title>
	<link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
	<center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
     <div align="right"> Olá, <?php echo $NomeUser ?> | <a href="paginicial.php"><i class="icon-home"></i></a> | <a href="logout.php">Sair</a></div>
	<center><h3>Usuários Cadastrados</h3></center>
</head>
<body>
	<?php
	$cpf = $_GET['cpf'];	
	$nome = $_GET['nome'];
	if($nome){
		$BD = "SELECT * FROM usuario WHERE name LIKE '%$nome%'";
		$sql = mysql_query($BD) or die(mysql_error());
		$row = mysql_num_rows($sql);
		if ($row > 0){
			echo '<center><table class="table table-striped"></center>';
			echo '<th><center>Nome</center></th>';
			echo '<th><center>CPF</center></th>';
			echo '<th><center>Usuário</center></th>';
			echo '<th><center>Tipo Usuario</center></th>';
			echo '<th></th>';
			echo '<th></th>';
			echo '</tr></thead>';
			while ($linha = mysql_fetch_array($sql)) {
				$status = $linha['status'];
				if($status){
					$id = $linha['id'];
					$nome = $linha['name'];
					$cpf = $linha['cpf'];
					$nuser = $linha['tuser'];
					$usuario = $linha['user'];
					$tuser = $linha['tuser'];
					if($linha['tuser']==1){
						$tuser = "Atendente";
					}elseif ($linha['tuser']==2) {
						$tuser = "Gerente";
					}else{
						$tuser = "Presidente";
					}
					echo '<tr>';
					echo '<td>' .'<center>'. $nome. '</center>'.'</td>';
					echo '<td>' .'<center>'. $cpf. '</center>'.'</td>';
					echo '<td>' .'<center>'. $usuario. '</center>'.'</td>';
					echo '<td>' .'<center>'. $tuser. '</center>'.'</td>';
					echo '<td>' .'<center>'. "<a href='AlteraUsuario.php?id=$id&fun=1&tusu=$nuser&alt=0'>Editar</a>" .'</center>'. '</td>';
					echo '<td>' .'<center>'. "<a href='ConfirmaExclusao.php?id=$id&fun=2&tusu=$nuser&alt=0&t=1&nome=$nome'>Remover</a>" .'</center>'. '</td>';
					echo '</tr>';
				}
			}
			echo "</table>";
		}
	}elseif($cpf){
		$BD = "SELECT * FROM usuario WHERE cpf = '$cpf'";
		$sql = mysql_query($BD) or die(mysql_error());
		$row = mysql_num_rows($sql);
		if ($row > 0){
			echo '<center><table class="table table-striped"></center>';
			echo '<th><center>Nome</center></th>';
			echo '<th><center>CPF</center></th>';
			echo '<th><center>Usuário</center></th>';
			echo '<th><center>Tipo Usuario</center></th>';
			echo '<th></th>';
			echo '<th></th>';
			echo '</tr></thead>';
			while ($linha = mysql_fetch_array($sql)) {
				$status = $linha['status'];
				if($status){
					$id = $linha['id'];
					$nome = $linha['name'];
					$cpf = $linha['cpf'];
					$nuser = $linha['tuser'];
					$usuario = $linha['user'];
					$tuser = $linha['tuser'];
					if($linha['tuser']==1){
						$tuser = "Atendente";
					}elseif ($linha['tuser']==2) {
						$tuser = "Gerente";
					}else{
						$tuser = "Presidente";
					}
					echo '<tr>';
					echo '<td>' .'<center>'. $nome. '</center>'.'</td>';
					echo '<td>' .'<center>'. $cpf. '</center>'.'</td>';
					echo '<td>' .'<center>'. $usuario. '</center>'.'</td>';
					echo '<td>' .'<center>'. $tuser. '</center>'.'</td>';
					echo '<td>' .'<center>'. "<a href='AlteraUsuario.php?id=$id&fun=1&tusu=$nuser&alt=0'>Editar</a>" .'</center>'. '</td>';
					echo '<td>' .'<center>'. "<a href='ConfirmaExclusao.php?id=$id&fun=2&tusu=$nuser&alt=0&t=1&nome=$nome'>Remover</a>" .'</center>'. '</td>';
					echo '</tr>';
				}
			}
			echo "</table>";
		}
	}else{
		$BD = "SELECT * FROM usuario ";
		$sql = mysql_query($BD) or die(mysql_error());
		$row = mysql_num_rows($sql);
		if ($row > 0){
			echo '<center><table class="table table-striped"></center>';
			echo '<th><center>Nome</center></th>';
			echo '<th><center>CPF</center></th>';
			echo '<th><center>Usuário</center></th>';
			echo '<th><center>Tipo Usuario</center></th>';
			echo '<th></th>';
			echo '<th></th>';
			echo '</tr></thead>';
			while ($linha = mysql_fetch_array($sql)) {
				$status = $linha['status'];
				if($status){
					$id = $linha['id'];
					$nome = $linha['name'];
					$cpf = $linha['cpf'];
					$nuser = $linha['tuser'];
					$usuario = $linha['user'];
					$tuser = $linha['tuser'];
					if($linha['tuser']==1){
						$tuser = "Atendente";
					}elseif ($linha['tuser']==2) {
						$tuser = "Gerente";
					}else{
						$tuser = "Presidente";
					}
					echo '<tr>';
					echo '<td>' .'<center>'. $nome. '</center>'.'</td>';
					echo '<td>' .'<center>'. $cpf. '</center>'.'</td>';
					echo '<td>' .'<center>'. $usuario. '</center>'.'</td>';
					echo '<td>' .'<center>'. $tuser. '</center>'.'</td>';
					echo '<td>' .'<center>'. "<a href='AlteraUsuario.php?id=$id&fun=1&tusu=$nuser&alt=0'>Editar</a>" .'</center>'. '</td>';
					echo '<td>' .'<center>'. "<a href='ConfirmaExclusao.php?id=$id&fun=2&tusu=$nuser&alt=0&t=1&nome=$nome'>Remover</a>" .'</center>'. '</td>';
					echo '</tr>';
				}
			}
			echo "</table>";
		}
	}
	?>
	<center> <p><button class="btn btn-default" type="button" onclick="location.href='paginicial.php'">Voltar</button>   </center>
</body>
</html>