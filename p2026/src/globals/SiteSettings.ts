import type { GlobalConfig } from "payload";

export const SiteSettings: GlobalConfig = {
  slug: "site-settings",
  fields: [
    {
      name: "siteName",
      type: "text",
      required: true,
      defaultValue: "Palazzo 2026",
    },
    {
      name: "tagline",
      type: "text",
      defaultValue: "Publicidade, presença digital e gestão de conteúdo.",
    },
    {
      name: "callToActionLabel",
      type: "text",
      defaultValue: "Entrar no admin",
    },
    {
      name: "callToActionHref",
      type: "text",
      defaultValue: "/admin",
    },
    {
      name: "footerText",
      type: "textarea",
    },
    {
      name: "contactEmail",
      type: "email",
    },
    {
      name: "contactPhone",
      type: "text",
    },
    {
      name: "address",
      type: "textarea",
    },
  ],
};
