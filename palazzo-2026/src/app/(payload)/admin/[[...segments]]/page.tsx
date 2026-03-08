import { generatePageMetadata, RootPage } from "@payloadcms/next/views";

import configPromise from "@/payload.config";

import { importMap } from "../importMap";

type AdminPageProps = {
  params: Promise<{
    segments: string[];
  }>;
  searchParams: Promise<Record<string, string | string[]>>;
};

export function generateMetadata({ params, searchParams }: AdminPageProps) {
  return generatePageMetadata({
    config: configPromise,
    params,
    searchParams,
  });
}

export default function Page({ params, searchParams }: AdminPageProps) {
  return RootPage({
    config: configPromise,
    importMap,
    params,
    searchParams,
  });
}
