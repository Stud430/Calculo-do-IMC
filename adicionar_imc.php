<?php 

	function imc($a,$b){
		$calculo = ($b / ($a*$a));
		echo number_format($calculo, 2, ",", ".");//$calculo;
	}

	function result_imc($num)
	{
	    if ( $num < 18.5 ) {
	    	$result = "Abaixo do Peso";
	    	//echo $result;
	    	return $result;
	    } elseif ($num >= 18.5 and $num < 24.9) {
	    	$result = "Peso Ideal";
	    	echo $result;
	    	return $result;
	    } elseif ($num >= 24.9 and $num < 29.9) {
	    	$result = "Acima do Peso";
	    	echo $result;
	    	return $result;
	    } elseif ($num >= 29.9 and $num < 34.9) {
	    	$result = "Obesidade Grau 1";
	    	echo $result;
	    	return $result;
	    } elseif ($num >= 34.9 and $num < 39.9) {
	    	$result = "Obesidade Grau 2";
	    	echo $result;
	    	return $result;
	    } elseif ($num >= 39.9 and $num > 40) {
	    	$result = "Obesidade Grau 3 ( Mórbida )";
	    	echo $result;
	    	return $result;
	    }
	}

?>

<?php

include './conexaoPDO.php';

$conn = getConnection();

//$sql = 'INSERT INTO produto (descricao,qtd,valor) VALUES (:desc,:qtd,:valor)';
$sql = 'INSERT INTO imc (altura,peso,imc,resultado) VALUES (:alt,:peso,:imc,:resultado)';


$altura = $_POST["Altura"];
$peso = $_POST["Peso"];
$imc = (string) ($peso / ($altura*$altura));// imc($altura,$peso);
$resultado = (string) result_imc($imc);

$stmt = $conn->prepare($sql);
$stmt->bindParam(':alt', $altura);
$stmt->bindParam(':peso', $peso);
$stmt->bindParam(':imc', $imc);
$stmt->bindParam(':resultado', $resultado);

if($stmt->execute()){
    echo 'Salvo com sucesso!';
    header("location:imc.php");
}else{
    echo ' Erro ao salvar!';
}

?>