# Projeto de Controle de Estoque

Este projeto tem como objetivo melhorar o controle de estoque no setor público, proporcionando uma interface simples para gerenciar itens de estoque.

## Estrutura do Projeto

O projeto é organizado da seguinte forma:

- **src/controllers/EstoqueController.php**: Classe responsável por gerenciar as operações de estoque, como adicionar, remover e listar itens.
- **src/models/Estoque.php**: Classe que representa a estrutura de um item de estoque, com propriedades como id, nome e quantidade, além de métodos para manipulação de dados.
- **src/views/index.php**: View principal onde os dados do estoque são exibidos, utilizando o EstoqueController para obter as informações necessárias.
- **public/index.php**: Ponto de entrada da aplicação, que inicializa o sistema e direciona as requisições para o EstoqueController.
- **composer.json**: Configuração do Composer, listando as dependências do projeto e informações do autoload.

## Instalação

1. Clone o repositório:
   ```
   git clone <URL_DO_REPOSITORIO>
   ```

2. Navegue até o diretório do projeto:
   ```
   cd meu-projeto-estoque
   ```

3. Instale as dependências usando o Composer:
   ```
   composer install
   ```

## Uso

Para iniciar a aplicação, acesse o arquivo `public/index.php` em seu servidor web. A partir daí, você poderá gerenciar o estoque através da interface fornecida.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou pull requests para melhorias.