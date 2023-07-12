<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $idade = $_POST['idade'];
        echo "Olá, " . htmlspecialchars($nome) . "! Feliz ". 
        htmlspecialchars($idade) . " anos";
    }
?>
