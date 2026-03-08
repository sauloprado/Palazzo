type SiteFooterProps = {
  address?: string | null;
  contactEmail?: string | null;
  contactPhone?: string | null;
  footerText?: string | null;
  siteName?: string | null;
};

export function SiteFooter({
  address,
  contactEmail,
  contactPhone,
  footerText,
  siteName,
}: SiteFooterProps) {
  return (
    <footer className="site-footer">
      <div className="site-footer__grid">
        <div className="site-footer__meta">
          <strong>{siteName || "Palazzo 2026"}</strong>
          <span>{footerText || "CMS moderno com frontend em Next.js e admin integrado."}</span>
        </div>

        <div className="site-footer__meta">
          {contactEmail ? <span>{contactEmail}</span> : null}
          {contactPhone ? <span>{contactPhone}</span> : null}
          {address ? <span>{address}</span> : null}
        </div>
      </div>
    </footer>
  );
}
