
<?php
	include_once './conexaoPDO.php';
  	$conn = getConnection();
?>

<?php 

	function imc($a,$b){
		$calculo = ($b / ($a*$a));
		echo number_format($calculo, 2, ",", ".");//$calculo;
	}

	function result_imc($num)
	{
	    if ( $num <= 18.5 ) {
	    	$result = "Abaixo do Peso";
	    	//echo $result;
	    	return $result;
	    } elseif ($num > 18.5 and $num <= 24.9) {
	    	$result = "Peso Ideal";
	    	//echo $result;
	    	return $result;
	    } elseif ($num > 24.9 and $num <= 29.9) {
	    	$result = "Acima do Peso";
	    	//echo $result;
	    	return $result;
	    } elseif ($num > 29.9 and $num <= 34.9) {
	    	$result = "Obesidade Grau 1";
	    	//echo $result;
	    	return $result;
	    } elseif ($num > 34.9 and $num <= 39.9) {
	    	$result = "Obesidade Grau 2";
	    	//echo $result;
	    	return $result;
	    } elseif ($num >= 40) {
	    	$result = "Obesidade Grau 3 ( Mórbida )";
	    	//echo $result;
	    	return $result;
	    }
	}

?>

<?php

	if(isset($_POST['editar']))
{
	$id = $_POST['id'];
    $data = $_POST['Data'];
    $altura = $_POST['Altura'];
    $peso = $_POST['Peso'];
    $imc = ($peso / ($altura*$altura));// imc($altura,$peso);
	$resultado = result_imc($imc);

    // Verificando os campos se estao preenchidos
    if(empty($data) || empty($altura) || empty($peso)) {
        if(empty($data)) {
            echo "<font color='red'>Campo Data Obrigatorio.</font><br/>";
        }
        if(empty($altura)) {
            echo "<font color='red'>Campo Altura Obrigatorio.</font><br/>";
        }
        if(empty($peso)) {
            echo "<font color='red'>Campo Peso Obrigatorio.</font><br/>";
        }
    } else {
        //atualizado dados na tabela
        $sql = "UPDATE imc SET data_pesagem = :data, altura = :altura, peso = :peso, imc = :imc, resultado = :resultado WHERE pesagem=:id";

        $query = $conn->prepare($sql);

        $query->bindparam(':id', $id);
        $query->bindparam(':data', $data);
        $query->bindparam(':altura', $altura);
        $query->bindparam(':peso', $peso);
		$query->bindParam(':imc', $imc);
		$query->bindParam(':resultado', $resultado);
        $query->execute();
        //Redirecionado para a pagina de Listagem
        header("Location: imc.php");
    }
}
?>

<?php
	// pega o ID da URL
	$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

	// Consulta a tabela de Login
    $consulta = "SELECT * FROM imc WHERE pesagem = :id ";

	$imc = $conn->prepare($consulta);
	$imc->execute(array(':id' => $id));

	$linha = $imc->fetch(PDO::FETCH_ASSOC)
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> IMC </title>

<link rel="stylesheet" type="text/css" href="styleAlterar.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">	
</head>

<hr>

<body>
<form method="post" action="alterar_imc.php">
	
<br>
<h4> Alterar IMC </h4>
<br>

<div class="form-row">
  	
  	<div class="col-2"> 
      <label>Data da Pesagem</label>
      <input type="text" name="Data" class="form-control" value="<?php echo $linha["data_pesagem"] ?>">
    </div> 

    <div class="col-2"> 
      <label>Altura</label>
      <input type="text" name="Altura" class="form-control" value="<?php echo $linha["altura"] ?>">
    </div> 
	
    <div class="col-2"> 
      <label>Peso</label>
     <input type="text" name="Peso" class="form-control" value="<?php echo $linha["peso"] ?>">
    </div>

  	<div class="col">
		<input type="hidden" name="id" value="<?php echo $linha["pesagem"] ?>">
	</div>
</div>

  <br>
<h4><button type="submit" name="editar" class="btn btn-warning" value="submit">Atualizar</button></h4>


</form>

<br>
<hr>

</body>

</html>