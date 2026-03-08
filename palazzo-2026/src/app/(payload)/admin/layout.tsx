import type { ReactNode } from "react";

import {
  metadata,
  RootLayout,
} from "@payloadcms/next/layouts";

import configPromise from "@/payload.config";

import { importMap } from "./importMap";
import { serverFunction } from "./serverFunction";

export { metadata };

export default function Layout({ children }: { children: ReactNode }) {
  return RootLayout({
    children,
    config: configPromise,
    importMap,
    serverFunction,
  });
}
