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
	<title>Cadastro Usuário</title>
  <link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
	<center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
	<div align="right"> Olá, <?php echo $NomeUser ?> | <a href="logout.php">Sair</a></div>
	<center><h3>CADASTRO ATENDENTE</h3></center>
	<br><br>
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

<form name = "form" action="RealizaCadastro.php" method="post" onsubmit="return validar();">
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
  <label>
  	<input type="hidden" name="tuser" value="1" id="RadioGroup1_0">
  </label>
  <label>
  <br>
  <button class="btn btn-default" type="button" onclick="location.href='javascript:window.history.go(-1)'">Voltar</button>
  &nbsp &nbsp 
  <button class="btn btn-default" type="submit">Cadastrar</button>   
  </label>
  <br>
</form></center>