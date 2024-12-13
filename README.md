# Projeto MortyStock - Metodologia Ágil

## Sobre
MortyStock é um programa de gestão de estoque desenhado para facilitar o cadastro e monitoramento de produtos em diversas categorias. Com funcionalidades que permitem registrar detalhes importantes como nome do produto, setor, status, tipo de embalagem, quantidade ideal, data da última entrada, estoque atual, preço de custo, preço de venda, quantidade vendida e tipo de etiqueta, MortyStock é a ferramenta ideal para gerenciar eficientemente seu inventário. Além disso, oferece um dashboard interativo com gráficos para uma visualização rápida do estado do estoque e das vendas.

## Pré-requisitos
Para executar MortyStock, você precisará de:

* PHP (com suporte ao PDO_MySQL para integração com banco de dados)
* Servidor local ou de hospedagem que suporte PHP
* Banco de dados MySQL
* Instalar driver sqlite (linux sudo apt-get install php-sqlite3)

## Instalação
1. Certifique-se de que o PHP e o MySQL estão instalados e configurados em seu ambiente de desenvolvimento.
2. Clone ou baixe o código-fonte do MortyStock para o seu ambiente local.
3. Configure o acesso ao banco de dados editando o arquivo de configuração do PDO_MySQL com suas credenciais de banco de dados.
4. Configurar o .env para ler o banco sem problema.
4. Rodar o comando:
```bash 
composer install
``` 
5. Inicie o servidor PHP no vscode com o comando:
```bash 
php -S localhost:3333
``` 
6. Criar um arquivo .env

7. Acesse o sistema via navegador através do endereço: http://localhost:3333

## Funcionalidades
Cadastro de Produtos: Permite inserir novos produtos no estoque, especificando detalhes como nome, setor, status, e outros atributos importantes.
Dashboard: Visualize gráficos e análises sobre o estoque atual, vendas, e outras métricas importantes para a gestão de inventário.

## Contribuições
Embora o MortyStock seja um projeto desenvolvido inicialmente para um trabalho de faculdade, contribuições são bem-vindas. Sinta-se à vontade para forkar o projeto, fazer suas alterações e abrir um pull request com suas sugestões de melhorias.

## Suporte
Para suporte, por favor abra uma issue no repositório do GitHub do projeto. Tentaremos responder o mais rápido possível.