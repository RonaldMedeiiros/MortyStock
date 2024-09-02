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
            });
    });

    // Evento para o botão de atualização
    $('#btn-atualizar').on('click', function () {
        const id = $('#produto-id').val();
        const formData = {
            id: $('#id').val(),
            id_loja: $('#id_loja').val(),
            nome_produto: $('#nome_produto').val(),
            departamento: $('#departamento').val(),
            setor: $('#setor').val(),
            estoque: $('#estoque').val(),
            classe: $('#classe').val(),
            sistema_entrega: $('#sistema_entrega').val()
        };

        // Enviar dados de atualização via AJAX
        fetch(`../controllers/atualizar_produto.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                alert('Produto atualizado com sucesso!');
                $('#cadProdutoModal').modal('hide');
                table.ajax.reload(); // Recarregar a tabela
            } else {
                alert('Erro ao atualizar o produto.');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao processar a atualização.');
        });
    });

    // Evento para o botão de exclusão
    $('#tabela-produtos').on('click', '.btn-delete', function () {
        const id = $(this).data('id');
        const id_loja = $(this).data('id_loja');

        if (confirm('Tem certeza que deseja excluir este produto?')) {
            fetch(`../controllers/excluir_produto.php?id=${id}&id_loja=${id_loja}`, {
                method: 'GET' // ou 'DELETE', dependendo de como o servidor está configurado
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    alert('Produto excluído com sucesso!');
                    table.ajax.reload(); // Recarregar a tabela
                } else {
                    alert('Erro ao excluir o produto.');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao processar a exclusão.');
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

    // Evento para o formulário de cadastro
    $('#form-cad-produto').on('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const isEditMode = $('#edit-mode').val() === 'true';

        let url = isEditMode ? '../controllers/atualizar_produto.php' : '../controllers/cadastrar_produto.php';

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alertMsg.classList.remove('d-none');
            alertMsg.innerHTML = data.msg;

            if (data.status) {
                $('#cadProdutoModal').modal('hide');
                table.ajax.reload();
            }
        })
        .catch(error => {
            alertMsg.classList.remove('d-none');
            alertMsg.innerHTML = '<div class="alert alert-danger" role="alert">Erro ao processar a solicitação.</div>';
        });
    });
});
