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
if (!$_SESSION["setor"]) {
		header("Location: IniciaAtendimento.php?ia=");
    exit;
	}
	$NomeUser=$_SESSION["user"];
  $setor = $_SESSION["setor"];
?>

<?php
$consultaVaga = mysql_query("SELECT vcarro FROM vaga WHERE id = '$setor'") or die(mysql_error());
$Vagavector = mysql_fetch_row($consultaVaga);
$vaga = $Vagavector[0];
if($vaga<1){header("Location: erro500.php?op=5"); exit;}
$passo = $_GET['passo'];
if($passo){
  $cpf = $_POST['cpf'];
  $codigo = $_POST['codigo'];
  $consultaID = mysql_query("SELECT id FROM cliente WHERE cpf = '$cpf' or codigo = '$codigo' and status = '1'") or die(mysql_error());
  $IDvector = mysql_fetch_row($consultaID);
  $id = $IDvector[0];
  if($vaga<1){header("Location: erro500.php?op=5"); exit;}
  if(!$id){header("Location: erro500.php?op=1");}
  else{header("Location: testehora.php?id=$id");}
}

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <title>Atendimento</title>
  <link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
  <center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
  <div align="right"> Olá, <?php echo $NomeUser ?> | <a href="paginicial.php"><i class="icon-home"></i></a> | <a href="logout.php">Sair</a></div>
  <center><font color="green"><h3>ENTRADA VEÍCULO</h3></center></font>
  <br>
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

  <form action="PainelE.php?passo=2" method="POST">
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
    <br><br>
    <button class="btn btn-default" type="button" onclick="location.href='PainelS.php?passo='">Saída Veiculo</button></center>
  </form></center>
