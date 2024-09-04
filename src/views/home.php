<?php
include_once '../controllers/banco.php';
?>
<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='/src/assets/css/pagina.css'>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
                <h1>Classe do Produto</h1>
                <?php
                include 'graficos/graficoClasse.php';
                ?>                
            </div>
            <div class="charts">
                <h1>Sistemática</h1>
                <?php
                include 'graficos/graficoSistematica.php';
                ?>
            </div>
            <div class="charts">
                <h1>Total de Produtos por Setor</h1>
                <?php
                include 'graficos/graficoSetor.php';
                ?>
            </div>
        </div>

        <div id="demo_info" class="tabela-produtos-container">
            <div class="d-flex justify-content-between align-items-center pt-3 pb-2">
                <h2>Produtos</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadProdutoModal">
                Cadastro de Produto
                </button>
            </div>
            <table id="tabela-produtos" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Código Loja</th>
                        <th>Produto</th>
                        <th>Departamento</th>
                        <th>Setor</th>
                        <th>Estoque</th>
                        <th>Classe do Produto</th>
                        <th>Data Última Entrada</th>
                        <th>Sistema de Entrega</th>
                        <th>Ações</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="cadProdutoModal" tabindex="-1" aria-labelledby="cadProdutoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="cadProdutoModalLabel">Cadastrar Produto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="alert-msg" class="alert d-none" role="alert"></div>
                <div class="modal-body">
                    <form method="POST" id="form-cad-produto">
                        <div class="row mb-3">
                            <label for="id" class="col-sm-2 col-form-label">CÓD:</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="id" name="id" placeholder="Código do Produto">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="id_loja" class="col-sm-2 col-form-label">ID Loja:</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="id_loja" name="id_loja" placeholder="ID Loja">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nome_produto" class="col-sm-2 col-form-label">Produto:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nome_produto" name="nome_produto" placeholder="Nome do Produto">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="departamento" class="col-sm-2 col-form-label">Dpto:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="departamento" name="departamento" placeholder="Departamento do Produto">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="setor" class="col-sm-2 col-form-label">Setor:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="setor" name="setor" placeholder="Setor do Produto">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="estoque" class="col-sm-2 col-form-label">Estoque:</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="estoque" name="estoque" placeholder="Quantidade em Estoque">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="classe" class="col-sm-2 col-form-label">Classe:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="classe" name="classe" placeholder="Classe do Produto">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="sistema_entrega" class="col-sm-2 col-form-label">Entrega:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="sistema_entrega" name="sistema_entrega" placeholder="Sistema de Entrega">
                            </div>
                        </div>
                        <input type="hidden" id="edit-mode" name="edit-mode" value="false">
                        <input type="hidden" id="produto-id" name="produto-id" value="">
                        <!-- Botão para Cadastrar -->
                        <button type="submit" class="btn btn-outline-primary" id="btn-cadastrar">Cadastrar</button>
                        <!-- Botão para Atualizar -->
                        <button type="button" class="btn btn-outline-success d-none" id="btn-atualizar">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Balão de Notificação (Toast) -->
    <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 20px; right: 20px;">
        <div class="toast-header">
            <strong class="mr-auto">Notificação</strong>
        </div>
        <div class="toast-body">
            Cadastro realizado com sucesso!
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="text-center mt-4">
        <p>Desenvolvimento Ágil - MortyStock - Desenvolvido por Ronaldo Medeiros</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="/src/controllers/customs.js"></script>
</body>

</html>