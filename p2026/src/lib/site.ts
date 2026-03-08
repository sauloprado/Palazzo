import { getPayloadClient } from "@/lib/getPayloadClient";
import { getSeedPageBySlug, seedPages, seedSettings } from "@/lib/seed-site";

const HOME_SLUG = "home";

const normalizeIncomingSlug = (segments?: string[]) => {
  if (!segments?.length) {
    return HOME_SLUG;
  }

  return segments.join("/");
};

export const resolvePageHref = (slug?: string | null) => {
  if (!slug || slug === HOME_SLUG) {
    return "/";
  }

  return `/${slug}`;
};

export const getNavigationPages = async () => {
  try {
    const payload = await getPayloadClient();
    const pages = await payload.find({
      collection: "pages",
      depth: 1,
      draft: false,
      limit: 50,
      overrideAccess: true,
      sort: "menuOrder",
      where: {
        showInMenu: {
          equals: true,
        },
      },
    });

    if (pages.docs.length) {
      return pages.docs;
    }
  } catch {}

  return seedPages;
};

export const getSiteSettings = async () => {
  try {
    const payload = await getPayloadClient();
    const settings = await payload.findGlobal({
      slug: "site-settings",
      depth: 1,
      overrideAccess: true,
    });

    if (settings?.siteName) {
      return settings;
    }
  } catch {}

  return seedSettings;
};

export const getPageBySegments = async (segments?: string[]) => {
  try {
    const payload = await getPayloadClient();
    const slug = normalizeIncomingSlug(segments);
    const pages = await payload.find({
      collection: "pages",
      depth: 2,
      draft: false,
      limit: 1,
      overrideAccess: true,
      where: {
        slug: {
          equals: slug,
        },
      },
    });

    if (pages.docs[0]) {
      return pages.docs[0];
    }
  } catch {}

  return getSeedPageBySlug(segments);
};

export const getDefaultMetadata = async () => {
  const settings = await getSiteSettings();

  return {
    description:
      settings?.tagline || "Novo site institucional da Palazzo em base moderna.",
    title: settings?.siteName || "Palazzo 2026",
  };
};
