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

<?php
  $passo = $_GET['passo'];
  if($passo){
    $cpf = $_POST['cpf'];
    $codigo = $_POST['codigo'];
    $consultaID = mysql_query("SELECT id FROM cliente WHERE cpf = '$cpf' or codigo = '$codigo' and status = '1'") or die(mysql_error());
    $IDvector = mysql_fetch_row($consultaID);
    $id = $IDvector[0];
    header("Location: testehora.php?id=$id");
  }

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Atendimento</title>
  <link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
	<center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
	<div align="right"> Olá, <?php echo $NomeUser ?> | <a href="logout.php">Sair</a></div>
	<center><h3>INICIAR ATENDIMENTO</h3></center>
	<br><br>
	<script language="Javascript">
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

<form action="FormularioInicialAtendimento.php?passo=2" method="POST">
  <center>
  <label>
 <h5>Iniciar pelo CPF</h5>
    <input type="text" class="form-control input-lg" name="cpf" placeholder="123.456.789-00" OnKeyPress="formatar('###.###.###-##', this)" maxlength="14">
  </label>
  <label>
  <h5>Iniciar pelo Codigo</h5>
    <input type="text" class="form-control input-lg" name="codigo" >
  </label>
  <label>
  <button class="btn btn-default" type="submit">Iniciar</button>   
  </label>
  <br>
</form></center>
