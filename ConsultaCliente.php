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
function obtemVeiculos($id){
   $BD = "SELECT * FROM veiculo WHERE cliente = '$id'";
   $sql = mysql_query($BD) or die(mysql_error());
   $row = mysql_num_rows($sql);
   if($row){
    while ($linha = mysql_fetch_array($sql)) {
     $placa = $linha['placa'];
     $modelo = $linha['modelo']; 
     echo "'<div class=".'"row-fluid"'.">
     <div class=".'"span3"'."><h5>Veiculo:</h5>$modelo</div>
            <div class=".'"span3"'."><h5>Placa:</h5>$placa</div>'
      </div>";
    }
   }
}

function consulta(){
  $nome = $_GET['nome'];
  $cpf = $_GET['cpf'];
  $codigo = $_GET['codigo'];
  if($cpf){
    $BD = "SELECT * FROM cliente WHERE cpf = '$cpf'";
    $sql = mysql_query($BD) or die(mysql_error());
    $row = mysql_num_rows($sql);
    if ($row > 0){
      while ($linha = mysql_fetch_array($sql)) {
        if ($row) {
          $id= $linha['id'];
          $nome = $linha['nome'];
          $cpf= $linha['cpf'];
          $rg = $linha['rg'];
          $endereco = $linha['endereco']; 
          $telefone = $linha['telefone'];
          $placa = $linha['placa'];
          $modelo = $linha['modelo'];
          $convenio = $linha['convenio'];
          $codigo = $linha['codigo'];
          $saldo = $linha['saldo'];
          $consultaNomeConvenio = mysql_query("SELECT nome FROM convenio WHERE id = '$convenio'") or die(mysql_error());
          $nomeconv = mysql_fetch_row($consultaNomeConvenio);
          echo '
          <div class="row-fluid">
            <div class="span3"><h5>CODIGO ACESSO RAPIDO:</h5><b>'.$codigo.'</b></div>
            <div class="span3"><h5>Convênio:</h5>'.$nomeconv[0].'</div>
            <div class="span3"><h4>Saldo em Crédito:</h4><h5>R$'.$saldo.'</h5></div><br>
            <center><div class="span3"><button class="btn btn-success btn-lg btn-block" type="button">Crédito Cliente</button></div></center>
          </div>
          <br>
          <div class="row-fluid">
            <div class="span3"><h5>Nome:</h5>'.$nome.'</div>
            <div class="span3"><h5>CPF:</h5>'.$cpf.'</div>
            <div class="span3"><h5>RG:</h5>'.$rg.'</div>
            <center><div class="span3"><button class="btn btn-default btn-lg btn-block" type="button" onclick="location.href='."'AdicionaVeiculo.php?id=".$id."'".'">Adicionar Veículo</button></div></center>
          </div>
          <div class="row-fluid">
            <div class="span3"><h5>Telefone:</h5>'.$telefone.'</div>
            <div class="span6"><h5>Endereço:</h5>'.$endereco.'</div>
            <center><div class="span3"><button class="btn btn-warning btn-lg btn-block" type="button" onclick="location.href='."'AlteraCliente.php?id=".$id."&func=3'".'">Alterar Dados Cliente</button></div></center>

          </div>
          <br>
          <div class="row-fluid">
            <div class="span3"></div>
            <div class="span3"></div>
            <div class="span3"></div>
            <center><div class="span3"><button class="btn btn-danger btn-lg btn-block" type="button" onclick="location.href='."'ConfirmaExclusao.php?id=".$id."&nome=$nome"."&t=3'".'">Remover Cliente</button></div></center>
          </div>
          ';
          echo "<h5>Veículos Cadastrados</h5>";
          obtemVeiculos($id);
        }
      }
    }
  }elseif($codigo){
    $BD = "SELECT * FROM cliente WHERE codigo = '$codigo'";
    $sql = mysql_query($BD) or die(mysql_error());
    $row = mysql_num_rows($sql);
    if ($row > 0){
      while ($linha = mysql_fetch_array($sql)) {
          $id = $linha['id'];
          $nome = $linha['nome'];
          $cpf= $linha['cpf'];
          $rg = $linha['rg'];
          $endereco = $linha['endereco']; 
          $telefone = $linha['telefone'];
          $placa = $linha['placa'];
          $modelo = $linha['modelo'];
          $convenio = $linha['convenio'];
          $codigo = $linha['codigo'];
          $saldo = $linha['saldo'];
          $consultaNomeConvenio = mysql_query("SELECT nome FROM convenio WHERE id = '$convenio'") or die(mysql_error());
          $nomeconv = mysql_fetch_row($consultaNomeConvenio);
          echo '
          <div class="row-fluid">
            <div class="span3"><h5>CODIGO ACESSO RAPIDO:</h5><b>'.$codigo.'</b></div>
            <div class="span3"><h5>Convênio:</h5>'.$nomeconv[0].'</div>
            <div class="span3"><h4>Saldo em Crédito:</h4><h5>R$'.$saldo.'</h5></div><br>
            <center><div class="span3"><button class="btn btn-success btn-lg btn-block" type="button">Crédito Cliente</button></div></center>
          </div>
          <br>
          <div class="row-fluid">
            <div class="span3"><h5>Nome:</h5>'.$nome.'</div>
            <div class="span3"><h5>CPF:</h5>'.$cpf.'</div>
            <div class="span3"><h5>RG:</h5>'.$rg.'</div>
            <center><div class="span3"><button class="btn btn-default btn-lg btn-block" type="button" onclick="location.href='."'AdicionaVeiculo.php?id=".$id."'".'">Adicionar Veículo</button></div></center>
          </div>
          <div class="row-fluid">
            <div class="span3"><h5>Telefone:</h5>'.$telefone.'</div>
            <div class="span6"><h5>Endereço:</h5>'.$endereco.'</div>
            <center><div class="span3"><button class="btn btn-warning btn-lg btn-block" type="button" onclick="location.href='."'AlteraCliente.php?id=".$id."&func=3'".'">Alterar Dados Cliente</button></div></center>

          </div>
          <br>
          <div class="row-fluid">
            <div class="span3"></div>
            <div class="span3"></div>
            <div class="span3"></div>
            <center><div class="span3"><button class="btn btn-danger btn-lg btn-block" type="button" onclick="location.href='."'ConfirmaExclusao.php?id=".$id."&nome=$nome"."&t=3'".'">Remover Cliente</button></div></center>
          </div>
          ';
          echo "<h5>Veículos Cadastrados</h5>";
          obtemVeiculos($id);
          '';
      }
    }else{echo "<center>Não foi encontrado nenhum cliente com os dados informados!</center>";}
  }elseif ($nome) {
    $BD = "SELECT * FROM cliente WHERE nome LIKE '%$nome%'";
    $sql = mysql_query($BD) or die(mysql_error());
    $row = mysql_num_rows($sql);
    if ($row > 0){
      echo '<center><table class="table table-striped"></center>';
      echo '<th><center>Nome</center></th>';
      echo '<th></th>';
      echo '</tr></thead>';
      while ($linha = mysql_fetch_array($sql)) {
        $status = $linha['status'];
        if($status){
          $nome = $linha['nome'];
          $cpf = $linha['cpf'];
          echo '<tr>';
          echo '<td>' .'<center>'. $nome. '</center>'.'</td>';
          echo '<td>' .'<center>'. "<a href='ConsultaCliente.php?cpf=$cpf&nome=0&codigo=0'>Consultar Dados</a>" .'</center>'. '</td>';
          echo '</tr>';
        }
      }
      echo "</table>";
    }else{echo "<center>Não foi encontrado nenhum cliente com os dados informados!</center>";}
  }else{
    $BD = "SELECT * FROM cliente";
    $sql = mysql_query($BD) or die(mysql_error());
    $row = mysql_num_rows($sql);
    if ($row > 0){
      echo '<center><table class="table table-striped"></center>';
      echo '<th><center>Nome</center></th>';
      echo '<th></th>';
      echo '</tr></thead>';
      while ($linha = mysql_fetch_array($sql)) {
        $status = $linha['status'];
        if($status){
          $nome = $linha['nome'];
          $cpf = $linha['cpf'];
          echo '<tr>';
          echo '<td>' .'<center>'. $nome. '</center>'.'</td>';
          echo '<td>' .'<center>'. "<a href='ConsultaCliente.php?cpf=$cpf&nome=0&codigo=0'>Consultar Dados</a>" .'</center>'. '</td>';
          echo '</tr>';
        }
      }
      echo "</table>";
    }else{echo "<center>Não foi encontrado nenhum cliente com os dados informados!</center>";}
  }
}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<title>Consulta Cliente</title>
<link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
<center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
<div align="right"> Olá, <?php echo $NomeUser ?> | <a href="logout.php">Sair</a></div>
<center><h3>CONSULTA CLIENTE</h3></center>
<br><br>
</head>
<body>
  <div>
    <div class="row-fluid">
      <div class="span12">
        <?php consulta(); ?>
        <br><br><center> <button class="btn btn-default" type="button" onclick="location.href='javascript:window.history.go(-1)'">Voltar</button></center>
      </div>
    </div>
  </div>
</body>
</html>