type SeedRichTextNode = {
  children?: SeedRichTextNode[];
  direction?: null;
  format?: string;
  indent?: number;
  tag?: string;
  text?: string;
  textFormat?: number;
  textStyle?: string;
  type: string;
  version: number;
};

const textNode = (text: string): SeedRichTextNode => ({
  text,
  type: "text",
  version: 1,
});

const paragraph = (text: string): SeedRichTextNode => ({
  children: [textNode(text)],
  direction: null,
  format: "",
  indent: 0,
  textFormat: 0,
  textStyle: "",
  type: "paragraph",
  version: 1,
});

const heading = (text: string, tag: "h2" | "h3" = "h2"): SeedRichTextNode => ({
  children: [textNode(text)],
  direction: null,
  format: "",
  indent: 0,
  tag,
  type: "heading",
  version: 1,
});

const listItem = (text: string): SeedRichTextNode => ({
  children: [paragraph(text)],
  direction: null,
  format: "",
  indent: 0,
  type: "listitem",
  value: 1,
  version: 1,
} as SeedRichTextNode & { value: number });

const unorderedList = (items: string[]): SeedRichTextNode => ({
  children: items.map(listItem),
  direction: null,
  format: "",
  indent: 0,
  listType: "bullet",
  start: 1,
  tag: "ul",
  type: "list",
  version: 1,
} as SeedRichTextNode & {
  listType: string;
  start: number;
  tag: string;
});

const richText = (...children: SeedRichTextNode[]) => ({
  root: {
    children,
    direction: null,
    format: "",
    indent: 0,
    type: "root",
    version: 1,
  },
});

export const seedSettings = {
  address: "Campinas, SP",
  callToActionHref: "/admin",
  callToActionLabel: "Editar conteúdo",
  contactEmail: "contato@palazzo2026.local",
  contactPhone: "(19) 99999-0000",
  footerText:
    "Palazzo 2026 nasce com base moderna, páginas editáveis e fluxo de publicação preparado para crescer.",
  siteName: "Palazzo 2026",
  tagline: "Publicidade, branding, digital e conteúdo com gestão centralizada.",
};

