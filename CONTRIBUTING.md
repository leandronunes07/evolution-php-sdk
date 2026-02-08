# Contribuindo para o Evolution PHP SDK

Obrigado por considerar contribuir para este projeto!

## Requisitos

- PHP >= 8.1
- Composer

## Configuração do Ambiente

1. Clone o repositório:
```bash
git clone https://github.com/leandronunes07/evolution-php-sdk.git
cd evolution-php-sdk
```

2. Instale as dependências:
```bash
composer install
```

## Executando Testes

Este projeto utiliza PHPUnit para testes unitários. Certifique-se de escrever testes para novas funcionalidades.

```bash
./vendor/bin/phpunit
```

Para rodar apenas os testes de DTO:
```bash
./vendor/bin/phpunit tests/Unit/DTOTest.php
```

## Padrões de Código

- Siga a PSR-12 para estilo de código.
- Utilize DTOs para novos métodos que recebem dados complexos.
- Mantenha a documentação atualizada.

## Pull Requests

1. Crie uma branch para sua feature (`feature/nova-feature`).
2. Implemente e teste.
3. Envie um PR descrevendo as mudanças.
