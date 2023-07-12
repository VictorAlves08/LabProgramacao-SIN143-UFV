<?php
require_once('aluno.php');

$id_aluno = $_GET['id'];

$aluno = new Aluno();
$alunoInfo = $aluno->buscarAluno($id_aluno);

$userNameFromBD = isset($alunoInfo['Nome']) ? $alunoInfo['Nome'] : 'Aluno ' . $id_aluno;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css" />
    <?php
    echo '<title>Usuario ' . $userNameFromBD . '</title>';
    ?>

</head>

<body>
    <?php
    echo '<h1>' . $userNameFromBD . '</h1>';
    ?>
    <div class="table-container">
        <table>
            <thead class="thead-view">
                <tr>
                    <th class="th-view">ID</th>
                    <th class="th-view">Nome</th>
                    <th class="th-view">Telefone</th>
                    <th class="th-view">Email</th>
                    <th class="th-view">Cidade</th>
                    <th class="th-view">Bairro</th>
                    <th class="th-view">Rua</th>
                    <th class="th-view">Número</th>
                </tr>
            </thead>
            <tbody class="tbody-view">
                <?php
                if (isset($alunoInfo['Nome'])) {
                    echo '<tr>';
                    echo '<td>' . $alunoInfo['ID_Aluno'] . '</td>';
                    echo '<td>' . $alunoInfo['Nome'] . '</td>';
                    echo '<td>' . $alunoInfo['Telefone'] . '</td>';
                    echo '<td>' . $alunoInfo['Email'] . '</td>';
                    echo '<td>' . $alunoInfo['Cidade'] . '</td>';
                    echo '<td>' . $alunoInfo['Bairro'] . '</td>';
                    echo '<td>' . $alunoInfo['Rua'] . '</td>';
                    echo '<td>' . $alunoInfo['Numero'] . '</td>';
                    echo '</tr>';
                } else {
                    echo '<tr>';
                    echo '<h2>Nenhum Aluno Encontrado!</h2>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <a href="process.php">Voltar para o(a) Cadastro/Listagem</a>
</body>

</html>