<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "escola";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  mysqli_begin_transaction($conn);
  try {
    // Inserção dos dados na tabela "endereco"
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];

    $query_endereco = "INSERT INTO endereco (Cidade, Bairro, Rua, Numero) VALUES ('$cidade', '$bairro', '$rua', '$numero')";
    mysqli_query($conn, $query_endereco);

    // Inserção dos dados na tabela "aluno"
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $fk_ID_Endereco = mysqli_insert_id($conn);

    $query_aluno = "INSERT INTO aluno (Nome, Telefone, Email, fk_ID_Endereco) VALUES ('$nome','$telefone', '$email', $fk_ID_Endereco)";
    mysqli_query($conn, $query_aluno);

    mysqli_commit($conn);

    header('Location: process.php');
  } catch (Exception $error) {
    mysqli_rollback($conn);
  }
}

$query_total_alunos = "SELECT 	ID_Aluno, Nome FROM aluno";
$result_total_alunos = mysqli_query($conn, $query_total_alunos);


$registros_por_pagina = 10;

$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
$total_registros = mysqli_num_rows($result_total_alunos);

$inicio = ($registros_por_pagina * $pagina) - $registros_por_pagina;
$numero_paginas = ceil($total_registros / $registros_por_pagina);

$query_paginada = "SELECT 	ID_Aluno, Nome FROM aluno LIMIT $inicio, $registros_por_pagina";
$result = mysqli_query($conn, $query_paginada);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./styles.css" />
  <title>Cadastro de Alunos - SIN 143</title>
</head>

<body>
  <h1>Cadastro de Alunos</h1>
  <div class="form-container">
    <form method="POST" onsubmit="return validateEmailForm()">
      <div class="form-div">
        <div class="personal-info">
          <h2>Dados Pessoais</h2>

          <label for="nome">Nome</label>
          <input type="text" name="nome" id="nome" required>

          <label for="telefone">Telefone</label>
          <input type="tel" name="telefone" id="telefone" placeholder="(00) 00000-0000" pattern="\(\d{2}\) \d{5}\-\d{4}">

          <label for="email">Email</label>
          <input type="text" name="email" id="email" required>
        </div>

        <div class="address-info">
          <h2>Endereço</h2>

          <label for="cidade">Cidade</label>
          <input type="text" name="cidade" id="cidade" required>

          <label for="bairro">Bairro</label>
          <input type="text" name="bairro" id="bairro" required>

          <label for="rua">Rua</label>
          <input type="text" name="rua" id="rua" required>

          <label for="numero">Número</label>
          <input type="number" name="numero" id="numero" required>
        </div>
      </div>
      <button class="btn-submit-form" id="submit" type="submit">Salvar Cadastro</button>
    </form>
  </div>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Link</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
          while ($info = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $info['ID_Aluno'] . '</td>';
            echo '<td>' . $info['Nome'] . '</td>';
            echo '<td><a href="view.php?id=' . $info['ID_Aluno'] . '">Visualização Completa</a></td>';
            echo '</tr>';
          }
        } else {
          echo '<tr>';
          echo '<h2>Nenhum Aluno Cadastrado!</h2>';
          echo '</tr>';
        }
        $conn->close();
        ?>
      </tbody>
    </table>
  </div>

  <?php
  $pagina_anterior = $pagina - 1;
  $pagina_seguinte = $pagina + 1;
  ?>

  <div class="div-pagination">
    <ul class="pagination">
      <li>
        <?php
        if ($pagina_anterior != 0) {
          echo '<a href="process.php?pagina=' . $pagina_anterior . '" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>';
        }
        ?>
      </li>
      <div class="number-pagination">
        <?php
        for ($i = 1; $i <= $numero_paginas; $i++) {
          echo '<li><a href="process.php?pagina=' . $i . '">' . $i . '</a></li>';
        }
        ?>
      </div>
      <li>
        <?php
        if ($pagina_seguinte <= $numero_paginas) {
          echo '<a href="process.php?pagina=' . $pagina_seguinte . '" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>';
        }
        ?>
      </li>
    </ul>
  </div>

  <script type="text/javascript" defer src="./script.js"></script>
</body>

</html>