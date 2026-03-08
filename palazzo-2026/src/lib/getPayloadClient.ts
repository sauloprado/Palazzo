import { getPayload } from "payload";

import configPromise from "@/payload.config";

let payloadPromise: ReturnType<typeof getPayload> | null = null;

export const getPayloadClient = async () => {
  if (!payloadPromise) {
    payloadPromise = getPayload({
      config: configPromise,
    });
  }

  return payloadPromise;
};
