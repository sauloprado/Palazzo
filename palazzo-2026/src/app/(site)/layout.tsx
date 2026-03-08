import type { ReactNode } from "react";

import { SiteFooter } from "@/components/site/SiteFooter";
import { SiteHeader } from "@/components/site/SiteHeader";
import { getNavigationPages, getSiteSettings } from "@/lib/site";

export default async function SiteLayout({
  children,
}: {
  children: ReactNode;
}) {
  const [settings, pages] = await Promise.all([
    getSiteSettings(),
    getNavigationPages(),
  ]);

  return (
    <div className="shell">
      <SiteHeader
        callToActionHref={settings?.callToActionHref}
        callToActionLabel={settings?.callToActionLabel}
        pages={pages}
        siteName={settings?.siteName}
        tagline={settings?.tagline}
      />
      {children}
      <SiteFooter
        address={settings?.address}
        contactEmail={settings?.contactEmail}
        contactPhone={settings?.contactPhone}
        footerText={settings?.footerText}
        siteName={settings?.siteName}
      />
    </div>
  );
}
