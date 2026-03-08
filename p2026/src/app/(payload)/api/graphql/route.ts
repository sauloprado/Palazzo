import { GRAPHQL_PLAYGROUND_GET, GRAPHQL_POST } from "@payloadcms/next/routes";

import configPromise from "@/payload.config";

export const GET = GRAPHQL_PLAYGROUND_GET(configPromise);
export const POST = GRAPHQL_POST(configPromise);
