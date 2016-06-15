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

<?php
function conveniosDisp(){
    $BD = "SELECT * FROM convenio";
    $sql = mysql_query($BD) or die(mysql_error());
    $row = mysql_num_rows($sql);
    echo '<option value="2">Particular</option>';
    if ($row > 0){
        while ($linha = mysql_fetch_array($sql)) {
            $status = $linha['status'];
            if ($status) {
                $id = $linha['id'];
                $nome = $linha['nome'];
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
    <title>Cadastro Cliente</title>
    <link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
    <center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
    <div align="right"> Olá, <?php echo $NomeUser ?> | <a href="logout.php">Sair</a></div>
    <center><h3>CADASTRO CLIENTE</h3></center>
    <br><br>
    <script language="Javascript">

        function validar(){
            if(document.form.name.value==""){
                alert("Por favor, insira o nome!");
                document.form.name.focus();
                return false;
            }
            if(document.form.cpf.value==""){
                alert("Por favor, insira o CPF!");
                document.form.cpf.focus();
                return false;
            }
            if(document.form.rg.value==""){
                alert("Por favor, insira o RG!");
                document.form.rg.focus();
                return false;
            }
            if(document.form.endereço.value==""){
                alert("Por favor, informe o endereço!");
                document.form.endereço.focus();
                return false;
            }
            if(document.form.telefone.value=="") {
                alert("Por favor, insira o telefone!");
                document.form.telefone.focus();
                return false;
            }
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
            if(document.form.codigo.value==""){
                alert("Por favor, insira o numero do Cartão!");
                document.form.codigo.focus();
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

    <form name = "form" action="RealizaCadastroCliente.php" method="post" onsubmit="return validar();">
        <center>
            <label>
                <h5>Nome:</h5>
                <input type="text" class="form-control" name="name" placeholder="José da Silva">
            </label>
            <label>
                <h5>CPF:</h5>
                <input type="text" class="form-control input-lg" name="cpf" placeholder="123.456.789-00" OnKeyPress="formatar('###.###.###-##', this)" maxlength="14">
            </label>
            <label>
                <h5>RG:</h5>
                <input type="text" class="form-control input-lg" name="rg" placeholder="MG19199199" maxlength="12">
            </label>
            <h5>Endereço:</h5>
            <input type="text" class="form-control input-lg" name="endereco" placeholder="Rua, Nº, Bairro, CEP, Cidade">
            <h5>Telefone:</h5>
            <input type="tel" class="form-control input-lg" placeholder="XX 3123-4567" OnKeyPress="formatar('## ####-####', this)" name="telefone" maxlength="13">
            <h5>Placa:</h5>
            <input type="text" class="form-control input-lg" name="placa" placeholder="ABC-1234" OnKeyPress="formatar('###-####', this)" maxlength="8">
        </label>
        <label>
            <h5>Modelo:</h5>
            <input type="text" class="form-control" name="modelo" placeholder="Volkswagen Gol">
        </label>
        <label>
            <h5>Convênio:</h5>
            <SELECT name= "convenio">
                <?php
                conveniosDisp();
                ?>
            </SELECT>
        </label>
        <label>
        <h5>Codigo Cartão:</h5>
            <input type="text" class="form-control" name="codigo" >
        </label>
        <label>
            <br>
            <p><button class="btn btn-default" type="button" onclick="location.href='javascript:window.history.go(-1)'">Voltar</button>   
            &nbsp &nbsp&nbsp &nbsp
            <button class="btn btn-default" type="submit">Cadastrar</button></p>
        </label>
        <br>
    </form></center>