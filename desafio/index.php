<!DOCTYPE html>
<html lang="pr-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Corretor</title>
    <script src="./script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body>
    <section class="content">
        <h1 class="w-100 text-center">Cadastro de Corretor</h1>
        <div class="d-flex justify-content-center">
            <form class="form col-4 needs-validation g-3" method="POST" action="corretor.php"
                onsubmit="return validateForm()" novalidate="" name="cadastroCorretor">
                <div class="row my-2 px-0">
                    <div class="col-5">
                        <input type="text" class="field form-control" name="cpf" placeholder="Digite seu CPF">
                        <div class="text-danger" id="errorCpf">
                        </div>
                    </div>
                    <div class="col">
                        <input type="text" class="field form-control" name="creci" placeholder="Digite seu CRECI">
                        <div class="text-danger" id="errorCreci">
                        </div>
                    </div>
                </div>

                <div class="row my-2 mx-0">
                    <input type="text" class="field form-control" name="nome" placeholder="Digite seu nome">
                    <div class="text-danger" id="errorNome">
                    </div>
                </div>
                <div class="row"><input class="btn btn-dark" type="submit" value="Enviar"></div>
            </form>
        </div>
    </section>
    <br><br>
    <section>
        <div class="d-flex justify-content-center">
            <?php
                include 'conexao_db.php';

                $conexao = Conectar();                             
                $corretores = mysqli_query($conexao, "SELECT * FROM corretores");

                echo '<table class="table table-bordered"><tr class="data-heading">';  //criação da tabela
                while ($property = mysqli_fetch_field($corretores)) {
                    
                    echo '<td>' . htmlspecialchars($property->name) . '</td>';  //nomes das colunas 
                }
                echo '<td></td>'; //coluna dos botões
                echo '</tr>';
                while ($row = mysqli_fetch_row($corretores)) {
                    echo "<tr>";
                    foreach ($row as $item) {
                    echo '<td>' . htmlspecialchars($item) . '</td>'; // popula a tabela com os itens da database
                    }
                
                echo "<td><a href='excluir.php?id=" . $row[0] . "'>Excluir</a></td>";  //posição 0 = id
                echo "<td><a href='editar.php?id=" . $row[0] . "'>Alterar</a></td>";
                echo '</tr>';
                }
                echo "</table>"; 
            ?>
        </div>
    </section>
</body>

</html>