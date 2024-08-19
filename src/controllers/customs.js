$(document).ready(function () {
    $('#tabela-produtos').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "../controllers/listar_produtos.php",
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
        }
    });
    // Evento para o botão de edição
    $('#tabela-produtos').on('click', '.btn-edit', function () {
        const id = $(this).data('id');
        const id_loja = $(this).data('id_loja');

        // Faz uma requisição para buscar os dados do produto para edição
        fetch(`../controllers/editar_produto.php?id=${id}&id_loja=${id_loja}`)
            .then(response => response.json())
            .then(data => {
                console.log(data); // Adicionado para depuração
                if (data.status) {
                    // Preencher o modal com os dados do produto para edição
                    $('#id').val(data.produto.id);
                    $('#id_loja').val(data.produto.id_loja);
                    $('#nome_produto').val(data.produto.nome_produto);
                    $('#departamento').val(data.produto.departamento);
                    $('#setor').val(data.produto.setor);
                    $('#estoque').val(data.produto.estoque);
                    $('#classe').val(data.produto.classe);
                    $('#sistema_entrega').val(data.produto.sistema_entrega);
                    $('#cadProdutoModal').modal('show');
                } else {
                    alert('Produto não encontradoassadfa!');
                }
            });
    });

    // Evento para o botão de exclusão
    $('#tabela-produtos').on('click', '.btn-delete', function () {
        const id = $(this).data('id');
        const id_loja = $(this).data('id_loja');

        if (confirm('Tem certeza que deseja excluir este produto?')) {
            fetch(`../controllers/excluir_produto.php?id=${id}&id_loja=${id_loja}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    alert('Produto excluído com sucesso!');
                    table.ajax.reload(); // Recarrega a tabela
                } else {
                    alert('Erro ao excluir o produto.');
                }
            });
        }
    });
});

const formNewProduct = document.getElementById('form-cad-produto');
const alertMsg = document.getElementById('alert-msg');
const fecharModalProduct = new bootstrap.Modal(document.getElementById('cadProdutoModal'));

if (formNewProduct) {
    formNewProduct.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(formNewProduct);

        try {
            const response = await fetch('../controllers/cadastrar_produto.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            // Exibe a mensagem retornada
            alertMsg.classList.remove('d-none');
            alertMsg.innerHTML = data.msg;

            if (data.status) {
                formNewProduct.reset();
                fecharModalProduct.hide();
                listarTabela = $('#tabela-produtos').DataTable();
                listarTabela.draw();
            }

        } catch (error) {
            alertMsg.classList.remove('d-none');
            alertMsg.innerHTML = '<div class="alert alert-danger" role="alert">Ocorreu um erro ao tentar cadastrar o produto.</div>';
        }
    });
}

    

