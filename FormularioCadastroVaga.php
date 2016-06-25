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
    } elseif ($_SESSION["tuser"]==2) {
        header("Location: FormularioCadastroAtendente.php");
    }
    $NomeUser=$_SESSION["user"];
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

    <form name = "form" action="RealizaCadastroVaga.php" method="post" onsubmit="return validar();">
        <center><label>
            <h5>Nome do Setor:</h5>
            <input type="text" class="form-control" name="setor">
        </label>
        <label>
            <h5>Número de vagas disponíveis:</h5>
            <input type="text" class="form-control" name="vcarro">
        </label>
        <label>
            <h5>Valor Hora:</h5>
            <input type="text" class="form-control" name="valor">
        </label>
        <label>
            <br>
            <button class="btn btn-default" type="button" onclick="location.href='javascript:window.history.go(-1)'">Voltar</button>
            &nbsp &nbsp
            <button class="btn btn-default" type="submit">Cadastrar</button>
        </label>
        <br>
    </form></center>