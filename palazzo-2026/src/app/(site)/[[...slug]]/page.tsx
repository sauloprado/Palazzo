import type { Metadata } from "next";
import { notFound } from "next/navigation";

import { BlocksRenderer } from "@/components/blocks/BlocksRenderer";
import { getPageBySegments } from "@/lib/site";

type DynamicPageProps = {
  params: Promise<{
    slug?: string[];
  }>;
};

export async function generateMetadata({
  params,
}: DynamicPageProps): Promise<Metadata> {
  const { slug } = await params;
  const page = await getPageBySegments(slug);

  if (!page) {
    return {};
  }

  return {
    description: page.seo?.description || page.excerpt || undefined,
    title: page.seo?.title || page.title,
  };
}

export default async function DynamicPage({ params }: DynamicPageProps) {
  const { slug } = await params;
  const page = await getPageBySegments(slug);

  if (!page) {
    notFound();
  }

  return (
    <main className="page-shell">
      <BlocksRenderer blocks={page.blocks} />
    </main>
  );
}
