<?php
$userInput = $_GET['userInput'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de Processos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="style_tabela.css" rel="stylesheet" />
</head>
<body>
    <form action="index.php">
        <button id='voltar'>←Voltar</button>
    </form>

    <div class=container>
        <h1>Consulta do ID <?php echo $userInput;?></h1>
        <br>
        <table class='table table-dark table-striped table-bordered table-hover'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Advogado ID</th>
                    <th>Cliente ID</th>
                    <th>Número do Processo</th>
                    <th>Próximo Prazo</th>
                    <th>Arquivo</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "escritorio";
                
                // Estabelecer a conexão com o banco de dados
                $connection = new mysqli($servername, $username, $password, $database);
                // Alertar se a conexão falhar
                if ($connection->connect_error) {
                    die("A conexão falhou: " . $connection->connect_error);
                }
                
                // Filtrar as rows de acordo com o input do usuário
                $sql = "SELECT * FROM processos WHERE processos.advogado_id ='$userInput';";
                $result = $connection -> query($sql);
                
                // Alertar se a query não for bem-sucedida
                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }
                
                // Loop para printar as informações da database na tabela
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["advogado_id"] . "</td>
                        <td>" . $row["cliente_id"] . "</td>
                        <td>" . $row["numero_processo"] . "</td>
                        <td>" . $row["proximo_prazo"] . "</td>
                        <td>" . $row["arquivo"] . "</td>
                    </tr>";
                };
                ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>

