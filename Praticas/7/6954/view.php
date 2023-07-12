<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "escola";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id_aluno = $_GET['id'];

$query = "SELECT * FROM aluno 
             JOIN endereco 
             ON aluno.fk_ID_Endereco = endereco.ID_Endereco
             WHERE aluno.ID_Aluno = $id_aluno";

$result = mysqli_query($conn, $query);


if (mysqli_num_rows($result) > 0) {
    $info = mysqli_fetch_assoc($result);
    $userNameFromBD = $info['Nome'];
} else {
    $userNameFromBD = 'Aluno ' . $id_aluno;
}

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
                if (mysqli_num_rows($result) > 0) {
                    echo '<tr>';
                    echo '<td>' . $info['ID_Aluno'] . '</td>';
                    echo '<td>' . $info['Nome'] . '</td>';
                    echo '<td>' . $info['Telefone'] . '</td>';
                    echo '<td>' . $info['Email'] . '</td>';
                    echo '<td>' . $info['Cidade'] . '</td>';
                    echo '<td>' . $info['Bairro'] . '</td>';
                    echo '<td>' . $info['Rua'] . '</td>';
                    echo '<td>' . $info['Numero'] . '</td>';
                    echo '</tr>';
                } else {
                    echo '<tr>';
                    echo '<h2>Nenhum Aluno Encontrado!</h2>';
                    echo '</tr>';
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <a href="process.php">Voltar para o(a) Cadastro/Listagem</a>
</body>

</html>