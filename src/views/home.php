<?php
include_once '../controllers/banco.php';
function atualizaTickets($conn)
{

    // Consulta SQL para obter os últimos tickets
    try {

        $sql = "SELECT * FROM PRODUTOS ORDER BY ID LIMIT 9";
        $stmt = $conn->query($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['ID'] . '</td>';
            echo '<td>' . $row['NOME_PRODUTO'] . '</td>';
            echo '<td>' . $row['SETOR'] . '</td>';
            echo '<td>' . $row['ESTOQ_EMB1'] . '</td>';
            echo '<td>' . $row['PRECO_VENDA'] . '</td>';
            echo '<td>' . $row['CUSTO'] . '</td>';
            echo '</tr>';
        }

        $conexao = null;
    } catch (PDOException $e) {
        // Mensagem será exibida se ocorrer um erro. 
        echo 'Erro na consulta: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='/src/assets/css/pagina.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>Sistema de Tickets</title>
</head>

<body>

    <!--  
                $queryTodos = "SELECT COUNT(*) FROM tickets";
                $resultadoTodos = $conn->query($queryTodos);                            
                $queryN1 = "SELECT COUNT(*) FROM tickets WHERE nivel_atribuido = 'Nível 1' AND tags like '%n1%'";
                $resultadoN1 = $conn->query($queryN1);                
                $queryN2 = "SELECT COUNT(*) FROM tickets WHERE nivel_atribuido = 'Nível 2' AND tags like '%n2%'";
                $resultadoN2 = $conn->query($queryN2);                
                $queryN3 = "SELECT COUNT(*) FROM tickets WHERE nivel_atribuido = 'Nível 3' AND tags like '%n3%'";
                $resultadoN3 = $conn->query($queryN3);                
                $queryAbertos = "SELECT COUNT(*) FROM tickets WHERE statusticket = 'Aberto' OR statusticket = 'Pendente'";
                $resultadoAbertos = $conn->query($queryAbertos);                
                $queryResolvidos = "SELECT COUNT(*) FROM tickets WHERE statusticket = 'Resolvido'";
                $resultadoResolvidos = $conn->query($queryResolvidos);
                $queryFechados = "SELECT COUNT(*) FROM tickets WHERE statusticket = 'Fechado'";
                $resultadoFechados = $conn->query($queryFechados);
                ?> 
                <header class="header header-dark">
                    <nav>
                        <ul>
                        <li>Todos -  echo $resultadoTodos->fetchColumn(); ?></li>
                        <li>Abertos -  echo $resultadoAbertos->fetchColumn(); ?></li>
                        <li>Nível 1 -  echo $resultadoN1->fetchColumn(); ?></li>
                        <li>Nível 2 -  echo $resultadoN2->fetchColumn(); ?></li>
                        <li>Nível 3 -  echo $resultadoN3->fetchColumn(); ?></li>
                        <li>Resolvidos -  echo $resultadoResolvidos->fetchColumn(); ?></li>
                        <li>Fechados -  echo $resultadoFechados->fetchColumn(); ?></li>
                        </ul>
                    </nav>
                </header> -->
    <div class="sidenav">
        <h2>Links Diretos</h2>
        <a href="/pagina.php">Página Inicial</a>
        <a href="https://trello.com/b/5iTC7Pey/mortystock" target="_blank">Trello</a>
        <a href="logout.php" class="link" id="logout">Logout</a>


    </div>

    <div class='titulopagina'>
        <div class="charts-container">
            <div class="charts">
                <h1>Grafico 1</h1>
                <?php
                //include 'graficoNivel.php'; 
                ?>
            </div>
            <div class="charts">
                <h1>Grafico 2</h1>
                <?php
                //include 'graficoStatus.php';
                ?>
            </div>
            <div class="charts">
            <h1>Grafico 3</h1>
            </div>
        </div>
        <!-- <h1>Últimos Tickets <i class="fas fa-sync-alt update-icon"></i></h1> -->
        <div class="tabela-produtos-container">
            <h2>Produtos</h2>


            <table id="tabelaProdutos">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Produto</th>
                        <th>Setor</th>
                        <th>Estoque</th>
                        <th>Preço</th>
                        <th>Custo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    atualizaTickets($conn);
                    ?>
                </tbody>
            </table>

        </div>
        <div>
            <?php
            ?>
        </div>
    </div>

    <script>
        // Seu código JavaScript aqui para atualizar os tickets quando o ícone for clicado
        document.querySelector('.ticket-container').addEventListener('click', atualizaTickets($conn));
    </script>
</body>

</html>