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
    $id = $_GET['id'];
    if(!$id){
        $id = $_POST['id'];
        $placa = $_POST['placa'];
        $modelo = $_POST['modelo'];
        $sql = mysql_query("INSERT INTO veiculo (modelo, placa, cliente)
            VALUES ('$modelo', '$placa', '$id')")or die(mysql_error());
        header("Location: sucesso.php");
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <title>Cadastro Cliente</title>
    <link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
    <center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
    <div align="right"> Olá, <?php echo $NomeUser ?> | <a href="paginicial.php"><i class="icon-home"></i></a> | <a href="logout.php">Sair</a></div>
    <center><h3>ADICIONA VEÍCULO CLIENTE</h3></center>
    <br><br>
    <script language="Javascript">

        function validar(){
            if(document.form.placa.value=="") {
                alert("Por favor, informe a placa do veículo!");
                document.form.placa.focus();
                return false;
            }
            if(document.form.modelo.value==""){
                alert("Por favor, insira o modelo do veículo!");
                document.form.modelo.focus();
                return false;
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

    <form name = "form" action="AdicionaVeiculo.php?id=" method="post" onsubmit="return validar();">
        <center>
            <h5>Placa:</h5>
            <input type="text" class="form-control input-lg" style="text-transform:uppercase" name="placa" placeholder="ABC-1234" OnKeyPress="formatar('###-####', this)" maxlength="8">
        </label>
        <label>
            <h5>Modelo:</h5>
            <input type="text" class="form-control" name="modelo" placeholder="Volkswagen Gol">
            <?php geraID(); ?>
        </label>
        <label>
            <br>
            <p><button class="btn btn-default" type="button" onclick="location.href='paginicial.php'">Voltar</button>   
            &nbsp &nbsp&nbsp &nbsp
            <button class="btn btn-default" type="submit">Cadastrar</button></p>
        </label>
        <br>
    </form></center>