import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import { SiteCompleto } from "./screens/SiteCompleto";

createRoot(document.getElementById("app") as HTMLElement).render(
  <StrictMode>
    <SiteCompleto />
  </StrictMode>,
);
