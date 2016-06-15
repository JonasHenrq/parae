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
	header("Location: Login.php");
	exit;
} else {
	if ($_SESSION["tuser"]==1) {
		header("Location: Painel.php");
	}
	$NomeUser=$_SESSION["user"];
}
?>

<?php
function gera(){
	for ($i=0; $i < 101 ; $i++) { 
		echo '<option value="'.$i.'">'.$i.'%</option>';
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Cadastro Convenio</title>
	<link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
	<center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
	<div align="right"> Olá, <?php echo $NomeUser ?> | <a href="logout.php">Sair</a></div>
	<center><h3>CADASTRO CONVÊNIO</h3></center>
	<br><br>
	<script>
		function formatar(mascara, documento){
			var i = documento.value.length;
			var saida = mascara.substring(0,1);
			var texto = mascara.substring(i)

			if (texto.substring(0,1) != saida){
				documento.value += texto.substring(0,1);
			}
		}
	</script>
	<script language="Javascript">
		function validar(){
      if(document.form.name.value==""){
        alert("Por favor insira o nome!");
        document.form.name.focus();
        return false;
      }
      if(document.form.validade.value==""){
        alert("Por favor insira a validade!");
        document.form.validade.focus();
        return false;
      } else {
        return true;       
      }
    }		
		</script>


	</head>
	<body>

		<form name = "form" action="RealizaCadastroConvenio.php" method="post" onsubmit="return validar();">
			<center><label>
				<h5>Nome:</h5>
				<input type="text" class="form-control" name="name">
			</label>
			<label>
				<h5>Validade: </h5>
				<input type="text" class="form-control input-lg" name="validade" placeholder="DD/MM/AAAA" OnKeyPress="formatar('##/##/####', this)" maxlength="10">
			</label>
			<label>
				<h5>Desconto:</h5>
				<SELECT name= "porc">
					<?php
					gera();
					?>
				</SELECT>
			</label>
			<label>
				<br>
				<button class="btn btn-default" type="button" onclick="location.href='javascript:window.history.go(-1)'">Voltar</button>
				&nbsp &nbsp 
				<button class="btn btn-default" type="submit">Cadastrar</button>   
			</label>
			<br>
		</form></center>

	</body>
	</html>
