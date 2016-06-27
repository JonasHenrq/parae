<?php 

$acao = $_GET['acao'];
$id = $_GET['id'];
if($acao){
	session_start();
	$_SESSION['valor']=$_POST['valor'];
	$_SESSION['id']=$_POST['id'];
	$valor=$_POST['valor'];
	if($valor==10){
		header("Location: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=X7NFPTE4XKXZ4");
	}
	if($valor==20){
		header("Location: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=48BBBYCCQTCFG");
	}
	if($valor==50){
		header("Location: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TSGUGAP8Y6YRW");
	}
	if($valor==100){
		header("Location: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=ZU89BXC3BBG3G");
	}

}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <title>Inserir Credito</title>
    <link rel="shortcut icon" href="../css/imagens/parae.ico" type="image/x-icon" />
    <center><img src="../css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" ></center>
    <center><h3>INSERIR CRÉDITO:</h3></center>
    <br><br>
</head>
<body>

    <form name = "form" action="FormularioInsereCredito.php?acao=1&id=" method="post" onsubmit="return validar();">
        <center>
            <label>
            <h5>Valor:</h5>
            <SELECT name= "valor">
                <option value="10">R$ 10,00</option>
                <option value="20">R$ 20,00</option>
                <option value="50">R$ 50,00</option>
                <option value="100">R$ 100,00</option>
            </SELECT>
            <input type="hidden" value="<?php echo "$id";?>" name="id">
        </label>
        <label>
        <br>
            <button class="btn btn-default" type="submit">INICIAR</button></p>
        </label>
        <br>
    </form></center>