import type { Block } from "payload";

export const HeroBlock: Block = {
  slug: "hero",
  interfaceName: "HeroBlock",
  labels: {
    singular: "Hero",
    plural: "Heroes",
  },
  fields: [
    {
      name: "eyebrow",
      type: "text",
    },
    {
      name: "headline",
      type: "text",
      required: true,
    },
    {
      name: "subheadline",
      type: "textarea",
    },
    {
      type: "row",
      fields: [
        {
          name: "primaryActionLabel",
          type: "text",
        },
        {
          name: "primaryActionHref",
          type: "text",
        },
      ],
    },
    {
      type: "row",
      fields: [
        {
          name: "secondaryActionLabel",
          type: "text",
        },
        {
          name: "secondaryActionHref",
          type: "text",
        },
      ],
    },
    {
      name: "image",
      type: "upload",
      relationTo: "media",
    },
  ],
};
