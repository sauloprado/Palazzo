<p align="center">
<img src="assets/capa.png" alt="Palazzo Publicidade" width="100%">
</p>

<h1 align="center">Palazzo Publicidade</h1>
<p align="center"><i>Site institucional em transição do legado (HTML/PHP) para Next.js + Payload CMS</i></p>

<p align="center">
<img src="https://img.shields.io/badge/Next.js-000000?style=flat-square&logo=nextdotjs&logoColor=white" alt="Next.js">
<img src="https://img.shields.io/badge/TypeScript-3178C6?style=flat-square&logo=typescript&logoColor=white" alt="TypeScript">
<img src="https://img.shields.io/badge/Payload%20CMS-111111?style=flat-square" alt="Payload CMS">
<img src="https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP">
<img src="https://img.shields.io/badge/status-em%20transi%C3%A7%C3%A3o-F59E0B?style=flat-square" alt="status: em transição">
</p>

## Sumário

- [Sobre](#sobre)
- [Arquitetura](#arquitetura)
- [Tecnologias](#tecnologias)
- [Como executar](#como-executar)
- [Publicação](#publicação)
- [Estrutura do repositório](#estrutura-do-repositório)
- [Autor](#autor)

## Sobre

Repositório do site da **Palazzo Publicidade e Propaganda**. Mantém duas frentes no mesmo lugar:

- **Site legado** — HTML, CSS, JavaScript e PHP, para manutenção imediata e reaproveitamento de conteúdo
- **`palazzo-2026/`** — a nova versão, com Next.js, TypeScript e Payload CMS, preparada para um fluxo moderno de desenvolvimento e publicação

## Arquitetura

```mermaid
flowchart LR
    subgraph Legado
        L1[index.html · agencia.html<br/>servicos.html · contato.html] --> L2[Hospedagem estática / PHP]
    end
    subgraph Nova versão
        N1[Next.js + TypeScript] --> N2[Payload CMS<br/>/admin]
        N2 --> N3[(SQLite local<br/>Postgres em produção)]
    end
    Legado -. conteúdo reaproveitado .-> N1
```

## Tecnologias

| Frente | Stack |
| --- | --- |
| Legado | HTML, CSS, JavaScript, PHP |
| Nova versão | Next.js, TypeScript, Payload CMS, pnpm |
| Banco | SQLite no desenvolvimento, Postgres recomendado em produção |

## Como executar

```bash
cd palazzo-2026
pnpm install
pnpm dev
```

| Endereço | O que é |
| --- | --- |
| `http://localhost:3000` | Site |
| `http://localhost:3000/admin` | Painel do Payload CMS |

| Script | Ação |
| --- | --- |
| `pnpm dev` | Ambiente de desenvolvimento |
| `pnpm build` | Build de produção |
| `pnpm start` | Sobe a aplicação compilada |
| `pnpm lint` | Validação de código |

## Publicação

1. **Legado** — publicar como site estático / PHP tradicional.
2. **Nova versão** — app em Vercel ou servidor Node, banco Postgres e uploads locais no início (storage externo depois).

> A raiz do repositório guarda histórico, backups e materiais de apoio do site antigo; nem tudo faz parte da versão final.

## Estrutura do repositório

```text
Palazzo/
├── palazzo-2026/        # nova versão (Next.js + Payload CMS)
├── index.html           # site legado
├── agencia.html
├── contato.html
├── portifolio.html
├── img/ · js/ · pagina/ # recursos do legado
├── doc/                 # materiais de apoio
└── assets/capa.png
```

## Autor

**Saulo Prado** · Analista de Sistemas · Gestão de Ativos de TI, orçamento, automação e dashboards

[![LinkedIn](https://img.shields.io/badge/LinkedIn-Saulo%20Prado-0A66C2?style=flat-square&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/saulo-prado-ab4a0b96/)
[![GitHub](https://img.shields.io/badge/GitHub-sauloprado-181717?style=flat-square&logo=github&logoColor=white)](https://github.com/sauloprado)
