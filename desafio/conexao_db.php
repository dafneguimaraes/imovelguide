<?php
    function Conectar(){
        $servidor = '127.0.0.1';
        $usuario = 'root';
        $senha = '';
        $bancoDados = 'imovel_guide';
        try {
            $conexao = mysqli_connect($servidor,$usuario,$senha,$bancoDados);
            return $conexao;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
    }

    function Desconectar($conexao){
        $conexao -> close();
    }
?>