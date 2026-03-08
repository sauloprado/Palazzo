import type { CollectionConfig } from "payload";

export const Media: CollectionConfig = {
  slug: "media",
  admin: {
    useAsTitle: "alt",
  },
  upload: {
    imageSizes: [
      {
        name: "card",
        width: 1200,
        height: 900,
        fit: "cover",
      },
      {
        name: "hero",
        width: 1600,
        height: 1200,
        fit: "cover",
      },
    ],
    mimeTypes: ["image/*"],
  },
  fields: [
    {
      name: "alt",
      type: "text",
      required: true,
    },
    {
      name: "caption",
      type: "text",
    },
  ],
};
