<?php
require_once('aluno.php');
require_once('actionsForm.php');

$isEditing = false;
$aluno = new Aluno();

if (isset($_GET['action']) && $_GET['action'] == "UPDATE" && isset($_GET['id'])) {
  $isEditing = true;
  $id = $_GET['id'];
  $alunoInfo = $aluno->buscarAluno($id);
}

$itensPorPagina = 10;

$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$offset = ($paginaAtual - 1) * $itensPorPagina;
$alunos = $aluno->listarAlunosPaginado($itensPorPagina, $offset);

$totalAlunos = $aluno->totalAlunos();
$totalPaginas = ceil($totalAlunos / $itensPorPagina);
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
    <form method="POST" onsubmit="return validateEmailForm()" action="actionsForm.php">
      <div class="form-div">
        <div class="personal-info">
          <h2>Dados Pessoais</h2>

          <label for="nome">Nome</label>
          <input type="text" name="nome" id="nome" value="<?php if ($isEditing) echo $alunoInfo['Nome']; ?>" required>

          <label for="telefone">Telefone</label>
          <input type="tel" name="telefone" id="telefone" placeholder="(00) 00000-0000" pattern="\(\d{2}\) \d{5}\-\d{4}" value="<?php if ($isEditing) echo $alunoInfo['Telefone']; ?>">

          <label for="email">Email</label>
          <input type="text" name="email" id="email" value="<?php if ($isEditing) echo $alunoInfo['Email']; ?>" required>
        </div>

        <div class="address-info">
          <h2>Endereço</h2>

          <label for="cidade">Cidade</label>
          <input type="text" name="cidade" id="cidade" value="<?php if ($isEditing) echo $alunoInfo['Cidade']; ?>" required>

          <label for="bairro">Bairro</label>
          <input type="text" name="bairro" id="bairro" value="<?php if ($isEditing) echo $alunoInfo['Bairro']; ?>" required>

          <label for="rua">Rua</label>
          <input type="text" name="rua" id="rua" value="<?php if ($isEditing) echo $alunoInfo['Rua']; ?>" required>

          <label for="numero">Número</label>
          <input type="number" name="numero" id="numero" value="<?php if ($isEditing) echo $alunoInfo['Numero']; ?>" required>

          <input hidden name="id_aluno" id="id_aluno" value="<?php if ($isEditing) echo  $alunoInfo['ID_Aluno']; ?>">
        </div>
      </div>
      <?php if ($isEditing) : ?>
        <button class="btn-submit-form" name="atualizar" value="atualizar" id="atualizar" type="submit">Atualizar Cadastro</button>
      <?php else : ?>
        <button class="btn-submit-form" name="cadastrar" value="cadastrar" id="cadastrar" type="submit">Salvar Cadastro</button>
      <?php endif; ?>
    </form>
  </div>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Link</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($alunos as $info) {
          echo '<tr>';
          echo '<td>' . $info['Nome'] . '</td>';
          echo '<td><a href="view.php?id=' . $info['ID_Aluno'] . '">Visualização Completa</a></td>';
          echo '<td><a class="btn-edit" href="process.php?action=UPDATE&id=' . $info['ID_Aluno'] . '">Editar</a></td>';
          echo '<td><a class="btn-delete" href="process.php?action=DELETE&id=' . $info['ID_Aluno'] . '">Excluir</a></td>';
          echo '</tr>';
        }
        ?>
      </tbody>
    </table>
  </div>

  <div class="div-pagination">
    <?php
    for ($paginas = 1; $paginas <= $totalPaginas; $paginas++) {
      echo "<a class='number-pagination' href='process.php?pagina=" . $paginas . "'>" . $paginas . "</a> ";
    }
    ?>
  </div>

  <script type="text/javascript" defer src="./script.js"></script>
</body>

</html>