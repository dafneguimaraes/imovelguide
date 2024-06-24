<?php 
    include 'conexao_db.php';
    $conexao = Conectar();
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $sql = "DELETE FROM corretores where id='$id'";
    mysqli_query($conexao, $sql);
    header('Location: ./index.php');
    exit();
?>