# Palazzo

Repositório oficial do site da Palazzo Publicidade e Propaganda.

Este projeto mantém duas frentes de trabalho no mesmo repositório:

- a base legada do site, feita em HTML, CSS, JavaScript e alguns arquivos PHP
- uma reestruturação moderna em `palazzo-2026`, usando Next.js + Payload CMS

## Estrutura do repositório

### Site legado

Os arquivos na raiz do projeto representam o site antigo ainda utilizável:

- `index.html`
- `agencia.html`
- `servicos.html`
- `contato.html`
- `portifolio.html`
- `style.css`
- pastas auxiliares como `img/`, `js/`, `scroll/`, `shadowbox/` e `pagina/`

Essa base é útil para manutenção imediata, correções rápidas e reaproveitamento de conteúdo visual e textual.

### Novo site

A pasta `palazzo-2026/` contém a nova versão do projeto, preparada para um fluxo mais moderno de desenvolvimento e publicação.

Stack principal:

- Next.js
- TypeScript
- Payload CMS
- pnpm
- SQLite no ambiente local, com possibilidade de migração para Postgres em produção

## Como rodar o projeto moderno

Entre na pasta do novo site:

```bash
cd palazzo-2026
```

Instale as dependências:

```bash
pnpm install
```

Suba o ambiente de desenvolvimento:

```bash
pnpm dev
```

Endereços esperados:

- site: `http://localhost:3000`
- admin: `http://localhost:3000/admin`

## Scripts úteis do projeto moderno

- `pnpm dev` inicia o ambiente de desenvolvimento
- `pnpm build` gera a build de produção
- `pnpm start` sobe a aplicação compilada
- `pnpm lint` executa a validação de código

## Publicação

Hoje o repositório pode ser usado de duas formas:

1. publicar a base legada como site estático/PHP tradicional
2. publicar a versão `palazzo-2026` como aplicação moderna

Para a versão moderna, a estratégia recomendada é:

- frontend e app em Vercel ou servidor Node
- banco em Postgres para produção
- uploads locais no início ou storage externo depois

## Observações

- A raiz do repositório contém histórico, arquivos antigos, backups e materiais de apoio.
- Nem tudo na raiz faz parte da versão final moderna.
- O diretório `backups/` pode ser mantido apenas para segurança local e não precisa necessariamente entrar no fluxo de deploy.

## Status

O repositório está em transição entre manutenção do site antigo e construção de uma base nova mais escalável.
