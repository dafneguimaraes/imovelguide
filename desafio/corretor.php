<?php 
    $cpf = addslashes($_POST['cpf']);
    $nome = addslashes($_POST['nome']);
    $creci = addslashes($_POST['creci']);
       
    include 'conexao_db.php';
    $conexao = Conectar();
    $sql = "INSERT INTO `corretores` (`cpf`, `nome`, `creci`) VALUES ('$cpf', '$nome', '$creci')";    
    mysqli_query($conexao, $sql);
    
    header('Location: ./index.php');
    exit();
    ?>