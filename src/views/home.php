<?php
include_once '../controllers/banco.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='/src/assets/css/pagina.css'>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />

    <!-- build:css ../assets/styles/app.min.css -->
    <link rel="stylesheet" href="../assets/css/app.css" type="text/css" />
    <!-- endbuild -->
    <link rel="stylesheet" href="../assets/css/font.css" type="text/css" />
    <title>MortyStock</title>
</head>

<body>
    <div class="sidenav">
        <h2>Links Diretos</h2>
        <a href="home.php">Página Inicial</a>
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
        <div id="demo_info" class="tabela-produtos-container">
            <h2>Produtos</h2>


            <table id="tabela-produtos" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Produto</th>
                        <th>Setor</th>
                        <th>Estoque</th>
                        <th>Preço</th>
                        <th>Quantidade Ideal</th>
                    </tr>
                </thead>

            </table>

        </div>
        <div>
            <?php
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
    <script src="/src/controllers/customs.js"></script>
</body>

</html>