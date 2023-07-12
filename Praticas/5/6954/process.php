<?php
    $numbers = $_POST['number'];
    $sumNumbers = 0;

    foreach($numbers as $number){
        $sumNumbers = $sumNumbers + $number;
    };

    $numbersLength = count($numbers);
    $average = $sumNumbers/$numbersLength;
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css" />
    <title>Calculadora de Média - SIN 143 - Resultados</title>
</head>

<body>
    <h1>Calculadora de Média</h1>
    <form>
        <div class="container">
            <div id="inputs-container">
            <?php
                 echo "<p>SOMA TOTAL: $sumNumbers</p>";
                 echo "<p>QUANTIDADE DE NÚMEROS: $numbersLength</p>";
                 echo "<p>MÉDIA FINAL: $average</p>";

                 echo "<p><a href='index.html'>Voltar para a página anterior</a></p>";
            ?>
            </div>
        </div>
    </form>
</body>
</html>