$(document).ready(function () {
    $('#tabela-produtos').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "../controllers/listar_produtos.php",
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
        }
    });
});