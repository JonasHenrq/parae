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
		exit;
	}
	$NomeUser=$_SESSION["user"];
}
?>


<?php
$id=$_GET['id'];
$alt=$_GET['alt'];
if ($id>0) {
	$id = $_GET['id'];
	$tusuario = $_GET['tusu'];
	$funcao = $_GET['fun'];
	if(($id==1 && $funcao==2)|| $tusuario > $_SESSION["tuser"] || (($tusuario==2)&&($_SESSION["tuser"]==2))){
		header("Location: Permissao.php");
		exit;
	}
	if ($funcao==2){
		$delete = "UPDATE usuario SET status = 0, password = 0 WHERE id ='$id'";
		mysql_query($delete);
		header("Location: sucesso.php");
		exit;
	}
} elseif ($alt) {
	$id = $_POST['id'];
	$nome = $_POST['name'];
	$usuario= $_POST['user'];
	$password = $_POST['password'];
	$tuser = $_POST['tuser'];	
	$cpf = $_POST['cpf'];
	if($tusuario> $_SESSION["tuser"]){
		header("Location: Permissao.php");
		exit;
	}
	$up = "UPDATE usuario SET name = '$nome', cpf = '$cpf', user = '$usuario', tuser = '$tuser' WHERE id ='$id'";
	mysql_query($up) or die(mysql_error());
	header("Location: sucesso.php");
	exit;
}

?>

<?php
function geraID(){
	$id=$_GET['id'];
	echo '<input type="hidden" name="id" value="'.$id.'">';	
}

function seGerente(){
	if($_SESSION["tuser"]==2){
		echo '<input type="hidden" name="tuser" value="1">';	
	}else{
		echo '<h5>Tipo de Usuário:</h5>
		<input type="radio" name="tuser" value="1" id="RadioGroup1_0"> Atendente &nbsp
		<input type="radio" name="tuser" value="2" id="RadioGroup1_0"> Gerente &nbsp
		<input type="radio" name="tuser" value="3" id="RadioGroup1_0"> Presidente';	
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Cadastro Usuário</title>
	<link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
	<center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
	<div align="right"> Olá, <?php echo $NomeUser ?> | <a href="logout.php">Sair</a></div>
	<center><h3>ATUALIZAR DADOS DO USUÁRIO</h3></center>
	<br>
	<script language="Javascript">

		function validar(){
			if(document.form.name.value==""){
				alert("Por favor insira o nome!");
				document.form.name.focus();
				return false;
			}
			if(document.form.cpf.value==""){
				alert("Por favor insira o CPF!");
				document.form.cpf.focus();
				return false;
			}
			if(document.form.user.value==""){
				alert("Por favor defina um usuario!");
				document.form.user.focus();
				return false;
			}
			if(document.form.password.value==""){
				alert("Por favor defina uma senha!");
				document.form.password.focus();
				return false;
			}
			if(document.form.tuser.value==""){
				alert("Por favor selecione o tipo de usuario!");
				document.form.tuser.focus();
				return false;
			} else {
				return true;       
			}
		}
		function formatar(mascara, documento){
			var i = documento.value.length;
			var saida = mascara.substring(0,1);
			var texto = mascara.substring(i)

			if (texto.substring(0,1) != saida){
				documento.value += texto.substring(0,1);
			}
		}
	</script>    

</head>
<body>

	<form name = "form" action="AlteraUsuario.php?alt=1&id=0" method="post" onsubmit="return validar();">
		<center><label>
			<h5>Nome:</h5>
			<input type="text" class="form-control" name="name">
		</label>
		<label>
			<h5>CPF:</h5>
			<input type="text" class="form-control input-lg" name="cpf" placeholder="123.456.789-00" OnKeyPress="formatar('###.###.###-##', this)" maxlength="14">
		</label>
		<label>
			<h5>Usuário:</h5>
			<input type="text" class="form-control" name="user">
		</label>
		<label>
			<h5>Senha:</h5>
			<input type="password" class="form-control" name="password">
		</label>
		<label><?php
			seGerente();
			geraID();
			?>
		</label>
		<label>
			<br>
			<button class="btn btn-default" type="button" onclick="location.href='paginicial.php'">Voltar</button>
			&nbsp &nbsp 
			<button class="btn btn-default" type="submit">Atualizar</button>   
		</label>
		<br>
	</form>
	<?php
	echo '<center><b><h4>Dados Atuais</h4></b></center>';
	echo '<center><table width="50%" border=1 cellpadding=2 cellspacing=0></center>';
	echo '<thead><tr>';
	echo '<th>Nome</th>';
	echo '<th>CPF</th>';
	echo '<th>Usuario</th>';
	echo '<th>Tipo Usuario</th>';
	echo '</tr></thead>';
	$sql = mysql_query("SELECT * FROM usuario WHERE id='$id'") or die(mysql_error());
	$row = mysql_num_rows($sql);
	$dados= mysql_fetch_array($sql);
	$nome=  $dados['name'];
	$cpf=  $dados['cpf'];
	$usuario= $dados['user'];
	if($dados['tuser']==1){
		$tuser = "Atendente";
	}elseif ($dados['tuser']==2) {
		$tuser = "Gerente";
	}else{
		$tuser = "Presidente";
	};
	echo '<tr>';
	echo '<td>' .'<center>'. $nome. '</center>'.'</td>';
	echo '<td>' .'<center>'. $cpf. '</center>'.'</td>';
	echo '<td>' .'<center>'. $usuario. '</center>'.'</td>';
	echo '<td>' .'<center>'. $tuser. '</center>'.'</td>';
	echo '</tr>';
	?></center>