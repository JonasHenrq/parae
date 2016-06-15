<!DOCTYPE html>
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

<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <title>Cadastro Usuário</title>
  <link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
  <center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
  <div align="right"> Olá, <?php echo $NomeUser ?> | <a href="logout.php">Sair</a></div>
  <br><br>
  <center><h3><?php $nome = $_GET['nome'];
    $t = $_GET['t'];
    if($t==3){
      echo "Você tem certeza que deseja remover '$nome' e confirma a devolução do saldo do cliente?";
    }else{
      echo "Você tem certeza que deseja remover '$nome'?"; }?></h3></center>
      <br><br>  
      <center><button type="button" name="voltar" class="btn btn-default" id="voltar" onclick="location.href='<?php
        $t = $_GET['t'];
        if($t==2){
          $id = $_GET['id'];
          $nome = $_GET['nome'];
          echo "ConsultaConvenio.php";
        } elseif ($t==1) {
          $id = $_GET['id'];
          $nome = $_GET['nome'];
          $nuser = $_GET['tusu'];
          echo "ConsultaUsuario.php?cpf=0&nome=0";
        } elseif ($t==3){
          $id = $_GET['id'];
          $nome = $_GET['nome'];
          echo "ConsultaCliente.php?nome=$nome&cpf=&codigo=";
        }  elseif ($t==4){
          $id = $_GET['id'];
          $nome = $_GET['nome'];
          echo "ConsultaVaga.php";
        }
        ?>'">VOLTAR</button>
        &nbsp &nbsp
        <input name="button" class="btn btn-default" type="submit" id="cadastrar" title="ENVIAR" value="CONFIRMAR"  onclick="location.href='<?php
        $t = $_GET['t'];
        if($t==2){
          $id = $_GET['id'];
          $nome = $_GET['nome'];
          echo "AlteraConvenio.php?id=$id&alt=0&fun=2";
        } elseif ($t==1) {
          $id = $_GET['id'];
          $nome = $_GET['nome'];
          $nuser = $_GET['tusu'];
          echo "AlteraUsuario.php?id=$id&fun=2&tusu=$nuser&alt=0";
        } elseif($t==3){
          $id = $_GET['id'];
          echo "AlteraCliente.php?id=$id&func=1";
        } elseif ($t==4) {
          $id = $_GET['id'];
          $nome = $_GET['nome'];
          echo "AlteraVaga.php?id=$id&alt=0&fun=2";
        }
        ?>'"/></center>
      </head>
      <body>