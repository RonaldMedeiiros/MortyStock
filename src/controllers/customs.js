$(document).ready(function () {
    const table = $('#tabela-produtos').DataTable({
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

                    // Alternar os botões
                    $('#btn-cadastrar').addClass('d-none');
                    $('#btn-atualizar').removeClass('d-none');

                    // Definir modo de edição
                    $('#edit-mode').val('true');
                    $('#produto-id').val(data.produto.id);

                    // Mostrar o modal
                    $('#cadProdutoModal').modal('show');
                } else {
                    alert('Produto não encontrado!');
                }
            })
            .catch(error => {
                console.error('Erro ao buscar o produto:', error);
            });
    });

    // Evento para o botão de exclusão
    $('#tabela-produtos').on('click', '.btn-delete', function () {
        const id = $(this).data('id');
        const id_loja = $(this).data('id_loja');

        if (confirm('Deseja realmente excluir este produto?')) {
            fetch(`../controllers/excluir_produto.php?id=${id}&id_loja=${id_loja}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    // Exibir balão de notificação
                    $('#toast .toast-body').text('Produto excluído com sucesso!');
                    const toastElement = new bootstrap.Toast(document.getElementById('toast'), { delay: 2000 });
                    toastElement.show();

                    // Recarregar a tabela
                    table.ajax.reload();
                } else {
                    alert('Erro ao excluir o produto: ' + data.msg);
                }
            })
            .catch(error => {
                alert('Erro ao processar a solicitação.');
                console.error('Erro:', error);
            });
        }
    });

    // Resetar o modal ao abrir para cadastro
    $('#cadProdutoModal').on('hidden.bs.modal', function () {
        $('#form-cad-produto')[0].reset();
        $('#btn-cadastrar').removeClass('d-none');
        $('#btn-atualizar').addClass('d-none');
        $('#edit-mode').val('false');
    });

    // Evento para o formulário de cadastro/atualização
    $('#form-cad-produto').on('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const isEditMode = $('#edit-mode').val() === 'true';

        let url = isEditMode ? '../controllers/atualizar_produto.php' : '../controllers/cadastrar_produto.php';

        // Exibir mensagem de confirmação
        if (confirm(isEditMode ? 'Deseja atualizar?' : 'Deseja cadastrar?')) {
            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    // Fechar o modal
                    $('#cadProdutoModal').modal('hide');

                    // Exibir balão de notificação
                    $('#toast .toast-body').text(isEditMode ? 'Produto atualizado com sucesso!' : 'Cadastro realizado com sucesso!');
                    const toastElement = new bootstrap.Toast(document.getElementById('toast'), { delay: 2000 });
                    toastElement.show();

                    // Recarregar a tabela
                    table.ajax.reload();
                } else {
                    alert('Erro ao ' + (isEditMode ? 'atualizar' : 'cadastrar') + ' o produto: ' + data.msg);
                }
            })
            .catch(error => {
                alert('Erro ao processar a solicitação.');
                console.error('Erro:', error);
            });
        }
    });

    // Evento para o botão de atualização
    $('#btn-atualizar').on('click', function () {
        $('#form-cad-produto').submit();
    });
});