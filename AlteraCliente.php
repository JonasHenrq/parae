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
$id = $_GET['id'];
$func = $_GET['func'];
if ($func==1) {
	$remove = "UPDATE cliente SET status = 0 WHERE id ='$id'";
	mysql_query($remove);
	header("Location: sucesso.php");
	exit;
}elseif($func==2){
		#altera pelos posts recebidos do formulario;
	$conn = mysql_connect($host,$user,$pass) or die (mysql_error());
	mysql_select_db($banco) or die(mysql_error());
	$id = $_POST['id'];
	$nome = $_POST['name'];
	$cpf= $_POST['cpf'];
	$rg = $_POST['rg'];
	$endereco = $_POST['endereco'];	
	$telefone = $_POST['telefone'];
	$placa = $_POST['placa'];
	$modelo = $_POST['modelo'];
	$convenio = $_POST['convenio'];
	$codigo = $_POST['codigo'];
	if(($nome)&&($cpf)){
		$sql = mysql_query("UPDATE cliente SET nome = '$nome', cpf = '$cpf', rg = '$rg', endereco = '$endereco', telefone = '$telefone', convenio = '$convenio', codigo = '$codigo' WHERE id = '$id'");
		$sql = mysql_query("UPDATE veiculo SET modelo = '$modelo', placa = '$placa' WHERE cliente = '$id'");
		header("Location: sucesso.php");
		exit;
	}
}elseif($func!=3){
	header("Location: paginicial.php");
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

function geraID(){
	$id=$_GET['id'];
	echo '<input type="hidden" name="id" value="'.$id.'">';	
}

function obtemNome(){
	$id=$_GET['id'];
	$consulta = mysql_query("SELECT nome FROM cliente WHERE id = '$id'") or die(mysql_error());
    $dado= mysql_fetch_row($consulta);
    echo "$dado[0]";
}

function obtemCpf(){
	$id=$_GET['id'];
	$consulta = mysql_query("SELECT cpf FROM cliente WHERE id = '$id'") or die(mysql_error());
    $dado= mysql_fetch_row($consulta);
    echo "$dado[0]";
}

function obtemRg(){
	$id=$_GET['id'];
	$consulta = mysql_query("SELECT rg FROM cliente WHERE id = '$id'") or die(mysql_error());
    $dado= mysql_fetch_row($consulta);
    echo "$dado[0]";
}

function obtemEndereco(){
	$id=$_GET['id'];
	$consulta = mysql_query("SELECT endereco FROM cliente WHERE id = '$id'") or die(mysql_error());
    $dado= mysql_fetch_row($consulta);
    echo "$dado[0]";
}

function obtemTelefone(){
	$id=$_GET['id'];
	$consulta = mysql_query("SELECT telefone FROM cliente WHERE id = '$id'") or die(mysql_error());
    $dado= mysql_fetch_row($consulta);
    echo "$dado[0]";
}

function obtemPlaca(){
	$id=$_GET['id'];
	$consulta = mysql_query("SELECT placa FROM cliente WHERE id = '$id'") or die(mysql_error());
    $dado= mysql_fetch_row($consulta);
    echo "$dado[0]";
}

function obtemModelo(){
	$id=$_GET['id'];
	$consulta = mysql_query("SELECT modelo FROM cliente WHERE id = '$id'") or die(mysql_error());
    $dado= mysql_fetch_row($consulta);
    echo "$dado[0]";
}

function obtemCodigo(){
	$id=$_GET['id'];
	$consulta = mysql_query("SELECT codigo FROM cliente WHERE id = '$id'") or die(mysql_error());
    $dado= mysql_fetch_row($consulta);
    echo "$dado[0]";
}

function obtemConvenio(){
	$id=$_GET['id'];
	$consulta = mysql_query("SELECT convenio FROM cliente WHERE id = '$id'") or die(mysql_error());
    $dado= mysql_fetch_row($consulta);
    echo "$dado[0]";
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Atualizar dados cliente</title>
	<link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
	<center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
     <div align="right"> Olá, <?php echo $NomeUser ?> | <a href="paginicial.php"><i class="icon-home"></i></a> | <a href="logout.php">Sair</a></div>
	<center><h3>ATUALIZAÇÃO DADOS CLIENTE</h3></center>
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

	<form name = "form" action="AlteraCliente.php?id=&func=2" method="post" onsubmit="return validar();">
		<center>
			<label>
				<h5>Nome:</h5>
				<input type="text" class="form-control" name="name" value="<?php obtemNome();?>" placeholder="José da Silva">
			</label>
			<label>
				<h5>CPF:</h5>
				<input type="text" class="form-control input-lg" name="cpf"  value="<?php obtemCpf();?>" placeholder="123.456.789-00" OnKeyPress="formatar('###.###.###-##', this)" maxlength="14">
			</label>
			<label>
				<h5>RG:</h5>
				<input type="text" class="form-control input-lg" name="rg"  value="<?php obtemRg();?>" placeholder="MG19199199" maxlength="12">
			</label>
			<h5>Endereço:</h5>
			<input type="text" class="form-control input-lg" name="endereco"  value="<?php obtemEndereco();?>" placeholder="Rua, Nº, Bairro, CEP, Cidade">
			<h5>Telefone:</h5>
			<input type="tel" class="form-control input-lg" placeholder="XX 3123-4567"  value="<?php obtemTelefone();?>" OnKeyPress="formatar('## ####-####', this)" name="telefone" maxlength="13">
			<h5>Placa:</h5>
			<input type="text" class="form-control input-lg" name="placa"  value="<?php obtemPlaca();?>" placeholder="ABC-1234" OnKeyPress="formatar('###-####', this)" maxlength="8">
		</label>
		<label>
			<h5>Modelo:</h5>
			<input type="text" class="form-control" name="modelo"  value="<?php obtemModelo();?>" placeholder="Volkswagen Gol">
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
			<input type="text" class="form-control"  value="<?php obtemCodigo();?>" name="codigo" >
			<?php geraID(); ?>
		</label>
		<label>
			<br>
			<p><button class="btn btn-default" type="button" onclick="location.href='paginicial.php'">Voltar</button>   
				&nbsp &nbsp&nbsp &nbsp
				<button class="btn btn-default" type="submit">Atualizar</button></p>
			</label>
			<br>
		</form></center>
