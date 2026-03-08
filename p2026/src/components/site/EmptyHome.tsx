import Link from "next/link";

export function EmptyHome() {
  return (
    <section className="empty-state">
      <div className="empty-state__card">
        <span className="eyebrow eyebrow--admin">Projeto inicializado</span>
        <h1 className="section-title">Palazzo 2026 pronto para receber conteúdo.</h1>
        <p>
          O frontend e o admin já estão conectados. O próximo passo é entrar no painel,
          criar o primeiro usuário e começar a publicar páginas, blocos e imagens.
        </p>
        <p>
          Caminho principal do painel: <code className="inline-code">/admin</code>
        </p>
        <div className="hero__actions">
          <Link className="button-primary" href="/admin">
            Abrir painel
          </Link>
          <Link className="button-secondary" href="/api/pages">
            API REST
          </Link>
        </div>
      </div>
    </section>
  );
}
