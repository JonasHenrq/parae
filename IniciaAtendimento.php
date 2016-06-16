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
$ia = $_GET['ia'];
if($ia){
    session_start();
    $setor = $_POST['setor'];
    $_SESSION["setor"] = $setor;
    header("Location: Painel.php?passo=");
}
?>

<?php
function setorDisp(){
    $BD = "SELECT * FROM vaga";
    $sql = mysql_query($BD) or die(mysql_error());
    $row = mysql_num_rows($sql);
    if ($row > 0){
        while ($linha = mysql_fetch_array($sql)) {
            $status = $linha['status'];
            if ($status) {
                $id = $linha['id'];
                $nome = $linha['setor'];
                echo '<option value="'.$id.'">'.$nome.'</option>';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <title>Iniciando Atendimento...</title>
    <link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
    <center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
     <div align="right"> Olá, <?php echo $NomeUser ?> | <a href="paginicial.php"><i class="icon-home"></i></a> | <a href="logout.php">Sair</a></div>
    <center><h3>Selecione o setor que deseja iniciar o atendimento:</h3></center>
    <br><br>
</head>
<body>

    <form name = "form" action="IniciaAtendimento.php?ia=1" method="post" onsubmit="return validar();">
        <center>
            <label>
            <h5>Setor:</h5>
            <SELECT name= "setor">
                <?php
                setorDisp();
                ?>
            </SELECT>
        </label>
        <label>
        <br>
            <button class="btn btn-default" type="submit">INICIAR</button></p>
        </label>
        <br>
    </form></center>