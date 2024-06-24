<?php 
    $id = addslashes($_POST['id']);
    $cpf = addslashes($_POST['cpf']);
    $nome = addslashes($_POST['nome']);
    $creci = addslashes($_POST['creci']);
       
    include 'conexao_db.php';
    $conexao = Conectar();
    $sql = "UPDATE corretores SET cpf='$cpf', nome='$nome', creci='$creci' WHERE id='$id'";    
    mysqli_query($conexao, $sql);
    
    header('Location: ./index.php');
    exit();
?>