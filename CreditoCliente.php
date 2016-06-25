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
$NomeUser=$_SESSION["user"];    
?>

<?php
function geraID(){
    $id=$_GET['id'];
    echo '<input type="hidden" name="id" value="'.$id.'">'; 
}
?>

<?php 
$id=$_GET['id'];
if(!$id){
    $valor = $_POST['valor'];
    $tipoC = $_POST['tipoC'];
    $id = $_POST['id'];
    $operacao = $valor*$tipoC;
    $consultaSaldo = mysql_query("SELECT saldo FROM cliente WHERE id = '$id'") or die(mysql_error());
    $Saldovector = mysql_fetch_row($consultaSaldo);
    $saldo = $Saldovector[0];
    $saldo = $saldo + $operacao;
    mysql_query("UPDATE cliente SET saldo = '$saldo' WHERE id ='$id'");
    header("Location: Sucesso.php");
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
        }

    </script>

</head>
<body>

<form name = "form" action="CreditoCliente.php?id=" method="post" onsubmit="return validar();">
        <center><label>
            <h4>Cliente:</h4>
            <h4><?php 
                $id=$_GET['id'];
                $consultaNome = mysql_query("SELECT nome FROM cliente WHERE id = '$id'") or die(mysql_error());
                $Nomevector = mysql_fetch_row($consultaNome);
                $nome = $Nomevector[0];
                echo "$nome";
                ?></h4><br>
            </label>
            <label>
                <h4>Operação:</h4>
                <select name="tipoC">
                    <option value="1">Credito</option>
                    <option value="-1">Extorno Credito</option>
                    <option value="1">Extorno Debito</option>
                </select>
            </label>
            <?php
            geraID();
            ?>
            <label>
                <h4>Valor:</h4>
                <input type="double" class="form-control" name="valor">
            </label>
            <label>
                <br>
                <button class="btn btn-default" type="button" onclick="location.href='javascript:window.history.go(-1)'">Voltar</button>
                &nbsp &nbsp
                <button class="btn btn-default" type="submit">Cadastrar</button>
            </label>
            <br>
        </form></center>