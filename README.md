
# Liven Backend - Gerenciador de Endereços

Este projeto, denominado Liven, consiste na implementação de uma API HTTP utilizando o framework Laravel para o gerenciamento de usuários e endereços. A API permite operações básicas de criação, leitura, atualização e exclusão (CRUD) tanto para usuários quanto para endereços, utilizando autenticação via JWT (Json Web Tokens).






## Rodando as migrações do banco de dados

Após configurar uma base de dados no seu arquivo .env basta rodar suas migrations

```bash
  php artisan migrate
```

## Rodando o servidor local

```bash
  php artisan serve
```

## Rodando os testes

Para rodar os testes, rode o seguinte comando

```bash
  php artisan test
```


## Autor

- [@victorfarias](https://github.com/victorfarias98)


## Roadmap

- Melhorar as respostas da API para o frontend

- Adicionar integrações com correios para busca de CEP e preenchimento automático de endereço

- Criar arquivos de docker e configuração de pipelines para deploys automáticos


## Referência

- [Laravel](https://laravel.com/)
- [Repositories & Services](https://medium.com/levantelab/repository-pattern-contracts-e-service-layer-no-laravel-6-670aa9f50173#:~:text=Centraliza%C3%A7%C3%A3o%20da%20l%C3%B3gica%20de%20acesso%20aos%20dados%20e,Redu%C3%A7%C3%A3o%20de%20chance%20de%20cometer%20erros%20de%20programa%C3%A7%C3%A3o%3B)

