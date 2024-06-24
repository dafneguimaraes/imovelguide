<?php 
    include 'conexao_db.php';
    $conexao = Conectar();
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $sql = "SELECT * FROM corretores WHERE id = $id";
    $resultado_corretor = mysqli_query($conexao,$sql);
    $row_corretor = mysqli_fetch_assoc($resultado_corretor);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Alterar Corretor</title>
    <script src="./script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body>
    <section class="content">
        <div class="cadastro">
            <h1 class="w-100 text-center">Alterar Corretor</h1>
            <div class="d-flex justify-content-center">
                <form class="form col-4 needs-validation g-3" method="POST" action="editar_corretor.php"
                    onsubmit="return validateForm()" novalidate="" name="cadastroCorretor">

                    <input type="hidden" name="id" value="<?php echo $row_corretor['id'];?>">
                    <div class="row my-2 px-0">
                        <div class="col-5">
                            <input type="text" class="field form-control" name="cpf" placeholder="Digite seu CPF"
                                value="<?php echo $row_corretor['cpf'];?>">
                            <div class="text-danger" id="errorCpf">
                            </div>
                        </div>
                        <div class="col">
                            <input type="text" class="field form-control" name="creci" placeholder="Digite seu CRECI"
                                value="<?php echo $row_corretor['creci'];?>">
                            <div class="text-danger" id="errorCreci">
                            </div>
                        </div>
                    </div>

                    <div class="row my-2 mx-0">
                        <input type="text" class="field form-control" name="nome" placeholder="Digite seu nome"
                            value="<?php echo $row_corretor['nome'];?>">
                        <div class="text-danger" id="errorNome">
                        </div>
                    </div>
                    <div class="row"><input class="btn btn-dark" type="submit" value="Salvar"></div>
                </form>
            </div>
    </section>
</body>

</html>