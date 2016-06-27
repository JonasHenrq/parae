<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "user";
$conexao = mysql_connect($host, $user, $pass);
mysql_select_db($banco) or die (mysql_error());
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<title>ÁREA DO CLIENTE</title>
  <link rel="shortcut icon" href="../css/imagens/parae.ico" type="image/x-icon" />
	<center><img src="../css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='index.php'"></center>
	<BR>
  <center><h3>ÁREA DO CLIENTE</h3></center>
	<br><br>
	<script language="Javascript">
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
            if(document.form.cpf.value==""){
                alert("Por favor, insira o CPF!");
                document.form.cpf.focus();
                return false;
            }
            if(document.form.codigo.value==""){
                alert("Por favor, insira o codigo!");
                document.form.codigo.focus();
                return false;
            }
        }

    </script> 

</head>
<body>

<form name="form" action="HistoricoCliente.php" method="post" onsubmit="return validar();">
  <center>
  <label>
 <h5>Informe o CPF</h5>
    <input type="text" class="form-control input-lg" name="cpf" placeholder="123.456.789-00" OnKeyPress="formatar('###.###.###-##', this)" maxlength="14">
  </label>
  <label>
  <h5>Informe o Codigo de Acesso Rapido</h5>
    <input type="text" class="form-control input-lg" name="codigo" >
  </label>
  <label>
  <button class="btn btn-default" type="submit">Entrar</button>   
  </label>
  <br>
</form></center>