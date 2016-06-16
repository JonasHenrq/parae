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
  $diaI = $_POST['diaI'];
  $diaF = $_POST['diaF'];
function geraDados(){
  $diaI = $_POST['diaI'];
  $diaF = $_POST['diaF'];
  $BD = "SELECT * FROM convenio";
  $sql = mysql_query($BD) or die(mysql_error());
  $row = mysql_num_rows($sql);
  if ($row > 0){
    while ($linha = mysql_fetch_array($sql)) {
      $total = 0;
      $id = $linha['id'];
      $nome = $linha['nome'];
      $BD2 = "SELECT * FROM atendimento WHERE '$diaI' <= date(data) AND '$diaF' >= date(data) AND conv = '$id'";
      $sql2 = mysql_query($BD2) or die(mysql_error());
      $row2 = mysql_num_rows($sql2);
      if($row2>0){
        while ($linha2 = mysql_fetch_array($sql2)){
          $total+= $linha2['valor'];
        }
        $total = 'R$' . number_format($total, 2, ',', '.');
        echo "<center><h5>$nome:</h5></center>
        <label>
          <center>Numero de Atendimentos: $row2</center>
          <center>Valor Arrecadado: $total</center>
        </label>";
      }
    }
  }
}


function geraDados3(){
  $diaI = $_POST['diaI'];
  $diaF = $_POST['diaF'];
  $total2=0;
  $cont = 0;
  $BD = "SELECT * FROM convenio ORDER BY nome";
  $sql = mysql_query($BD) or die(mysql_error());
  $row = mysql_num_rows($sql);
  if ($row > 0){
    while ($linha = mysql_fetch_array($sql)) {
      $total = 0;
      $id = $linha['id'];
      $nome = $linha['nome'];
      $BD2 = "SELECT * FROM atendimento WHERE '$diaI' <= date(data) AND '$diaF' >= date(data) AND conv = '$id'";
      $sql2 = mysql_query($BD2) or die(mysql_error());
      $row2 = mysql_num_rows($sql2);
      if($row2>0){
        while ($linha2 = mysql_fetch_array($sql2)){
          $total+= $linha2['valor'];
        }
        $total2 +=$total;
        $cont +=$row2;
      }
    }
    $total2 = 'R$' . number_format($total2, 2, ',', '.');
    echo "<center><h4>Total Geral:</h4></center>";
    echo "<center><h5>Atendimentos: $cont</h5></center>";
    echo "<center><h5>Valor Arrecadado: $total2</h5></center>";
  }
}

function geraDados2(){
  $diaI = $_POST['diaI'];
  $diaF = $_POST['diaF'];
  $BD = "SELECT * FROM convenio ORDER BY nome asc";
  $sql = mysql_query($BD) or die(mysql_error());
  $row = mysql_num_rows($sql);
  if ($row > 0){
    while ($linha = mysql_fetch_array($sql)) {
      $total = 0;
      $id = $linha['id'];
      $nome = $linha['nome'];
      $BD2 = "SELECT * FROM atendimento WHERE '$diaI' <= date(data) AND '$diaF' >= date(data) AND conv = '$id' ";
      $sql2 = mysql_query($BD2) or die(mysql_error());
      $row2 = mysql_num_rows($sql2);
      if($row2>0){
        while ($linha2 = mysql_fetch_array($sql2)){
          $total+= $linha2['valor'];
        }
        echo "['".$nome."', $row2, $total],";
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
  <div align="right"> Olá, <?php echo $NomeUser ?> | <a href="paginicial.php"><i class="icon-home"></i></a> | <a href="logout.php">Sair</a></div>
  <center><h3>RELATÓRIO</h3></center><BR><BR>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawStuff);

    function drawStuff() {
      var data = new google.visualization.arrayToDataTable([
        ['', 'Numero de atendimentos', 'Valor Total dos atendimentos'],
        <?php geraDados2(); ?>
        ]);

      var options = {
        width: 900,
        chart: {
          title: 'NUMERO DE ATENDIMENTO E VALOR ARRECADADO POR CONVÊNIO',
          subtitle: ''
        },
        series: {
            0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
            1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
          },
          axes: {
            y: {
              distance: {label: 'Numero de atendimentos'}, // Left y-axis.
              brightness: {side: 'right', label: 'Valor em R$'} // Right y-axis.
            }
          }
        };

        var chart = new google.charts.Bar(document.getElementById('dual_y_div'));
        chart.draw(data, options);
      };
    </script>
  </head>
  <body>
    <center><div id="dual_y_div" style="width: 900px; height: 500px;"></div></center>
    <br><br>
    <center><h3>DETALHAMENTO</h3></center>
    <center><h4>Periodo: <?php echo date('d/m/Y', strtotime($diaI)); ?> até <?php echo date('d/m/Y', strtotime($diaF)); ?></h4></center><br>
    <?php geraDados(); ?>
    <br>
    <?php geraDados3(); ?>
    <br>
    <center><button class="btn btn-default" type="button" onclick="location.href='javascript:window.history.go(-1)'">Voltar</button></center>
  </body>
  </html>