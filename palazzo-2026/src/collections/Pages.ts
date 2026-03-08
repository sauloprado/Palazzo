import type { CollectionConfig, FieldHook } from "payload";

import { GalleryBlock } from "@/blocks/GalleryBlock";
import { HeroBlock } from "@/blocks/HeroBlock";
import { RichTextBlock } from "@/blocks/RichTextBlock";

const formatSlug = (value: string) =>
  value
    .toLowerCase()
    .trim()
    .replace(/[^\w\s/-]/g, "")
    .replace(/\s+/g, "-")
    .replace(/\/+/g, "/")
    .replace(/^-+|-+$/g, "");

const slugHook: FieldHook = ({ data, value }) => {
  if (typeof value === "string" && value.length) {
    return formatSlug(value);
  }

  if (typeof data?.title === "string") {
    return formatSlug(data.title);
  }

  return value;
};

export const Pages: CollectionConfig = {
  slug: "pages",
  admin: {
    defaultColumns: ["title", "slug", "updatedAt"],
    useAsTitle: "title",
  },
  fields: [
    {
      name: "title",
      type: "text",
      required: true,
    },
    {
      name: "slug",
      type: "text",
      index: true,
      required: true,
      unique: true,
      admin: {
        description:
          "Use 'home' para a página inicial. Também é possível usar caminhos como servicos/branding.",
      },
      hooks: {
        beforeValidate: [slugHook],
      },
    },
    {
      type: "row",
      fields: [
        {
          name: "showInMenu",
          type: "checkbox",
          defaultValue: true,
        },
        {
          name: "menuLabel",
          type: "text",
        },
        {
          name: "menuOrder",
          type: "number",
          defaultValue: 100,
        },
      ],
    },
    {
      name: "excerpt",
      type: "textarea",
    },
    {
      name: "seo",
      type: "group",
      fields: [
        {
          name: "title",
          type: "text",
        },
        {
          name: "description",
          type: "textarea",
        },
      ],
    },
    {
      name: "blocks",
      type: "blocks",
      blocks: [HeroBlock, RichTextBlock, GalleryBlock],
      required: true,
    },
  ],
  versions: {
    drafts: true,
  },
};
