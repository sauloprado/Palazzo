import Link from "next/link";

import { resolvePageHref } from "@/lib/site";

type SiteHeaderProps = {
  callToActionHref?: string | null;
  callToActionLabel?: string | null;
  pages: Array<{
    id?: number | string;
    menuLabel?: string | null;
    slug?: string | null;
    title?: string | null;
  }>;
  siteName?: string | null;
  tagline?: string | null;
};

export function SiteHeader({
  callToActionHref,
  callToActionLabel,
  pages,
  siteName,
  tagline,
}: SiteHeaderProps) {
  return (
    <header className="site-header">
      <div className="site-header__inner">
        <Link className="brand-mark" href="/">
          <span className="brand-mark__title">{siteName || "Palazzo 2026"}</span>
          <span className="brand-mark__tag">
            {tagline || "Conteúdo editável e navegação dinâmica"}
          </span>
        </Link>

        <nav aria-label="Principal" className="site-nav">
          {pages.map((page) => (
            <Link href={resolvePageHref(page.slug)} key={page.id || page.slug}>
              {page.menuLabel || page.title || "Página"}
            </Link>
          ))}

          <Link className="nav-cta" href={callToActionHref || "/admin"}>
            {callToActionLabel || "Admin"}
          </Link>
        </nav>
      </div>
    </header>
  );
}
