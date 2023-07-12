<?php
require_once('aluno.php');
require_once('actionsForm.php');

$isEditing = false;
$aluno = new Aluno();
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id != null) {
  $isEditing = true;
  $alunoInfo = $aluno->buscarAluno($id);
}

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
    <form id="form" onsubmit="return validateEmailForm()" action="">
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

          <input hidden name="id_aluno" id="id_aluno" value="<?php echo $id; ?>">
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
          <th>ID</th>
          <th>Nome</th>
          <th>Link</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody id="body-table-form"></tbody>
    </table>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" defer src="./script.js"></script>
  <script type="text/javascript" defer src="./utils.js"></script>
</body>

</html>