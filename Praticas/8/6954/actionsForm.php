<?php
require_once('aluno.php');

$aluno = new Aluno();

if (isset($_POST['cadastrar'])) {
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    $aluno->criarAluno($nome, $telefone, $email, $cidade, $bairro, $rua, $numero);
    header('Location: process.php');
    exit();
}

if (isset($_POST['atualizar'])) {
    $id = $_POST['id_aluno'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    $aluno->atualizarAluno($id, $nome, $telefone, $email, $cidade, $bairro, $rua, $numero);
    header('Location: process.php');
    exit();
}

if (isset($_GET['action']) && $_GET['action'] == "DELETE" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $aluno->apagarAluno($id);

    header('Location: process.php');
    exit();
}
