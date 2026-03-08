import { convertLexicalToHTML } from "@payloadcms/richtext-lexical/html";

type MediaValue = {
  alt?: string | null;
  caption?: string | null;
  filename?: string | null;
  id?: number | string;
  url?: string | null;
};

type Block = {
  blockType: "gallery" | "hero" | "richText" | "showcase" | string;
  cards?: Array<{
    description?: string | null;
    href?: string | null;
    id?: string;
    label?: string | null;
    title?: string | null;
  }>;
  content?: unknown;
  eyebrow?: string | null;
  headline?: string | null;
  heading?: string | null;
  id?: string;
  image?: MediaValue | number | string | null;
  images?: Array<{
    caption?: string | null;
    id?: string;
    image?: MediaValue | number | string | null;
  }>;
  intro?: string | null;
  primaryActionHref?: string | null;
  primaryActionLabel?: string | null;
  secondaryActionHref?: string | null;
  secondaryActionLabel?: string | null;
  stats?: Array<{
    id?: string;
    label?: string | null;
    value?: string | null;
  }>;
  subheadline?: string | null;
};

const getMedia = (value: Block["image"]) => {
  if (!value || typeof value !== "object") {
    return null;
  }

  return value as MediaValue;
};

export function BlocksRenderer({ blocks }: { blocks?: Block[] | null }) {
  if (!blocks?.length) {
    return null;
  }

  return (
    <div className="page-stack">
      {blocks.map((block, index) => {
        if (block.blockType === "hero") {
          const media = getMedia(block.image);

          return (
            <section className="hero panel" key={block.id || index}>
              <div>
                {block.eyebrow ? <span className="eyebrow">{block.eyebrow}</span> : null}
                <h1>{block.headline}</h1>
                {block.subheadline ? <p>{block.subheadline}</p> : null}
                <div className="hero__actions">
                  {block.primaryActionHref && block.primaryActionLabel ? (
                    <a className="button-primary" href={block.primaryActionHref}>
                      {block.primaryActionLabel}
                    </a>
                  ) : null}
                  {block.secondaryActionHref && block.secondaryActionLabel ? (
                    <a className="button-secondary" href={block.secondaryActionHref}>
                      {block.secondaryActionLabel}
                    </a>
                  ) : null}
                </div>
              </div>

              <div className="hero__media">
                {media?.url ? (
                  <img alt={media.alt || block.headline || "Imagem"} src={media.url} />
                ) : null}
              </div>
            </section>
          );
        }

        if (block.blockType === "richText") {
          const html = block.content
            ? convertLexicalToHTML({
                data: block.content as Parameters<typeof convertLexicalToHTML>[0]["data"],
              })
            : "";

          return (
            <section className="section panel" id="estrutura" key={block.id || index}>
              <div className="section-header">
                {block.heading ? <h2 className="section-title">{block.heading}</h2> : null}
              </div>
              <div
                className="rich-text"
                dangerouslySetInnerHTML={{ __html: html }}
              />
            </section>
          );
        }

        if (block.blockType === "gallery") {
          return (
            <section className="section panel" key={block.id || index}>
              <div className="section-header">
                {block.heading ? <h2 className="section-title">{block.heading}</h2> : null}
                {block.intro ? <p className="section-copy">{block.intro}</p> : null}
              </div>

              <div className="gallery-grid">
                {block.images?.map((item, itemIndex) => {
                  const media = getMedia(item.image);

                  if (!media?.url) {
                    return null;
                  }

                  return (
                    <article className="gallery-card" key={item.id || itemIndex}>
                      <img alt={media.alt || "Imagem da galeria"} src={media.url} />
                      {item.caption || media.caption ? (
                        <div className="gallery-card__caption">
                          {item.caption || media.caption}
                        </div>
                      ) : null}
                    </article>
                  );
                })}
              </div>
            </section>
          );
        }

        if (block.blockType === "showcase") {
          return (
            <section className="section panel" key={block.id || index}>
              <div className="section-header">
                {block.eyebrow ? <span className="eyebrow">{block.eyebrow}</span> : null}
                {block.heading ? <h2 className="section-title">{block.heading}</h2> : null}
                {block.intro ? <p className="section-copy">{block.intro}</p> : null}
              </div>

              {block.stats?.length ? (
                <div className="stats-grid">
                  {block.stats.map((stat, statIndex) => (
                    <article className="stat-card" key={stat.id || statIndex}>
                      <strong>{stat.value}</strong>
                      <span>{stat.label}</span>
                    </article>
                  ))}
                </div>
              ) : null}

              {block.cards?.length ? (
                <div className="showcase-grid">
                  {block.cards.map((card, cardIndex) => (
                    <article className="showcase-card" key={card.id || cardIndex}>
                      {card.label ? <span className="showcase-card__label">{card.label}</span> : null}
                      {card.title ? <h3>{card.title}</h3> : null}
                      {card.description ? <p>{card.description}</p> : null}
                      {card.href ? (
                        <a className="showcase-card__link" href={card.href}>
                          Explorar
                        </a>
                      ) : null}
                    </article>
                  ))}
                </div>
              ) : null}
            </section>
          );
        }

        return null;
      })}
    </div>
  );
}
