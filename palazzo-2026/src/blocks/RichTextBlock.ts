import type { Block } from "payload";

export const RichTextBlock: Block = {
  slug: "richText",
  interfaceName: "RichTextBlock",
  labels: {
    singular: "Texto",
    plural: "Textos",
  },
  fields: [
    {
      name: "heading",
      type: "text",
    },
    {
      name: "content",
      type: "richText",
      required: true,
    },
  ],
};
