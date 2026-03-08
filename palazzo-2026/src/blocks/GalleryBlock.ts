import type { Block } from "payload";

export const GalleryBlock: Block = {
  slug: "gallery",
  interfaceName: "GalleryBlock",
  labels: {
    singular: "Galeria",
    plural: "Galerias",
  },
  fields: [
    {
      name: "heading",
      type: "text",
    },
    {
      name: "intro",
      type: "textarea",
    },
    {
      name: "images",
      type: "array",
      minRows: 1,
      fields: [
        {
          name: "image",
          type: "upload",
          relationTo: "media",
          required: true,
        },
        {
          name: "caption",
          type: "text",
        },
      ],
    },
  ],
};
