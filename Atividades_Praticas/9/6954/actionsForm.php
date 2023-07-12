<?php
require_once('aluno.php');

$aluno = new Aluno();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $alunos = $aluno->listarAlunos();
    echo json_encode($alunos);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_aluno'];

    if ($id == null) {
        $cidade = $_POST['cidade'];
        $bairro = $_POST['bairro'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];

        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];

        $aluno->criarAluno($nome, $telefone, $email, $cidade, $bairro, $rua, $numero);
    } else {
        $cidade = $_POST['cidade'];
        $bairro = $_POST['bairro'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];

        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];

        $aluno->atualizarAluno($id, $nome, $telefone, $email, $cidade, $bairro, $rua, $numero);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    $id = $_DELETE['id_aluno'];
    $aluno->apagarAluno($id);
}
