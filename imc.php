
<?php
	include './conexaoPDO.php';
	$conn = getConnection();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> IMC </title>

<link rel="stylesheet" type="text/css" href="styleIMC.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">	
</head>


<body>
<form method="post" action="adicionar_imc.php">
	
<br>

 
	<h4> Cadastrar IMC </h4>
	<br>
  <div class="form-row">
    <div class="col-2"> 
      <label>Altura</label>
      <input type="text" name="Altura" class="form-control">
    </div> 
	
    <div class="col-2"> 
      <label>Peso</label>
     <input type="text" name="Peso" class="form-control">
    </div> 
	
  <!--	<input type="submit" name="cadastrar"> -->
  </div>
  <br>
  <h4><button type="submit" name="cadastrar" class="btn btn-dark">Cadastrar</button></h4>

</form>

<br>
<hr>


	<br><h2> Listagem</h2><br><br>

	<?php
		$sql = "SELECT * FROM imc ORDER BY pesagem";

		//Seleciona os registros
       $consulta = $conn->prepare($sql);
       $consulta->execute();

       if (!$consulta) {
         die("Erro no Banco!");
       }


       echo '<link rel="stylesheet" href="css/styleIMC.css">';
       echo '<center><table class="table table-hover"  cellspacing="0" cellpadding="0">';
       echo "<thead>";
       echo "<tr>";
       echo "<th><center> Pesagem </center></th>";
       echo "<th><center> Data da Pesagem </center></th>";
       echo "<th><center> Altura </center></th>";
       echo "<th><center> Peso </center></th>";
       echo "<th><center> IMC </center></th>";
       echo "<th><center> Resultado </center></th>";
       echo "<th><center> Ações </center></th>";             
       echo "</tr>";
       echo "</thead>";
       echo "<tbody>";

       while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          echo "<th><center>" . $linha['pesagem'] . "º Dia" . "</center></th>";
          echo "<td><center>" . $linha['data_pesagem'] . "</center></td>";
          echo "<td><center>" . $linha['altura'] . "</center></td>";
          echo "<td><center>" . $linha['peso'] . "</center></td>";
          echo "<td><center>" . $linha['imc'] . "</center></td>";
          echo "<td><center>" . $linha['resultado'] . "</center></td>";
	?>

      <td><center><a class="btn btn-warning" href="alterar_imc.php?id=<?php echo $linha["pesagem"]?>">Alterar</a> <a class="btn btn-danger" href="excluir_imc.php?id=<?php echo $linha["pesagem"]?>">Excluir</a> </center></td>

    <?php
          echo "</tr>";
        }
        
        echo "</tbody>";        
        echo "</table></center>";

        ?>


</body>


</html>

<!--
<?php
    		// Determinar TimeZone
//    		date_default_timezone_set('America/Sao_Paulo');
//    		setlocale(LC_TIME, "pt_BR");

//    		$agora = getdate();

    		// Criar Elementos
//    		$ano = $agora["year"];
//    		$mes = $agora["mon"];
//    		//$mes = $agora["month"];
//    		$dia = $agora["mday"];

//    		$hora = $agora["hours"];
//    		$minuto = $agora["minutes"];
//    		$segundo = $agora["seconds"];

//    		echo $dia . "/" . $mes . "/"  . $ano . " - " . $hora . ":" . $minuto . ":" . $segundo;

    	?>
-->

<!-- 
    EXEMPLO
<div class="form-group col-md-2">
  <h4> Cadastrar IMC </h4>
  <br>
  <div class="form-row"> 
  <label>Altura</label>
  <input type="text" name="Altura" class="form-control">

  <br><br>
  <label>Peso</label>
  <input type="text" name="Peso" class="form-control">

  <br><br>
  <input type="submit" name="cadastrar">
  </div>
</div>
-->