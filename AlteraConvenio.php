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
		header("Location: paginicial.php");
		exit;
	}
	$NomeUser=$_SESSION["user"];
}
?>


<?php
$id=$_GET['id'];
$alt=$_GET['alt'];
if ($id>0) {
	$funcao = $_GET['fun'];
	$id = $_GET['id'];
	if ($funcao==2){
		$altera = ("UPDATE cliente SET convenio = 2 WHERE convenio = '$id'");
		$delete = ("UPDATE convenio SET status = 0 WHERE id ='$id'");
		mysql_query($altera);
		mysql_query($delete);
		header("Location: ConsultaConvenio.php");
		exit;
	}
} elseif ($alt) {
	$id = $_POST['id'];
	$nome = $_POST['name'];
	$porc= $_POST['porc'];
	$validade= $_POST['validade'];
	$up = "UPDATE convenio SET nome = '$nome', porc = '$porc', validade = '$validade' WHERE id ='$id'";
	mysql_query($up) or die(mysql_error());
	header("Location: Sucesso.php");
	exit;
}

?>

<?php
function geraID(){
	$id=$_GET['id'];
	echo '<input type="hidden" name="id" value="'.$id.'">';	
}
?>

<?php
function gera(){
	for ($i=0; $i < 101 ; $i++) { 
		echo '<option value="'.$i.'">'.$i.'%</option>';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Cadastro Convenio</title>
	<link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
	<center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
	<div align="right"> Olá, <?php echo $NomeUser ?> | <a href="logout.php">Sair</a></div>
	<center><h3>ATUALIZAR DADOS DO CONVÊNIO</h3></center>
	<div id="titulo2"><h5><center>Por favor reinsira os dados para atualizar!</center></h5></div>
	<br>
	<script>
		function formatar(mascara, documento){
			var i = documento.value.length;
			var saida = mascara.substring(0,1);
			var texto = mascara.substring(i)

			if (texto.substring(0,1) != saida){
				documento.value += texto.substring(0,1);
			}
		}
	</script>
	<script language="Javascript">
		function validar(){
			if(document.form.name.value==""){
				alert("Por favor insira o nome!");
				document.form.name.focus();
				return false;
			}
			if(document.form.validade.value==""){
				alert("Por favor insira a validade!");
				document.form.validade.focus();
				return false;
			} else {
				return true;       
			}
		}		
	</script>


</head>
<body>

	<form name = "form" action="AlteraConvenio.php?alt=1&id=0" method="post" onsubmit="return validar();">
		<center><label>
			<h5>Nome:</h5>
			<input type="text" class="form-control" name="name">
		</label>
		<label>
			<h5>Validade: </h5>
			<input type="text" class="form-control input-lg" name="validade" placeholder="DD/MM/AAAA" OnKeyPress="formatar('##/##/####', this)" maxlength="10">
		</label>
		<label>
			<h5>Desconto:</h5>
			<SELECT name= "porc">
				<?php
				gera();
				?>
			</SELECT>
			<?php
			geraID();
			?>
		</label>
		<label>
			<br>
			<button class="btn btn-default" type="button" onclick="location.href='paginicial.php'">Voltar</button>
			&nbsp &nbsp 
			<button class="btn btn-default" type="submit">Atualizar</button>   
		</label>
		<br>
	</form>
	<?php
  echo '<center><b><h4>Dados Atuais</h4></b></center>';
  $BD = "SELECT * FROM convenio WHERE id = '$id'";
  $sql = mysql_query($BD) or die(mysql_error());
  $row = mysql_num_rows($sql);
  if ($row > 0){
    echo '<center><table width="50%" border=1 cellpadding=2 cellspacing=0></center>';
    echo '<thead><tr>';
    echo '<th>Convênio</th>';
    echo '<th>Validade</th>';
    echo '<th>Desconto</th>';
    echo '</tr></thead>';
    while ($linha = mysql_fetch_array($sql)) {
      $id = $linha['id'];
      $nome = $linha['nome'];
      $porc = $linha['porc'];
      $validade = $linha['validade'];
      echo '<tr>';
      echo '<td>' .'<center>'. $nome. '</center>'.'</td>';
      echo '<td>' .'<center>'. $validade. '</center>'.'</td>';
      echo '<td>' .'<center>'. $porc.'%'. '</center>'.'</td>';
      echo '</tr>';
    }
  }
  ?>
	</center>

</body>
</html>