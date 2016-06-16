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
		header("Location: paginicial.php");
		exit;
	}
	$NomeUser=$_SESSION["user"];
}
?>


<?php
$id=$_GET['id'];
$alt=$_GET['alt'];
if ($id>0) {
	$funcao = $_GET['fun'];
	$id = $_GET['id'];
	if ($funcao==2){
		$remove = "UPDATE vaga SET status = 0 WHERE id ='$id'";
		mysql_query($remove);
		header("Location: ConsultaVaga.php");
		exit;
	}
} elseif ($alt) {
	$id = $_POST['id'];
	$setor = $_POST['setor'];
	$vcarro= $_POST['vcarro'];
	$valor= $_POST['valor'];
	function pv($pv_var){
	//muda ponto para virgula ou vice-versa
	//ex. x=pv("100.00"); o resultado será 100,00
	//ex. x=pv("100,00"); o resultado será 100.00
		$pv_tipo=',';
		if ($pv_tipo == '.') {
			return str_replace('.',',',$pv_var);
		} else {
			return str_replace(',','.',$pv_var);
		}
	}
	$valor = pv($valor);
	$up = "UPDATE vaga SET setor = '$setor', vcarro = '$vcarro', valor = '$valor' WHERE id ='$id'";
	mysql_query($up) or die(mysql_error());
	header("Location: sucesso.php");
	exit;
}

?>

<?php
function obtemSetor(){
	$id=$_GET['id'];
	$consulta = mysql_query("SELECT setor FROM vaga WHERE id = '$id'") or die(mysql_error());
	$dado= mysql_fetch_row($consulta);
	echo "$dado[0]";
}

function obtemVcarro(){
	$id=$_GET['id'];
	$consulta = mysql_query("SELECT vcarro FROM vaga WHERE id = '$id'") or die(mysql_error());
	$dado= mysql_fetch_row($consulta);
	echo "$dado[0]";
}

function obtemValor(){
	$id=$_GET['id'];
	$consulta = mysql_query("SELECT valor FROM vaga WHERE id = '$id'") or die(mysql_error());
	$dado= mysql_fetch_row($consulta);
	echo "$dado[0]";
}

?>

<?php
function geraID(){
	$id=$_GET['id'];
	echo '<input type="hidden" name="id" value="'.$id.'">';	
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Cadastro de Vaga</title>
	<link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
	<center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
     <div align="right"> Olá, <?php echo $NomeUser ?> | <a href="paginicial.php"><i class="icon-home"></i></a> | <a href="logout.php">Sair</a></div>
	<center><h3>CADASTRO DE VAGA</h3></center>
	<br><br>
	<script language="Javascript">

		function validar(){
			if(document.form.setor.value==""){
				alert("Por favor, insira o número da vaga!");
				document.form.setor.focus();
				return false;
			}
			if(document.form.vcarro.value==""){
				alert("Por favor, insira o bloco da vaga!");
				document.form.vcarro.focus();
				return false;
			}
			if(document.form.vmoto.value==""){
				alert("Por favor, insira o tipo da vaga (carro ou moto)!");
				document.form.vmoto.focus();
				return false;
			}

	</script>

</head>
<body>

	<form name = "form" action="AlteraVaga.php?alt=1&id=" method="post" onsubmit="return validar();">
		<center><label>
			<h5>Nome do Setor:</h5>
			<input type="text" class="form-control" value="<?php obtemSetor(); ?>" name="setor">
		</label>
		<label>
			<h5>Número de vagas disponível:</h5>
			<input type="text" class="form-control" value="<?php obtemVcarro(); ?>" name="vcarro">
		</label>
		<label>
			<h5>Valor da hora do aluguel de UMA vaga:</h5>
			<input type="text" class="form-control" value="<?php obtemValor(); ?>" name="valor" />
		</label>
		<label>
			<br>
			<?php geraID(); ?>
			<button class="btn btn-default" type="button" onclick="location.href='paginicial.php'">Voltar</button>
			&nbsp &nbsp
			<button class="btn btn-default" type="submit">Cadastrar</button>
		</label>
		<br>
	</form></center>