export const seedPages = [
  {
    id: "seed-home",
    title: "Início",
    slug: "home",
    menuLabel: "Início",
    menuOrder: 1,
    showInMenu: true,
    excerpt:
      "A nova presença digital da Palazzo, com visual mais atual e conteúdo organizado em CMS.",
    seo: {
      title: "Palazzo 2026",
      description:
        "Agência com foco em estratégia, branding, digital e conteúdo, agora em uma base moderna e editável.",
    },
    blocks: [
      {
        blockType: "hero",
        eyebrow: "Palazzo Publicidade e Propaganda",
        headline: "A Palazzo entra em 2026 com presença digital mais forte, editável e preparada para crescer.",
        subheadline:
          "A nova base preserva o posicionamento institucional da agência e transforma o antigo site em uma plataforma viva, com páginas dinâmicas, administração centralizada e atualização contínua.",
        primaryActionLabel: "Ver portfólio",
        primaryActionHref: "/portfolio",
        secondaryActionLabel: "Conhecer a agência",
        secondaryActionHref: "/agencia",
        image: {
          alt: "Peças de portfólio da Palazzo",
          url: "/legacy/domani.png",
        },
      },
      {
        blockType: "richText",
        heading: "O que permanece da essência da marca",
        content: richText(
          paragraph(
            "A Palazzo Publicidade e Propaganda conta com profissionais altamente comprometidos com clareza, flexibilidade e responsabilidade no relacionamento com seus clientes."
          ),
          paragraph(
            "No site 2026, essa mesma proposta aparece em uma experiência mais contemporânea: institucional forte, portfólio navegável, áreas de serviço organizadas e estrutura pronta para novos conteúdos."
          ),
          heading("Frentes principais em 2026", "h3"),
          unorderedList([
            "Branding e identidade visual",
            "Campanhas, peças e materiais promocionais",
            "Conteúdo digital e presença institucional",
            "Planejamento estratégico e desdobramento criativo",
          ])
        ),
      },
      {
        blockType: "showcase",
        eyebrow: "Estrutura 2026",
        heading: "Uma agência antiga em repertório, nova em presença digital.",
        intro:
          "O objetivo aqui não é só modernizar o visual. É transformar a Palazzo em uma plataforma de conteúdo fácil de editar, pronta para novos serviços, novos clientes e novos cases.",
        stats: [
          { label: "Páginas-base já navegáveis", value: "5" },
          { label: "Blocos iniciais prontos para edição", value: "4" },
          { label: "Casos trazidos do acervo", value: "6" },
          { label: "Admin centralizado", value: "1 painel" },
        ],
        cards: [
          {
            label: "Institucional",
            title: "Agência",
            description:
              "Página institucional com posicionamento, pilares e discurso de marca mais robusto.",
            href: "/agencia",
          },
          {
            label: "Oferta",
            title: "Serviços",
            description:
              "Organização clara das frentes de atuação para evoluir em páginas próprias depois.",
            href: "/servicos",
          },
          {
            label: "Prova social",
            title: "Portfólio",
            description:
              "Vitrine inicial das peças da agência, já pronta para virar casos completos.",
            href: "/portfolio",
          },
        ],
      },
      {
        blockType: "gallery",
        heading: "Destaques recentes do acervo",
        intro:
          "A antiga galeria foi reinterpretada aqui como vitrine inicial. Depois isso pode virar uma coleção real com categorias, filtros e páginas de case.",
        images: [
          {
            image: { alt: "Domani", url: "/legacy/domani.png" },
            caption: "Domani",
          },
          {
            image: { alt: "FAG", url: "/legacy/fag.png" },
            caption: "FAG",
          },
          {
            image: { alt: "RCA", url: "/legacy/rca.png" },
            caption: "RCA",
          },
        ],
      },
      {
        blockType: "showcase",
        eyebrow: "Como a nova base funciona",
        heading: "Conteúdo, gestão e crescimento no mesmo fluxo.",
        intro:
          "O site 2026 não foi pensado como peça estática. Ele foi estruturado para receber novos cases, novas páginas e novas campanhas com autonomia.",
        cards: [
          {
            label: "CMS",
            title: "Páginas editáveis",
            description:
              "Crie novas páginas, publique e coloque no menu sem alterar manualmente HTML antigo.",
            href: "/admin",
          },
          {
            label: "Performance",
            title: "Base moderna",
            description:
              "Arquitetura pronta para SEO, expansão de conteúdo e publicação profissional na web.",
            href: "/servicos",
          },
          {
            label: "Marca",
            title: "Presença mais forte",
            description:
              "Visual mais consistente, navegação mais clara e linguagem digital mais atual para a Palazzo.",
            href: "/agencia",
          },
        ],
      },
    ],
  },
  {
    id: "seed-agencia",
    title: "Agência",
    slug: "agencia",
    menuLabel: "Agência",
    menuOrder: 2,
    showInMenu: true,
    excerpt: "Visão institucional da Palazzo, equipe, postura de trabalho e proposta de valor.",
    seo: {
      title: "Agência | Palazzo 2026",
      description:
        "Conheça a proposta da Palazzo e a forma como a agência estrutura estratégia, criação e relacionamento.",
    },
    blocks: [
      {
        blockType: "hero",
        eyebrow: "Sobre a agência",
        headline: "Uma agência que combina atendimento próximo, visão estratégica e execução criativa.",
        subheadline:
          "O conteúdo institucional antigo foi trazido para um formato mais sólido, preparado para crescer com novas páginas, novos cases e novas frentes de atuação.",
        primaryActionLabel: "Ver serviços",
        primaryActionHref: "/servicos",
        secondaryActionLabel: "Falar com a Palazzo",
        secondaryActionHref: "/contato",
        image: {
          alt: "Case institucional da Palazzo",
          url: "/legacy/terra-gente.png",
        },
      },
      {
        blockType: "richText",
        heading: "Como a Palazzo se posiciona",
        content: richText(
          paragraph(
            "Com responsabilidade e comprometimento, a Palazzo atende seus clientes de maneira clara e flexível, mantendo a estratégia conectada à execução."
          ),
          paragraph(
            "A nova estrutura digital permite contar essa história melhor: páginas mais ricas, cases mais bem organizados, conteúdo visual mais forte e autonomia real para atualização."
          ),
          heading("Pilares de atuação", "h3"),
          unorderedList([
            "Entendimento do negócio antes da peça",
            "Construção de identidade com consistência",
            "Desdobramento digital e institucional",
            "Organização do conteúdo para evolução contínua",
          ])
        ),
      },
      {
        blockType: "showcase",
        eyebrow: "Postura",
        heading: "Uma operação criativa orientada por clareza, vínculo e continuidade.",
        intro:
          "A agência deixa de ser percebida só como fornecedora de peça e passa a aparecer como parceira estratégica com repertório visual e consistência de entrega.",
        stats: [
          { label: "Atendimento mais próximo", value: "humano" },
          { label: "Visão de marca", value: "360°" },
          { label: "Execução criativa", value: "contínua" },
          { label: "Leitura do negócio", value: "real" },
        ],
        cards: [
          {
            label: "Diagnóstico",
            title: "Entender antes de executar",
            description:
              "A leitura do negócio orienta a direção criativa e reduz retrabalho.",
          },
          {
            label: "Consistência",
            title: "Construir com continuidade",
            description:
              "As peças se conectam entre si e sustentam a percepção da marca no tempo.",
          },
          {
            label: "Evolução",
            title: "Crescer sem engessar",
            description:
              "A nova base permite ampliar atuação e conteúdo sem reiniciar o site a cada ciclo.",
          },
        ],
      },
      {
        blockType: "gallery",
        heading: "Atmosfera visual da marca",
        intro:
          "Um recorte visual que ajuda a construir a narrativa institucional da agência em um ambiente mais atual.",
        images: [
          {
            image: { alt: "Terra Gente", url: "/legacy/terra-gente.png" },
            caption: "Editorial e composição visual",
          },
          {
            image: { alt: "Domani", url: "/legacy/domani.png" },
            caption: "Branding e apresentação",
          },
          {
            image: { alt: "Soedil", url: "/legacy/soedil.png" },
            caption: "Material editorial",
          },
        ],
      },
    ],
  },
  {
    id: "seed-servicos",
    title: "Serviços",
    slug: "servicos",
    menuLabel: "Serviços",
    menuOrder: 3,
    showInMenu: true,
    excerpt:
      "Serviços estratégicos, criativos e digitais que podem ser expandidos em páginas internas no novo CMS.",
    seo: {
      title: "Serviços | Palazzo 2026",
      description:
        "Serviços organizados para branding, propaganda, digital, promocional, impressos e planejamento.",
    },
    blocks: [
      {
        blockType: "hero",
        eyebrow: "Serviços",
        headline: "Estrutura de serviços pronta para virar páginas vivas, com menu automático e expansão simples.",
        subheadline:
          "No site antigo, as áreas já apareciam no sitemap. Agora elas podem evoluir para páginas próprias, com blocos, imagens, SEO e publicação pelo admin.",
        primaryActionLabel: "Abrir admin",
        primaryActionHref: "/admin",
        secondaryActionLabel: "Ver portfólio",
        secondaryActionHref: "/portfolio",
        image: {
          alt: "Revista Soedil",
          url: "/legacy/soedil.png",
        },
      },
      {
        blockType: "richText",
        heading: "Mapa inicial de serviços",
        content: richText(
          paragraph(
            "A Palazzo já trabalhava com frentes como identidade visual, design editorial, promocional, corporativo, propaganda, planejamento estratégico, impressos, digital e embalagens."
          ),
          paragraph(
            "No CMS novo, cada uma dessas frentes pode virar uma página nova em minutos: basta criar a página, marcar para exibir no menu e publicar."
          ),
          heading("Estrutura recomendada", "h3"),
          unorderedList([
            "Identidade visual e branding",
            "Design editorial e materiais impressos",
            "Campanhas e peças promocionais",
            "Conteúdo digital e institucional",
            "Planejamento estratégico e desdobramento criativo",
          ])
        ),
      },
      {
        blockType: "showcase",
        eyebrow: "Desdobramentos",
        heading: "Do sitemap antigo para uma navegação realmente expansível.",
        intro:
          "As áreas históricas da agência podem virar páginas independentes no menu, com layout próprio, SEO individual e atualização sem depender de código.",
        cards: [
          {
            label: "Marca",
            title: "Identidade visual",
            description:
              "Sistema de marca, presença institucional e coerência gráfica.",
          },
          {
            label: "Conteúdo",
            title: "Digital e institucional",
            description:
              "Páginas, campanhas, presença digital e comunicação contínua.",
          },
          {
            label: "Execução",
            title: "Promocional e impressos",
            description:
              "Peças editoriais, promocionais, materiais gráficos e campanhas.",
          },
        ],
      },
      {
        blockType: "showcase",
        eyebrow: "Modelo de entrega",
        heading: "Serviços organizados para vender melhor e escalar com clareza.",
        intro:
          "Cada frente pode ganhar página própria, linguagem própria e cases próprios, mas tudo dentro do mesmo ecossistema de edição.",
        stats: [
          { label: "Frentes de atuação", value: "8+" },
          { label: "Criação de páginas", value: "rápida" },
          { label: "Entrada automática no menu", value: "sim" },
          { label: "SEO por página", value: "individual" },
        ],
        cards: [
          {
            label: "Branding",
            title: "Identidade visual",
            description:
              "Construção, atualização e expansão de identidade com consistência.",
          },
          {
            label: "Campanha",
            title: "Propaganda e promocional",
            description:
              "Peças, campanhas, materiais de ativação e comunicação dirigida.",
          },
          {
            label: "Presença",
            title: "Digital e institucional",
            description:
              "Conteúdo para o ambiente digital e fortalecimento institucional contínuo.",
          },
        ],
      },
    ],
  },
  {
    id: "seed-portfolio",
    title: "Portfólio",
    slug: "portfolio",
    menuLabel: "Portfólio",
    menuOrder: 4,
    showInMenu: true,
    excerpt: "Vitrine inicial do acervo da Palazzo, pronta para virar cases completos no CMS.",
    seo: {
      title: "Portfólio | Palazzo 2026",
      description:
        "Explore uma seleção inicial de peças do acervo da Palazzo em uma vitrine mais atual.",
    },
    blocks: [
      {
        blockType: "hero",
        eyebrow: "Portfólio",
        headline: "O acervo antigo vira vitrine moderna, com espaço para filtro, categorização e páginas de case.",
        subheadline:
          "Por enquanto, esta página reaproveita parte das peças históricas da agência. Depois ela pode evoluir para uma coleção própria, com categorias e destaque por cliente.",
        primaryActionLabel: "Falar com a agência",
        primaryActionHref: "/contato",
        secondaryActionLabel: "Ver serviços",
        secondaryActionHref: "/servicos",
        image: {
          alt: "Case Dronne",
          url: "/legacy/dronne.png",
        },
      },
      {
        blockType: "gallery",
        heading: "Seleção inicial de peças",
        intro:
          "Essas imagens vieram do acervo anterior e já ajudam a dar corpo ao site 2026 enquanto o catálogo definitivo é estruturado.",
        images: [
          {
            image: { alt: "Domani", url: "/legacy/domani.png" },
            caption: "Domani",
          },
          {
            image: { alt: "FAG", url: "/legacy/fag.png" },
            caption: "FAG",
          },
          {
            image: { alt: "RCA", url: "/legacy/rca.png" },
            caption: "RCA",
          },
          {
            image: { alt: "Terra Gente", url: "/legacy/terra-gente.png" },
            caption: "Terra Gente",
          },
          {
            image: { alt: "Revista Soedil", url: "/legacy/soedil.png" },
            caption: "Revista Soedil",
          },
          {
            image: { alt: "Dronne", url: "/legacy/dronne.png" },
            caption: "Dronne Seguros",
          },
        ],
      },
      {
        blockType: "showcase",
        eyebrow: "Leitura do acervo",
        heading: "Uma vitrine inicial que já comunica amplitude de repertório.",
        intro:
          "Nesta etapa, o portfólio já cumpre um papel estratégico: demonstrar volume, variedade e qualidade de execução enquanto o cadastro definitivo de cases é estruturado.",
        stats: [
          { label: "Clientes mostrados", value: "6" },
          { label: "Formatos visuais", value: "múltiplos" },
          { label: "Base pronta para filtro", value: "sim" },
          { label: "Expansão para casos completos", value: "próximo passo" },
        ],
        cards: [
          {
            label: "Catálogo",
            title: "Pode virar coleção de cases",
            description:
              "Com categoria, segmento, cliente, destaque e texto de contexto por projeto.",
          },
          {
            label: "Comercial",
            title: "Ajuda a provar repertório",
            description:
              "A vitrine deixa o discurso comercial mais concreto logo na primeira navegação.",
          },
          {
            label: "Editorial",
            title: "Melhora a narrativa da marca",
            description:
              "O portfólio deixa de ser arquivo e passa a funcionar como argumento visual.",
          },
        ],
      },
    ],
  },
  {
    id: "seed-contato",
    title: "Contato",
    slug: "contato",
    menuLabel: "Contato",
    menuOrder: 5,
    showInMenu: true,
    excerpt: "Página de contato inicial da nova estrutura da Palazzo.",
    seo: {
      title: "Contato | Palazzo 2026",
      description:
        "Entre em contato com a Palazzo e evolua a presença institucional da sua marca.",
    },
    blocks: [
      {
        blockType: "hero",
        eyebrow: "Contato",
        headline: "Uma base nova para atender melhor, atualizar rápido e publicar com autonomia.",
        subheadline:
          "A página de contato ainda pode evoluir para formulário real, CRM, integração com e-mail e automações. A estrutura já foi preparada para isso.",
        primaryActionLabel: "Entrar no admin",
        primaryActionHref: "/admin",
        secondaryActionLabel: "Voltar ao início",
        secondaryActionHref: "/",
        image: {
          alt: "Contato e relacionamento",
          url: "/legacy/fag.png",
        },
      },
      {
        blockType: "richText",
        heading: "Canais iniciais",
        content: richText(
          paragraph(
            "Enquanto o formulário definitivo é estruturado, a página já pode apresentar e-mail, telefone, localização e uma chamada clara para novos projetos."
          ),
          heading("Próximas evoluções recomendadas", "h3"),
          unorderedList([
            "Formulário com envio e registro no CMS",
            "Integração com WhatsApp e e-mail",
            "Mapa e endereço completos",
            "Captação de leads e histórico de contatos",
          ])
        ),
      },
      {
        blockType: "showcase",
        eyebrow: "Conversão",
        heading: "Contato preparado para virar ponto real de entrada comercial.",
        intro:
          "A página já pode evoluir para formulário conectado, captação de leads, encaminhamento automático e histórico por oportunidade.",
        cards: [
          {
            label: "Captação",
            title: "Formulário com registro",
            description:
              "Salvar contatos no CMS ou enviar para CRM conforme a necessidade do projeto.",
          },
          {
            label: "Resposta",
            title: "Encaminhamento inteligente",
            description:
              "Direcionar pedidos para e-mail, WhatsApp ou fluxo interno de atendimento.",
          },
          {
            label: "Comercial",
            title: "Página com função real",
            description:
              "O contato deixa de ser institucional apenas e passa a apoiar aquisição de clientes.",
          },
        ],
      },
    ],
  },
];

export const getSeedPageBySlug = (slug?: string[]) => {
  const path = !slug?.length ? "home" : slug.join("/");

  return seedPages.find((page) => page.slug === path) || null;
};
