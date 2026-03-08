import { sqliteAdapter } from "@payloadcms/db-sqlite";
import { lexicalEditor } from "@payloadcms/richtext-lexical";
import path from "path";
import { buildConfig } from "payload";
import sharp from "sharp";
import { fileURLToPath } from "url";

import { GalleryBlock } from "@/blocks/GalleryBlock";
import { HeroBlock } from "@/blocks/HeroBlock";
import { RichTextBlock } from "@/blocks/RichTextBlock";
import { Media } from "@/collections/Media";
import { Pages } from "@/collections/Pages";
import { Users } from "@/collections/Users";
import { SiteSettings } from "@/globals/SiteSettings";

const filename = fileURLToPath(import.meta.url);
const dirname = path.dirname(filename);

export default buildConfig({
  admin: {
    user: Users.slug,
    importMap: {
      baseDir: path.resolve(dirname),
    },
  },
  collections: [Users, Media, Pages],
  cors: [process.env.NEXT_PUBLIC_SITE_URL || "http://localhost:3000"],
  csrf: [process.env.NEXT_PUBLIC_SITE_URL || "http://localhost:3000"],
  db: sqliteAdapter({
    client: {
      url: process.env.DATABASE_URI || "file:./palazzo.db",
    },
    push: true,
  }),
  editor: lexicalEditor(),
  globals: [SiteSettings],
  onInit: async (payload) => {
    const pageCount = await payload.find({
      collection: Pages.slug,
      depth: 0,
      limit: 1,
      overrideAccess: true,
    });

    if (!pageCount.totalDocs) {
      await payload.create({
        collection: Pages.slug,
        data: {
          title: "Home",
          slug: "home",
          showInMenu: true,
          menuLabel: "Início",
          menuOrder: 1,
          blocks: [
            {
              blockType: "hero",
              eyebrow: "Palazzo 2026",
              headline: "Novo site institucional com CMS realmente editável.",
              subheadline:
                "Crie páginas, altere o menu, publique imagens e gerencie o conteúdo em um painel moderno, sem depender de HTML manual.",
              primaryActionLabel: "Abrir admin",
              primaryActionHref: "/admin",
              secondaryActionLabel: "Ver estrutura",
              secondaryActionHref: "#estrutura",
            },
            {
              blockType: "richText",
              heading: "Estrutura inicial pronta para crescer",
              content: {
                root: {
                  type: "root",
                  children: [
                    {
                      type: "paragraph",
                      children: [
                        {
                          type: "text",
                          text: "A base já nasce com páginas dinâmicas, mídia gerenciada, menu automático e bloco de conteúdo reutilizável.",
                          version: 1,
                        },
                      ],
                      direction: null,
                      format: "",
                      indent: 0,
                      textFormat: 0,
                      textStyle: "",
                      version: 1,
                    },
                  ],
                  direction: null,
                  format: "",
                  indent: 0,
                  version: 1,
                },
              },
            },
          ],
        },
        draft: false,
        overrideAccess: true,
      });
    }

    await payload.updateGlobal({
      slug: SiteSettings.slug,
      data: {
        siteName: "Palazzo 2026",
        tagline: "Publicidade, presença digital e gestão de conteúdo.",
        callToActionLabel: "Entrar no admin",
        callToActionHref: "/admin",
        footerText:
          "Base inicial do novo site da Palazzo com CMS moderno, páginas dinâmicas e administração centralizada.",
      },
      overrideAccess: true,
    });
  },
  secret: process.env.PAYLOAD_SECRET || "palazzo-2026-dev-secret",
  sharp,
  typescript: {
    outputFile: path.resolve(dirname, "payload-types.ts"),
  },
});
