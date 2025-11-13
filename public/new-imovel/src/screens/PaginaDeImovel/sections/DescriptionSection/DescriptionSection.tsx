import React from "react";
import { Separator } from "../../../../components/ui/separator";
import { Button } from "../../../../components/ui/button";

type Props = {
  title?: string;
  subtitle?: string;
  ctaHref?: string;
  ctaLabel?: string;
};

export const DescriptionSection = ({ title, subtitle, ctaHref, ctaLabel }: Props): JSX.Element => {
  const fallbackTitle = "Sobrado em bairro Estancia Velha";
  const showTitle = title ?? fallbackTitle;
  return (
    <section className="w-full flex flex-col items-start gap-4">
      <h1 className="translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:200ms] [font-family:'Archivo_Narrow',Helvetica] font-bold italic text-[#373b47] text-[45px] tracking-[0] leading-[45px]">
        {showTitle}
      </h1>

      <Separator className="translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:400ms] w-full h-[3px] bg-[#373b47]" />

      {(subtitle ?? "SOBRADO DE TRÊS DORMITÓRIOS COM REVESTIMENTO EM MADEIRA NOBRE") && (
        <h2 className="translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:600ms] [font-family:'Roboto',Helvetica] font-bold text-[#555555] text-xl tracking-[0] leading-[25px]">
          {subtitle ?? "SOBRADO DE TRÊS DORMITÓRIOS COM REVESTIMENTO EM MADEIRA NOBRE"}
        </h2>
      )}

      {(ctaHref || ctaLabel) && (
        <a href={ctaHref || '#'} target="_blank" rel="noopener" className="mt-2">
          <Button className="rounded-[10px] border border-solid border-[#761212] shadow-[0px_4px_4px_#00000040] bg-[linear-gradient(270deg,rgba(110,16,16,1)_0%,rgba(238,10,9,1)_100%)] [font-family:'Roboto',Helvetica] font-semibold italic text-white text-2xl hover:opacity-90 transition-opacity">
            <span className="flex items-center gap-2">
              {ctaLabel || 'Falar com Catia'}
              <img className="w-[19px] h-[21px]" alt="WhatsApp" src="https://c.animaapp.com/mht9bn8iNrOJ7D/img/group-1.svg" />
            </span>
          </Button>
        </a>
      )}
    </section>
  );
};
